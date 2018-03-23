<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>


<?



if ( is_array($_POST) ){


	CModule::IncludeModule("catalog");
	CModule::IncludeModule("sale");
	CModule::IncludeModule("iblock");

	

	
	foreach ( $_POST as $key => $quantity ){
		
		if ( $quantity > 0 ){
		
			$arProd = explode('_', $key);
			
			Add2BasketByProductID( $arProd[1], $quantity );
			
		}
	}
}


?>