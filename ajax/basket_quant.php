<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>	

<?
	CModule::IncludeModule('sale');
	
	if ( $_POST["id_basket"] ) {
	
		$arFields = array(
		   "QUANTITY" => $_POST["quantity"],
		);
		CSaleBasket::Update($_POST["id_basket"], $arFields);
	}
	
	
?>