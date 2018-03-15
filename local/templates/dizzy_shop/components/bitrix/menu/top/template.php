<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);

if (empty($arResult["ALL_ITEMS"]))
	return;

CUtil::InitJSCore();

?>





			<ul class="navi__menu" js-teleport data-teleport-to="mobile-menu" data-teleport-condition="&lt;768">

				<?foreach($arResult["MENU_STRUCTURE"] as $itemID => $arColumns):?>
				
					<?$arItem = $arResult["ALL_ITEMS"][$itemID];?>
					
					<?if ( $arItem["IS_PARENT"] ):?>
						<li>
							<a class="js-navi-drop" href="<?=$arItem["LINK"]?>" js-navi-drop data-for="<?=$arItem["PARAMS"]["item_id"]?>"><?=$arItem["TEXT"]?></a>
						</li>
					<?else:?>
						<li>
							<a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
						</li>
					<?endif;?>
				
				<?endforeach;?>
				
			</ul>

	
	
	
	
	