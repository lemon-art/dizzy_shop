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



	<div class="home-catalog">
        <div class="container">
            <div class="title">
				<a href="/catalog/"><?=GetMessage('TITLE_SECTIONS')?></a>
			</div>
            <div class="home-catalog__wrapper">
				<div class="row">
					<?foreach($arResult["ITEMS"] as $key=> $arSection):?>
						
						<div class="col-md-6 <?if ($key>2):?>col-lg-3<?else:?>col-lg-4<?endif;?>">
							<a class="catalog-card <?=$arSection['PROPERTIES']['color']['VALUE']; ?>" href="<?=$arSection['PROPERTIES']['link']['VALUE']; ?>">
								<div class="catalog-card__image <?=$arSection['PROPERTIES']['img_style']['VALUE']; ?>" style="<?=$arStyles[$key]?>">
									<img src="<?=$arSection['PREVIEW_PICTURE']['SRC']?>">
								</div>
								<div class="catalog-card__content <?=$arSection['PROPERTIES']['style']['VALUE']; ?>">
									<div class="catalog-card__name"><?=$arSection["NAME"]?></div>
									<div class="catalog-card__short"><?=$arSection["PREVIEW_TEXT"]?></div>
								</div>
							</a>
						</div>
						
					<?endforeach;?>
					
                
				</div>
            </div>
        </div>
    </div>


