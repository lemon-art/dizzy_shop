<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

?>


<?
//получаем и обрабатываем фотки предложений
/*
$arSkuPhoto = Array();

foreach ($arResult['OFFERS'] as $keyOffer => $offer){


	foreach ( $offer['TREE'] as $key => $val){
		if ( $offer["DETAIL_PICTURE"]["SRC"] && !$arSkuPhoto[$key][$val] ){
			
			$arSkuPhoto[$key][$val]["ORIGINAL"] = $offer["DETAIL_PICTURE"]["SRC"];
			$file = CFile::ResizeImageGet($offer["DETAIL_PICTURE"], array('width'=>66, 'height'=>90), BX_RESIZE_IMAGE_PROPORTIONAL, true);                
			$arSkuPhoto[$key][$val]["SMALL"] = $file['src'];
			$file = CFile::ResizeImageGet($offer["DETAIL_PICTURE"], array('width'=>80, 'height'=>120), BX_RESIZE_IMAGE_PROPORTIONAL, true);                
			$arSkuPhoto[$key][$val]["SLIDER"] = $file['src'];
			$file = CFile::ResizeImageGet($offer["DETAIL_PICTURE"], array('width'=>460, 'height'=>600), BX_RESIZE_IMAGE_PROPORTIONAL, true);                
			$arSkuPhoto[$key][$val]["BIG"] = $file['src'];
		}
	}


	foreach ($offer['MORE_PHOTO'] as $keyPhoto => $photo){
		//echo $offer['ID'];
		//echo "<pre>";
		//print_r( $arResult['SKU_PROPS'] );
		//echo "</pre>";
	}
}

$arResult['SKU_PHOTO'] = $arSkuPhoto['PROP_77'];

*/

//получаем кол-во товаров и навигация по ним
$arSort = array(
    'sort' => 'desc',
    'id' => 'desc',
);
$arSelect = array(
    'ID',
    'NAME',
    'DETAIL_PAGE_URL',
);
$arFilter = array(
    'IBLOCK_ID'             => $arParams['IBLOCK_ID'],
    //'SECTION_CODE'          => $arParams['SECTION_CODE'],
    //'SECTION_CODE'          => $arResult['SECTION']['CODE'],
    'SECTION_ID'            => $arResult['IBLOCK_SECTION_ID'],
    'ACTIVE'                => 'Y',
    'ACTIVE_DATE'           => 'Y',
    'SECTION_ACTIVE'        => 'Y',
    'SECTION_GLOBAL_ACTIVE' => 'Y',
    'INCLUDE_SUBSECTIONS'   => 'Y',
    'CHECK_PERMISSIONS'     => 'Y',
    'MIN_PERMISSION'        => 'R',
);
$arNavParams = array(
    //'nPageSize'  => 1,
    //'nElementID' => $arResult['ID'],
);
$arElements     = Array();
$rsElements   = CIBlockElement::GetList($arSort, $arFilter, FALSE, $arNavParams, $arSelect);
if($arParams['DETAIL_URL'])
    $rsElements->SetUrlTemplates($arParams['DETAIL_URL']);

while($obElement = $rsElements->GetNextElement()) {
    $arElements[] = $obElement->GetFields();
}

$findKey = false;
foreach ( $arElements as $key => $arElement){
	if ( $arElement['ID'] == $arResult['ID'] ){
		$findKey = $key;
	}
}

$arResult['NAVIGATION']['COUNT'] = count($arElements);
$arResult['NAVIGATION']['CURRENT_NUMBER'] = $findKey+1;
$arResult['NAVIGATION']['PREV_URL'] = $arElements[$findKey-1]["DETAIL_PAGE_URL"];
$arResult['NAVIGATION']['NEXT_URL'] = $arElements[$findKey+1]["DETAIL_PAGE_URL"];
$arResult['NAVIGATION']['BACK_URL'] = $arResult['SECTION']['SECTION_PAGE_URL'];


//обрабатываем фотки
foreach ( $arResult["MORE_PHOTO"] as $key => $photo ){
	$file = CFile::ResizeImageGet($photo['ID'], array('width'=>78, 'height'=>117), BX_RESIZE_IMAGE_PROPORTIONAL, true);                
    $arResult["MORE_PHOTO"][$key]["SMALL_SLIDER_SRC"] = $file['src'];

	$file = CFile::ResizeImageGet($photo['ID'], array('width'=>96, 'height'=>144), BX_RESIZE_IMAGE_PROPORTIONAL, true);                
    $arResult["MORE_PHOTO"][$key]["BIG_SLIDER_SRC"] = $file['src'];
	
	$file = CFile::ResizeImageGet($photo['ID'], array('width'=>460, 'height'=>690), BX_RESIZE_IMAGE_PROPORTIONAL, true);                
    $arResult["MORE_PHOTO"][$key]["SMALL_SRC"] = $file['src'];
	
}

//проверяем доступность предложений
$arSizesNotAvalible;
foreach( $arResult['OFFERS'] as $arOffer ){
	if ( $arOffer['CATALOG_QUANTITY'] <= 0 ){
		$arSizesNotAvalible[] = $arOffer['TREE']['PROP_78'];
	}
}
foreach ($arResult['SKU_PROPS'] as $key => $skuProperty){
	foreach ($skuProperty['VALUES'] as $keyVal => $arVal ){
		if ( in_array($arVal['ID'], $arSizesNotAvalible )){
			unset($arResult['SKU_PROPS'][$key]['VALUES'][$keyVal]);
		}
		
	}
}

$arResult['COLOR'] = $arResult['DISPLAY_PROPERTIES']['COLOR']['DISPLAY_VALUE'];
$articul = $arResult['PROPERTIES']['CML2_ARTICLE']['VALUE'];
$arColorProducts = Array();
//товары другого цвета
$arFilter = Array(
	"IBLOCK_ID"=>$arResult['IBLOCK_ID'],  
	"ACTIVE"=>"Y", 
	"PROPERTY_CML2_ARTICLE"=>$articul
 );
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, Array("IBLOCK_ID", "ID", "DETAIL_PAGE_URL", "PREVIEW_PICTURE"));
while($ar_fields = $res->GetNext()){

	$file = CFile::ResizeImageGet($ar_fields['PREVIEW_PICTURE'], array('width'=>60, 'height'=>80), BX_RESIZE_IMAGE_PROPORTIONAL, true);                
    $ar_fields['SMALL_SRC'] = $file['src'];
	$arColorProducts[] = $ar_fields;
	
} 

$arResult['COLOR_PRODUCTS'] = $arColorProducts;

$arPropShow = Array( "SOSTAV","PODKLADKA","UTEPLITEL" );
foreach ( $arResult['DISPLAY_PROPERTIES'] as $key => $arVal ){
	if ( in_array( $key, $arPropShow ) ){
		$arResult['SHOW_PROPERTIES'][$key] =  $arVal; 
	}
}
?>




<?
		global $USER;
		$arResult["FAVORITES"] = Array();
		if(!$USER->IsAuthorized()){
			$arElements = unserialize($APPLICATION->get_cookie('favorites'));
		}
		else{
			$idUser = $USER->GetID();
			$rsUser = CUser::GetByID($idUser);
			$arUser = $rsUser->Fetch();
			$arElements = unserialize($arUser['UF_FAVORITES']);
        }  
		foreach ( $arElements as $key => $arElement){
			if ( $arElement == $ProductID ) {
				unset( $arElements[$key] );
			}
		}
		$arResult["FAVORITES"] = $arElements;


?>

