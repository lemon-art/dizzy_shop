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
$property_enums = CIBlockPropertyEnum::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>5, "CODE"=>"SIZES_CLOTHES"));
while($enum_fields = $property_enums->GetNext())
{
	$arSizes[$enum_fields["ID"]] = $enum_fields["VALUE"];
}
asort($arSizes);
$arResult['SIZES'] = $arSizes;



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
"select" => array('ID', 'UF_FILE', 'UF_NAME', 'UF_XML_ID'), 
"filter" => $arFilter,
"order" => array("UF_SORT"=>"ASC") // сортировка по полю UF_SORT, будет работать только, если вы завели такое поле в hl'блоке
));
$rsData = new CDBResult($rsData, $sTableID);
while($arRes = $rsData->Fetch()){
	
	$arColors[$arRes["UF_XML_ID"]] = Array(
		"PICT" => CFile::GetPath($arRes["UF_FILE"]),
		"NAME" => $arRes["UF_NAME"]
	);
}
$arResult['COLORS_BG'] = $arColors;

//обрабатываем фотки
foreach ( $arResult["MORE_PHOTO"] as $key => $photo ){
	$file = CFile::ResizeImageGet($photo['ID'], array('width'=>78, 'height'=>117), BX_RESIZE_IMAGE_PROPORTIONAL, true);                
    $arResult["MORE_PHOTO"][$key]["SMALL_SLIDER_SRC"] = $file['src'];

	$file = CFile::ResizeImageGet($photo['ID'], array('width'=>96, 'height'=>144), BX_RESIZE_IMAGE_PROPORTIONAL, true);                
    $arResult["MORE_PHOTO"][$key]["BIG_SLIDER_SRC"] = $file['src'];
	
	$file = CFile::ResizeImageGet($photo['ID'], array('width'=>460, 'height'=>690), BX_RESIZE_IMAGE_PROPORTIONAL, true);                
    $arResult["MORE_PHOTO"][$key]["SMALL_SRC"] = $file['src'];
	
}

global $arBasketProduct;
global $countProduct;
$countProduct++;

$arSkuTable = Array();
$arItemsID = Array();
$arResult['COLOR'] = $arResult['DISPLAY_PROPERTIES']['COLOR']['DISPLAY_VALUE'];
$articul = $arResult['PROPERTIES']['CML2_ARTICLE']['VALUE'];
$arColorProducts = Array();
//товары другого цвета
$arFilter = Array(
	"IBLOCK_ID"=>$arResult['IBLOCK_ID'],  
	"ACTIVE"=>"Y", 
	"PROPERTY_CML2_ARTICLE"=>$articul
 );
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, Array("ID", "PROPERTY_COLOR"));
while($ar_fields = $res->GetNext()){

	$arColorProducts[] = $ar_fields;
	$arItemsID[] = $ar_fields['ID'];
	$arBasketProduct[] = $ar_fields['ID'];
	$arColorProduct[$ar_fields['ID']] = $ar_fields['PROPERTY_COLOR_VALUE'];
	$arResult['COLORS'][] = $ar_fields['PROPERTY_COLOR_VALUE'];
} 

//получаем торговые предложения товаров
$arOffers = Array();
$arFilter = Array(
	"IBLOCK_ID"=> 5,  
	"ACTIVE"=>"Y", 
	"PROPERTY_CML2_LINK"=>$arItemsID
 );
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, Array("PROPERTY_CML2_LINK", "ID", "PROPERTY_SIZES_CLOTHES", "CATALOG_QUANTITY"));
while($offer = $res->GetNext()){

	$arOffers[ $offer['PROPERTY_CML2_LINK_VALUE']][] = $offer;
	
	if ( $offer['CATALOG_AVAILABLE'] == "Y" ){
		$idColor = $arColorProduct[$offer['PROPERTY_CML2_LINK_VALUE']];
		$idSize = $offer['PROPERTY_SIZES_CLOTHES_ENUM_ID'];
		$arSkuTable[$idColor][$idSize] = Array(
			"OFFER_ID" => $offer['ID'],
			"QUANTITY" => $offer['CATALOG_QUANTITY']	
		);
	}
} 


$arResult['COLOR_PRODUCTS'] = $arColorProducts;





$arResult['SKU_TABLE'] = $arSkuTable;

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

