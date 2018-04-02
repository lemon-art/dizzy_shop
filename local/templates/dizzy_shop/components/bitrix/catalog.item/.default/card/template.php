<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var CatalogSectionComponent $component
 */
?>




                    <div class="c-card__wrapper">
					
					
						
						<?if ($item['LABEL']):?>
							<?foreach ($item['LABEL_ARRAY_VALUE'] as $code => $value):?>
								<div class="c-card__label c-card__label_<?=$code?>"><?=$value?></div>
							<?endforeach;?>
						<?endif;?>
						<?if ( $price['DISCOUNT'] ):?>
							<div class="c-card__label c-card__label_sale">Распродажа</div>
						<?endif;?>
						
                        <div class="c-card__ctrl">
							<a class="c-card__ctrl-link popup_size" href="#" data-mfp-src="/ajax/popup_size.php?ELEMENT_ID=<?=$item['ID']?>" title="В корзину">
								<svg class="ico ico-cart">
									<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/sprite.svg#ico-cart"></use>
								</svg>
							</a>
							
							<a class="c-card__ctrl-link btn-like-button <?if ( in_array($item['ID'], $item["FAVORITES"])):?>active<?endif;?>" data-id="<?=$item['ID']?>" href="#" title="<?if ( in_array($item['ID'], $item["FAVORITES"])):?>Убрать из избранного<?else:?>В избранное<?endif;?>">
								<svg class="ico ico-like">
									<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/sprite.svg#ico-like"></use>
								</svg>
							</a>
							
						</div>
                        <div class="c-card__slides" data-card-slides>
							<?foreach ($morePhoto as $key => $photo):?>
								<a class="c-card__image" href="<?=$item['DETAIL_PAGE_URL']?>">
									<img src="<?=$photo['BIG_SRC']?>" srcset="<?=$photo['SMALL_SRC']?>">
								</a>
							<?endforeach;?>
						</div>
						
                        <div class="c-card__thumbs" data-card-thumbs>
							<?foreach ($morePhoto as $key => $photo):?>
								<a class="c-card__thumb" href="#">
									<img src="<?=$photo['BIG_SLIDER_SRC']?>" srcset="<?=$photo['SMALL_SLIDER_SRC']?>">
								</a>
							<?endforeach;?>
						</div>
						
                    </div>
					
					<a class="c-card__name" href="<?=$item['DETAIL_PAGE_URL']?>"><?=$item['NAME']?></a>
                      
					<div class="c-card__category">Куртка</div>
                      
					<div class="c-card__price">
						<?=$price['PRINT_PRICE'];?>
						<?if ( $price['DISCOUNT'] ):?>
							<span class="c-card__price-old"><?=$price['PRINT_BASE_PRICE'];?></span>
						<?endif;?>
						
					
					
					</div>
                      
					<div class="c-card__size">
						<b>Размеры:</b> 
						<?$arSizes = Array();?>
						<?foreach ($arParams['SKU_PROPS']['SIZES_CLOTHES']['VALUES'] as $value):?>
						
							<?if ($value['NAME'] == '-' )
								continue;
								$value['NAME'] = htmlspecialcharsbx($value['NAME']);
							?>
							
							<?$arSizes[] = $value['NAME']?>
							
						<?endforeach;?>
						<?echo implode($arSizes, ', ');?> 
					</div>
                      
					<button class="c-card__view fast_view" data-mfp-src="/ajax/fast_element.php?ELEMENT_ID=<?=$item['ID']?>">
						Быстрый просмотр
                        
						<svg class="ico ico-eye">
							<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/sprite.svg#ico-eye"></use>
                        </svg>
						
                    </button>
					

