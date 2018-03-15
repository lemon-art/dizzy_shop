<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>


<?
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

if ( $_POST["productID"] ){

	$SKU_IBLOCK_ID = 5;
	CModule::IncludeModule("catalog");
	CModule::IncludeModule("sale");
	CModule::IncludeModule("iblock");
	CModule::IncludeModule('highloadblock');
	

	$arFilter = Array();
	$arFilter["IBLOCK_ID"] = $SKU_IBLOCK_ID;
	$arFilter["PROPERTY_CML2_LINK"] = $_POST["productID"];
	
	foreach ( $_POST["skuProps"] as $strSku ){
		$arSku = explode('_', $strSku);
		$propID = $arSku[0];
		$propValue = $arSku[1];
		
		$res = CIBlockProperty::GetByID($propID, $SKU_IBLOCK_ID);
		$arProp = $res->GetNext();
		
		if ( $arProp['CODE'] == 'COLOR_REF' ){
		
			$hlblock = HL\HighloadBlockTable::getById(1)->fetch(); // id highload блока
		    $entity = HL\HighloadBlockTable::compileEntity($hlblock);
		    $entityClass = $entity->getDataClass();

		   $res = $entityClass::getList(array(
			   'select' => array('UF_XML_ID'),
			   'filter' => array('ID' => $propValue)
		    ));

			$row = $res->fetch();
			$arFilter["PROPERTY_" . $propID] = $row["UF_XML_ID"];

		}
		else{
			$arFilter["PROPERTY_" . $propID . "_ENUM_ID"] = $propValue;
		}
	}
	
	$res = CIBlockElement::GetList(Array(), $arFilter, Array("ID", "NAME"));
	while($ar_fields = $res->GetNext())
	{
		$skuID = $ar_fields["ID"];
	}
	Add2BasketByProductID( $skuID, 1 );
}


?>