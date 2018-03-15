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


<div class="home-news">
    <div class="container">
        <div class="title">
			<a href="/news/"><?=GetMessage('TITLE')?></a>
		</div>
            <div class="home-news__wrapper">
				<div class="row">
			  
					<?foreach($arResult["ITEMS"] as $arItem):?>
						<?
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						?>
			  
							<div class="col-md-6 col-lg-4"  id="<?=$this->GetEditAreaId($arItem['ID']);?>">
								<a class="news-card <?=$arItem["CLASS"]?>" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
									<?if ( $arItem["PREVIEW_PICTURE"]["SRC"] ):?>
										<div class="news-card__image news-card__image--filter">
											<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" srcset="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>">
										</div>
									<?endif;?>
									<div class="news-card__content">
										<div class="news-card__date"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></div>
										<div class="news-card__name"><?=$arItem["NAME"]?></div>
									</div>
								</a>
							</div>
							
					<?endforeach;?>
					
   
				</div>
            </div>
    </div>
</div>


