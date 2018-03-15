<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
if (array_key_exists('is_ajax', $_REQUEST) && $_REQUEST['is_ajax']=='y') {
    $APPLICATION->RestartBuffer();
}


use Bitrix\Main;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
CModule::IncludeModule('highloadblock');

$arColors = Array();
$arColorNames = Array();
$arElements = Array();
$arProducts = Array();
foreach ($arResult["GRID"]["ROWS"] as $k => $arItem){
	$arElements[] = $arItem['PRODUCT_ID'];
	foreach ($arItem["PROPS"] as $val){
		if ( $val['CODE'] == 'COLOR_REF'){
			if ( !in_array($val['VALUE'], $arColors)){
				$arColors[] = $val['VALUE'];
			}
			
		}
	}
	
}
	if ( count( $arColors ) > 0 ){
	
			$hlblock = HL\HighloadBlockTable::getById(1)->fetch(); // id highload блока
		    $entity = HL\HighloadBlockTable::compileEntity($hlblock);
		    $entityClass = $entity->getDataClass();

		   $res = $entityClass::getList(array(
			   'select' => array('UF_NAME', 'UF_XML_ID'),
			   'filter' => array('UF_XML_ID' => $arColors)
		    ));

			while ($row = $res->fetch()){
				$arColorNames[$row['UF_XML_ID']] = 	$row['UF_NAME'];
			}
			
			$arResult["COLORS"] = $arColorNames;
	}
	
	$arElementData = Array();
	
	$arSelect = Array("ID", "IBLOCK_ID", "PROPERTY_CML2_LINK.ID", "PROPERTY_CML2_LINK.NAME", "PROPERTY_CML2_LINK.DETAIL_PAGE_URL", "DETAIL_PICTURE");
	$arFilter = Array("IBLOCK_ID"=>5, "ID"=>$arElements);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($ar_fields = $res->GetNext()){
	
		if ( $ar_fields["DETAIL_PICTURE"] ){
			$file = CFile::ResizeImageGet($ar_fields["DETAIL_PICTURE"], array('width'=>90, 'height'=>140), BX_RESIZE_IMAGE_PROPORTIONAL, true);                
			$ar_fields["DETAIL_PICTURE_SRC"] = $file['src'];
		}
		
		$arElementData[$ar_fields["ID"]] = Array(
			"NAME" => $ar_fields["PROPERTY_CML2_LINK_NAME"],
			"DETAIL_PAGE_URL" => $ar_fields["PROPERTY_CML2_LINK_DETAIL_PAGE_URL"],
			"PICTURE" => $ar_fields["DETAIL_PICTURE_SRC"],
			"ID" => $ar_fields["PROPERTY_CML2_LINK_ID"]
		);
		
		$arProducts[] 	= $ar_fields["PROPERTY_CML2_LINK_ID"];
	}
	
	$arArticules = Array();
	$arSelect = Array("ID", "IBLOCK_ID", "PROPERTY_CML2_ARTICLE");
	$arFilter = Array("IBLOCK_ID"=>4, "ID"=>$arProducts);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($ar_fields = $res->GetNext()){
	
		$arArticules[$ar_fields["ID"]] = $ar_fields["PROPERTY_CML2_ARTICLE_VALUE"];
	}
	
	foreach ( $arElementData as $key => $arVal ){
		$arElementData[$key]["ARTICLE"] = $arArticules[$arVal['ID']];
	}
	
	$arResult["ELEMENTS"] = $arElementData;

?>


<?
if(!function_exists('BITGetDeclNum'))
{

    /**
     * Возврат окончания слова при склонении
     *
     * Функция возвращает окончание слова, в зависимости от примененного к ней числа
     * Например: 5 товаров, 1 товар, 3 товара
     *
     * @param int $value - число, к которому необходимо применить склонение
     * @param array $status - массив возможных окончаний
     * @return mixed
     */
    function BITGetDeclNum($value=1, $status= array('','а','ов'))
    {
     $array =array(2,0,1,1,1,2);
     return $status[($value%100>4 && $value%100<20)? 2 : $array[($value%10<5)?$value%10:5]];
    }
}
?>


