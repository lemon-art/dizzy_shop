<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<?$prevLevel = 1;?>
<div class="filter-group">
    <div class="filter-group__btn">Категория</div>
        <div class="filter-group__content">

			<?
			foreach($arResult as $arItem):
				if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
					continue;
			?>
			
				<?if ( $arItem["DEPTH_LEVEL"] == 1):?>
				
					<?if ( $prevLevel > 1 ):?>
						</ul>
					<?endif;?>
					
					<div class="filter__title open" id="catalog-<?=$arItem["CODE"]?>">
                        <button class="btn filter__arrow-btn" data-toggle-class="open" data-toggle-class-element="#catalog-<?=$arItem["CODE"]?>"></button>
						<a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                    </div>
				<?else:?>
					<?if ( $prevLevel < $arItem["DEPTH_LEVEL"] ):?>
						<ul class="filter__menu">
					<?endif;?>
						<li><a class="filter__link <?if($arItem["SELECTED"]):?>active<?endif;?>" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?> </a></li>
						
				<?endif;?>
					
				<?$prevLevel = $arItem["DEPTH_LEVEL"];?>
			<?endforeach?>

		<?if ( $prevLevel > 1 ):?>
			</ul>
		<?endif;?>
		
		</div>
	</div>

		
<?endif?>