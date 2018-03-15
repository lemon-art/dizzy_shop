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


		<div class="hero">
			<div class="hero__slider slick-c-dots" js-hero-slider>
            
				<?foreach($arResult["ITEMS"] as $arItem):?>
				
					<div class="hero__slide">
						<img class="hero__slide-bg" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" srcset="img/heroBg@2x.jpg 2x">
						<div class="hero__content">
							<div class="container container--grow">
								<div class="hero__name"><?=$arItem["PROPERTIES"]["title"]["VALUE"]?></div>
								<div class="hero__big"><?=$arItem["NAME"]?></div>
							</div>
						</div>
					</div>
					
				<?endforeach;?>
           
			</div>
        </div>

