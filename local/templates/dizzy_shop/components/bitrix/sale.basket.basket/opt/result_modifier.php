<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
if (array_key_exists('is_ajax', $_REQUEST) && $_REQUEST['is_ajax']=='y') {
    $APPLICATION->RestartBuffer();
}

$arElements = Array();
$arElementsCartData = Array();
$arProducts = Array();
$arQuantity = Array();
$arBasket= Array();

foreach ($arResult["GRID"]["ROWS"] as $k => $arItem){
	$arElements[] = $arItem['PRODUCT_ID'];
	$arElementsCartData[ $arItem['PRODUCT_ID'] ] = $arItem;
	$arQuantity[ $arItem['PRODUCT_ID'] ] = Array(
		"BASKET_ID" => $arItem['ID'],
		"QUANTITY" 	=> $arItem['QUANTITY']
	);
}

	
	$arElementData = Array();
	$arPriceData = Array();
	
	$arSelect = Array("ID", "IBLOCK_ID", "PROPERTY_CML2_LINK.ID", "PROPERTY_CML2_LINK.NAME", "PROPERTY_CML2_LINK.DETAIL_PAGE_URL", "PROPERTY_CML2_LINK.DETAIL_PICTURE", "DETAIL_PICTURE");
	$arFilter = Array("IBLOCK_ID"=>5, "ID"=>$arElements);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($ar_fields = $res->GetNext()){
	
	
		$arPriceData[$ar_fields["PROPERTY_CML2_LINK_ID"]] = Array(
			"PRICE" 	 => $arElementsCartData[$ar_fields['ID']]['PRICE'],
			"FULL_PRICE" => ($arPriceData[$ar_fields["PROPERTY_CML2_LINK_ID"]]["FULL_PRICE"] + $arElementsCartData[$ar_fields['ID']]['PRICE'] * $arElementsCartData[$ar_fields['ID']]['QUANTITY'])
		);

	
		if ( $ar_fields["PROPERTY_CML2_LINK_DETAIL_PICTURE"] ){
			$file = CFile::ResizeImageGet($ar_fields["PROPERTY_CML2_LINK_DETAIL_PICTURE"], array('width'=>90, 'height'=>140), BX_RESIZE_IMAGE_PROPORTIONAL, true);                
			$ar_fields["DETAIL_PICTURE_SRC"] = $file['src'];
		}
		
		$arElementData[$ar_fields["PROPERTY_CML2_LINK_ID"]] = Array(
			"NAME" => $ar_fields["PROPERTY_CML2_LINK_NAME"],
			"DETAIL_PAGE_URL" => $ar_fields["PROPERTY_CML2_LINK_DETAIL_PAGE_URL"],
			"PICTURE" => $ar_fields["DETAIL_PICTURE_SRC"]
		);
	
		if ( !in_array(  $ar_fields["PROPERTY_CML2_LINK_ID"], $arProducts ) )
			$arProducts[] = $ar_fields["PROPERTY_CML2_LINK_ID"];
	}
	
	$arResult["ELEMENTS"] = $arProducts;
	$arResult["ELEMENTS_DATA"] = $arElementData;
	$arResult["PRICE_DATA"] = $arPriceData;
	$arResult["QUANTITY_CART"] = $arQuantity;
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


