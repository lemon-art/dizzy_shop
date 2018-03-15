<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$class = "news-card--bg-peach";
$i = 0;

foreach($arResult["ITEMS"] as $key => $arItem){
	if ( !$arItem["PREVIEW_PICTURE"]["SRC"] ){
	
		if ( !$i ){
			$arResult["ITEMS"][$key]["CLASS"] = $class;
			$i = 1;
		}
		else {
			$i = 0;
		}
		
	
	}
}