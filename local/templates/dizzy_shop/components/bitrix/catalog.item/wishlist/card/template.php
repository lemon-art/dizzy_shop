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





                    <tr>
                      <td>4</td>
                      <td>
                        <div class="lk__products-item">
							<a href="<?=$item['DETAIL_PAGE_URL']?>">
								<figure class="lk__products-image">
									<img src="<?=$item['PHOTO']?>" alt="">
								</figure>
							</a>
                          <div class="lk__products-desc">
                            <h2 class="lk__products-title"><a href="<?=$item['DETAIL_PAGE_URL']?>"><?=$item['NAME']?></a></h2>
                            <ul class="lk__products-info">
                              <li><mark>Артикул:</mark> <?=$item['PROPERTIES']['CML2_ARTICLE']['VALUE']?></li>
                              <li><mark>Коллекция:</mark> <a href="#">Осень-Зима 2017</a></li>
                              <li><mark>Размер:</mark> 
								<?$arSizes = Array();?>
								<?foreach ($arParams['SKU_PROPS']['SIZES_CLOTHES']['VALUES'] as $value):?>
								
									<?if ($value['NAME'] == '-' )
										continue;
										$value['NAME'] = htmlspecialcharsbx($value['NAME']);
									?>
									
									<?$arSizes[] = $value['NAME']?>
									
								<?endforeach;?>
								<?echo implode($arSizes, ', ');?> 
							  </li>
                              <li><mark>Цвет:</mark> <?=$item['DISPLAY_PROPERTIES']['COLOR']['DISPLAY_VALUE']?></li>
                            </ul>
                          </div>
                        </div>
                      </td>
                      <td data-text="Цена: ">
					  	<?=$price['PRINT_PRICE'];?>
						<?if ( $price['DISCOUNT'] ):?>
							<span class="c-card__price-old"><?=$price['PRINT_BASE_PRICE'];?></span>
						<?endif;?>
					  </td>
                      <td data-text="Статус: ">
						<?if ( $item['CATALOG_AVAILABLE'] == 'Y' ):?>
							Есть на складе
						<?else:?>
							Нет на складе
						<?endif;?>
					  </td>
                      <td data-ctrl>
						<div class="lk__products-ctrl">
							<a class="lk__products-delete btn-like active" data-id="<?=$item['ID']?>" href="#">
								<svg class="ico ico-delete">
									<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/sprite.svg#ico-delete"></use>
								</svg>Удалить
							</a>
					  
							<?if ( $item['CATALOG_AVAILABLE'] == 'Y' ):?>
								<a class="btn btn-primary-small popup_size" data-mfp-src="/ajax/popup_size.php?ELEMENT_ID=<?=$item['ID']?>" href="#"><span>В корзину</span></a>
							<?else:?>
								<a class="btn btn-primary-small" href="#"><span>Сообщить, когда появится</span></a>
							<?endif;?>
						</div>
					  </td>
                    </tr>



                  

