<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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


?>



	<div class="benefits">
        <div class="container">
            <div class="benefits__wrapper">
				<?foreach($arResult["ITEMS"] as $key=> $arItem):?>
				
					<div class="benefits__card">
						<div class="benefits__card-icon">
							<svg class="ico ico-sewing-machine">
								<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/sprite.svg#<?=$arItem['PROPERTIES']['icon']['VALUE']; ?>"></use>
							</svg>
						</div>
						<div class="benefits__card-name"><?=$arItem["NAME"]?></div>
						<div class="benefits__card-plus" js-popup data-mfp-src="#mfpBenefits">
							<svg class="ico ico-plus">
								<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/sprite.svg#ico-plus"></use>
							</svg>
						</div>
					</div>
					
				<?endforeach;?>

            </div>
        </div>
    </div>
	
        <!-- POPUP DIALOG-->
    <div class="popup-dialog popup-benefits mfp-hide" id="mfpBenefits">
        <div class="popup-benefits-slides" data-benefits-slides>
			
			<?foreach($arResult["ITEMS"] as $key=> $arItem):?>
		
				<div class="popup-benefits__content">
					<div class="popup-benefits__title"><?=$arItem["NAME"]?></div>
					<div class="popup-benefits__text">
						<p><?=$arItem["PREVIEW_TEXT"]?></p>
					</div>
					<div class="popup-benefits__ico-bg">
						<svg class="ico ico-sewing-machine">
							<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/sprite.svg#<?=$arItem['PROPERTIES']['icon']['VALUE']; ?>"></use>
						</svg>
					</div>
				</div>
				
			<?endforeach;?>	
		
        </div>
    </div>



