<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
CModule::IncludeModule('highloadblock');

$arColors = Array();
$arColorNames = Array();
$arProducts = Array();
/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */
	$arElements = Array();
	foreach ($arResult['ORDERS'] as $key => $order){
		foreach ( $order['BASKET_ITEMS'] as $arPropduct){
			$arElements[] = $arPropduct["PRODUCT_ID"];
		}
	}

	$arElementData = Array();
	
	$arSelect = Array("ID", "IBLOCK_ID", "PROPERTY_COLOR_REF", "PROPERTY_SIZES_CLOTHES", "PROPERTY_CML2_LINK.ID", "PROPERTY_CML2_LINK.NAME", "PROPERTY_CML2_LINK.DETAIL_PAGE_URL", "DETAIL_PICTURE");
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
			"ID" => $ar_fields["PROPERTY_CML2_LINK_ID"],
			"SIZE" => $ar_fields["PROPERTY_SIZES_CLOTHES_VALUE"],
			"COLOR" => $ar_fields["PROPERTY_COLOR_REF_VALUE"],
		);
		
		$arColors[] 	= $ar_fields["PROPERTY_COLOR_REF_VALUE"];
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
			
			foreach ( $arElementData as $key => $arVal ){
				$arElementData[$key]["COLOR"] = $arColorNames[$arVal['COLOR']];
			}

	}
	
	
	$arResult["ELEMENTS"] = $arElementData;
	
	

?>