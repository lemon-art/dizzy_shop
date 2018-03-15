<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$theme = COption::GetOptionString("main", "wizard_eshop_bootstrap_theme_id", "blue", SITE_ID);
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
global $USER;
if (empty($arResult))
	return;
?>
	<ul class="lk__nav-menu">
		<?foreach($arResult as $itemIdex => $arItem):?>
			<?if ($arItem["DEPTH_LEVEL"] == "1"):?>
			
				<li><a class="lk__nav-link <?if($arItem["SELECTED"]):?>is-active<?endif;?>" href="<?=$arItem["LINK"]?>"><?=htmlspecialcharsbx($arItem["TEXT"])?></a></li>
				
			<?endif?>
		<?endforeach;?>
		
			<?if($USER->IsAuthorized()):?>
				<li>
					<a class="lk__nav-exit" href="/?logout=yes">
						<svg class="ico ico-logout">
							<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/sprite.svg#ico-logout"></use>
						</svg>
						<u>Выход</u>
					</a>
				</li>
			<?endif;?>
		
	</ul>
