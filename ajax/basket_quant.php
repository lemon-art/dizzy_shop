<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>	




<?
	CModule::IncludeModule("catalog");
	CModule::IncludeModule("sale");
	CModule::IncludeModule("iblock");
	

	
	if ( $_POST["id_basket"] ) {
	
		$arFields = array(
			"QUANTITY" => $_POST["quantity"],
		);
		CSaleBasket::Update($_POST["id_basket"], $arFields);
	}
	else {
		Add2BasketByProductID( $_POST["product_id"], $_POST["quantity"] );
	}
	
	
?>