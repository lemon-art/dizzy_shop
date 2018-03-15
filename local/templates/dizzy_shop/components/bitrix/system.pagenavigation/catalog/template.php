<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

if (!$arResult["NavShowAlways"]) {
    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
        return;
}




$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"] . "&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?" . $arResult["NavQueryString"] : "");
?>


		
			<?if ( $arResult["nStartPage"] < $arResult["nEndPage"]):?>
				<div class="pages">
					<span class="pages__text">Страница:</span>
				
					<? while ($arResult["nStartPage"] <= $arResult["nEndPage"]): ?>
						
						<? if ($arResult["nStartPage"] == $arResult["NavPageNomer"]): ?>
							<a class="pages__link is-active" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"><?=$arResult["nStartPage"]?></a>
						<?else:?>
							<a class="pages__link" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"><?=$arResult["nStartPage"]?></a>
						<?endif;?>
						
						<? $arResult["nStartPage"]++ ?>
					<?endwhile;?>
					
				</div>
			<?endif;?>

	
	