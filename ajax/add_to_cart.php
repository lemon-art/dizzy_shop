<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?


if ( $_POST["productID"] ){

	$SKU_IBLOCK_ID = 5;
	CModule::IncludeModule("catalog");
	CModule::IncludeModule("sale");
	CModule::IncludeModule("iblock");
	

	$arFilter = Array();
	$arFilter["IBLOCK_ID"] = $SKU_IBLOCK_ID;
	$arFilter["PROPERTY_CML2_LINK"] = $_POST["productID"];
	
	foreach ( $_POST["skuProps"] as $strSku ){
		$arSku = explode('_', $strSku);
		$propID = $arSku[0];
		$propValue = $arSku[1];
		
		$res = CIBlockProperty::GetByID($propID, $SKU_IBLOCK_ID);
		$arProp = $res->GetNext();
		
		$arFilter["PROPERTY_" . $propID . "_ENUM_ID"] = $propValue;
	}
	
	$res = CIBlockElement::GetList(Array(), $arFilter, Array("ID", "NAME"));
	while($ar_fields = $res->GetNext())
	{
		$skuID = $ar_fields["ID"];
	}
	
	Add2BasketByProductID( $skuID, 1 );
}


?>