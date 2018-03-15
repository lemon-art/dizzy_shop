<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/**
 * @global string $componentPath
 * @global string $templateName
 * @var CBitrixComponentTemplate $this
 */
?>

				<?if ($arResult['NUM_PRODUCTS'] > 0):?>
					<a href="/personal/cart/">
						
						<svg class="ico ico-cart">
							<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/sprite.svg#ico-cart"></use>
						</svg>
						<div class="header__cart-counter"><span><?=$arResult['NUM_PRODUCTS']?></span></div>
						
					</a>
				
				<?else:?>
					
					<svg class="ico ico-cart">
						<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/sprite.svg#ico-cart"></use>
					</svg>
				
				<?endif;?>
					
