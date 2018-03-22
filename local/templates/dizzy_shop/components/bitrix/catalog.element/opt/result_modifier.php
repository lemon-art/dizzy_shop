<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

?>


<?
//получаем все размеры
$arSizes = Array();
foreach ( $arResult['SKU_PROPS']['SIZES_CLOTHES']['VALUES'] as $key => $value ){
	if ( $key ){
		$arSizes[$value["ID"]] = $value["NAME"];
	}
}
asort($arSizes);
$arResult['SIZES'] = $arSizes;

//получаем все цвета
$arColors = Array();
foreach ( $arResult['SKU_PROPS']['COLOR_REF']['VALUES'] as $key => $value ){
	if ( $key ){
		$arColors[$value["ID"]] = $value["NAME"];
	}
}
$arResult['COLORS'] = $arColors;


//получаем и обрабатываем фотки предложений
$arSkuPhoto = Array();
$arSkuTable = Array();

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
	
	if ( $offer['CATALOG_AVAILABLE'] == "Y" ){
		$idColor = $offer['TREE']['PROP_77'];
		$idSize = $offer['TREE']['PROP_78'];
		$arSkuTable[$idColor][$idSize] = Array(
			"OFFER_ID" => $offer['ID'],
			"QUANTITY" => $offer['CATALOG_QUANTITY']	
		);
	}
}

$arResult['SKU_TABLE'] = $arSkuTable;

$arResult['SKU_PHOTO'] = $arSkuPhoto['PROP_77'];


//получаем все цвета
$arColors = Array();

$HL_Infoblock_ID = 1;
$hlblock = HL\HighloadBlockTable::getById($HL_Infoblock_ID)->fetch(); 
$entity = HL\HighloadBlockTable::compileEntity($hlblock);

$entity_data_class = $entity->getDataClass();
$entity_table_name = $hlblock['TABLE_NAME'];

$arFilter = array(); //задаете фильтр по вашим полям

$sTableID = 'tbl_'.$entity_table_name;
$rsData = $entity_data_class::getList(array(
"select" => array('ID', 'UF_FILE'), 
"filter" => $arFilter,
"order" => array("UF_SORT"=>"ASC") // сортировка по полю UF_SORT, будет работать только, если вы завели такое поле в hl'блоке
));
$rsData = new CDBResult($rsData, $sTableID);
while($arRes = $rsData->Fetch()){
	
	$arColors[$arRes["ID"]] = CFile::GetPath($arRes["UF_FILE"]);
}
$arResult['COLORS_BG'] = $arColors;





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

