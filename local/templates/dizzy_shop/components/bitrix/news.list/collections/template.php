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


    <div class="collections">
        <div class="container">

			<?foreach($arResult["ITEMS"] as $arItem):?>

				<a class="collections__card" href="<?=$arItem["PROPERTIES"]["link"]["VALUE"]?>">
					<img class="collections__card-bg" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" srcset="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>">
					<div class="collections__content">
						<div class="collections__name"><?=GetMessage("COLLECTION")?></div>
						<div class="collections__big"><?=$arItem["NAME"]?></div>
					</div>
					<?if ( $arItem["PROPERTIES"]["tag"]["VALUE"] ):?>
						<div class="collections__tag"><?=$arItem["PROPERTIES"]["tag"]["VALUE"]?></div>
					<?endif;?>
				</a>
				
			<?endforeach;?>
			
		</div>
	</div>
