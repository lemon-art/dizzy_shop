<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");

CSaleBasket::Delete($_POST["id"]);

   
?>
  
