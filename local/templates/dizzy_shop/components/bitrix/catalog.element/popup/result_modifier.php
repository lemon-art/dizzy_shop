<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */
if (array_key_exists('is_ajax', $_REQUEST) && $_REQUEST['is_ajax']=='y') {
    $APPLICATION->RestartBuffer();
}
$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

?>

<?
//получаем и обрабатываем фотки предложений
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

?>



