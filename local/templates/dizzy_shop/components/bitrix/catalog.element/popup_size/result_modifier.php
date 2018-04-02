<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

?>

<?

//проверяем доступность предложений
$arSizesNotAvalible;
foreach( $arResult['OFFERS'] as $arOffer ){
	if ( $arOffer['CATALOG_QUANTITY'] <= 0 ){
		$arSizesNotAvalible[] = $arOffer['TREE']['PROP_78'];
	}
}
foreach ($arResult['SKU_PROPS'] as $key => $skuProperty){
	foreach ($skuProperty['VALUES'] as $keyVal => $arVal ){
		if ( in_array($arVal['ID'], $arSizesNotAvalible )){
			unset($arResult['SKU_PROPS'][$key]['VALUES'][$keyVal]);
		}
		
	}
}

?>




