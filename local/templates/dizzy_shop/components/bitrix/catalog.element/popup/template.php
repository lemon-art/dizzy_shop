<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);

$templateLibrary = array('popup', 'fx');
$currencyList = '';

if (!empty($arResult['CURRENCIES']))
{
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
	'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList,
	'ITEM' => array(
		'ID' => $arResult['ID'],
		'IBLOCK_ID' => $arResult['IBLOCK_ID'],
		'OFFERS_SELECTED' => $arResult['OFFERS_SELECTED'],
		'JS_OFFERS' => $arResult['JS_OFFERS']
	)
);
unset($currencyList, $templateLibrary);

$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
	'ID' => $mainId,
	'DISCOUNT_PERCENT_ID' => $mainId.'_dsc_pict',
	'STICKER_ID' => $mainId.'_sticker',
	'BIG_SLIDER_ID' => $mainId.'_big_slider',
	'BIG_IMG_CONT_ID' => $mainId.'_bigimg_cont',
	'SLIDER_CONT_ID' => $mainId.'_slider_cont',
	'OLD_PRICE_ID' => $mainId.'_old_price',
	'PRICE_ID' => $mainId.'_price',
	'DISCOUNT_PRICE_ID' => $mainId.'_price_discount',
	'PRICE_TOTAL' => $mainId.'_price_total',
	'SLIDER_CONT_OF_ID' => $mainId.'_slider_cont_',
	'QUANTITY_ID' => $mainId.'_quantity',
	'QUANTITY_DOWN_ID' => $mainId.'_quant_down',
	'QUANTITY_UP_ID' => $mainId.'_quant_up',
	'QUANTITY_MEASURE' => $mainId.'_quant_measure',
	'QUANTITY_LIMIT' => $mainId.'_quant_limit',
	'BUY_LINK' => $mainId.'_buy_link',
	'ADD_BASKET_LINK' => $mainId.'_add_basket_link',
	'BASKET_ACTIONS_ID' => $mainId.'_basket_actions',
	'NOT_AVAILABLE_MESS' => $mainId.'_not_avail',
	'COMPARE_LINK' => $mainId.'_compare_link',
	'TREE_ID' => $mainId.'_skudiv',
	'DISPLAY_PROP_DIV' => $mainId.'_sku_prop',
	'DISPLAY_MAIN_PROP_DIV' => $mainId.'_main_sku_prop',
	'OFFER_GROUP' => $mainId.'_set_group_',
	'BASKET_PROP_DIV' => $mainId.'_basket_prop',
	'SUBSCRIBE_LINK' => $mainId.'_subscribe',
	'TABS_ID' => $mainId.'_tabs',
	'TAB_CONTAINERS_ID' => $mainId.'_tab_containers',
	'SMALL_CARD_PANEL_ID' => $mainId.'_small_card_panel',
	'TABS_PANEL_ID' => $mainId.'_tabs_panel'
);
$obName = $templateData['JS_OBJ'] = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $mainId);
$name = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
	: $arResult['NAME'];
$title = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE']
	: $arResult['NAME'];
$alt = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']
	: $arResult['NAME'];

$haveOffers = !empty($arResult['OFFERS']);
if ($haveOffers)
{
	$actualItem = isset($arResult['OFFERS'][$arResult['OFFERS_SELECTED']])
		? $arResult['OFFERS'][$arResult['OFFERS_SELECTED']]
		: reset($arResult['OFFERS']);
	$showSliderControls = false;

	foreach ($arResult['OFFERS'] as $offer)
	{
		if ($offer['MORE_PHOTO_COUNT'] > 1)
		{
			$showSliderControls = true;
			break;
		}
	}
}
else
{
	$actualItem = $arResult;
	$showSliderControls = $arResult['MORE_PHOTO_COUNT'] > 1;
}




$skuProps = array();
$price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
$measureRatio = $actualItem['ITEM_MEASURE_RATIOS'][$actualItem['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
$showDiscount = $price['PERCENT'] > 0;

$showDescription = !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
$showBuyBtn = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION']);
$buyButtonClassName = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showAddBtn = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']);
$showButtonClassName = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showSubscribe = $arParams['PRODUCT_SUBSCRIPTION'] === 'Y' && ($arResult['CATALOG_SUBSCRIBE'] === 'Y' || $haveOffers);

$arParams['MESS_BTN_BUY'] = $arParams['MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCE_CATALOG_BUY');
$arParams['MESS_BTN_ADD_TO_BASKET'] = $arParams['MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCE_CATALOG_ADD');
$arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE'] ?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE');
$arParams['MESS_BTN_COMPARE'] = $arParams['MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_BCE_CATALOG_COMPARE');
$arParams['MESS_PRICE_RANGES_TITLE'] = $arParams['MESS_PRICE_RANGES_TITLE'] ?: Loc::getMessage('CT_BCE_CATALOG_PRICE_RANGES_TITLE');
$arParams['MESS_DESCRIPTION_TAB'] = $arParams['MESS_DESCRIPTION_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_DESCRIPTION_TAB');
$arParams['MESS_PROPERTIES_TAB'] = $arParams['MESS_PROPERTIES_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_PROPERTIES_TAB');
$arParams['MESS_COMMENTS_TAB'] = $arParams['MESS_COMMENTS_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_COMMENTS_TAB');
$arParams['MESS_SHOW_MAX_QUANTITY'] = $arParams['MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_BCE_CATALOG_SHOW_MAX_QUANTITY');
$arParams['MESS_RELATIVE_QUANTITY_MANY'] = $arParams['MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['MESS_RELATIVE_QUANTITY_FEW'] = $arParams['MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_FEW');

$positionClassMap = array(
	'left' => 'product-item-label-left',
	'center' => 'product-item-label-center',
	'right' => 'product-item-label-right',
	'bottom' => 'product-item-label-bottom',
	'middle' => 'product-item-label-middle',
	'top' => 'product-item-label-top'
);

$discountPositionClass = 'product-item-label-big';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION']))
{
	foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos)
	{
		$discountPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$labelPositionClass = 'product-item-label-big';
if (!empty($arParams['LABEL_PROP_POSITION']))
{
	foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos)
	{
		$labelPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}
?>


<div class="popup-dialog popup-fast">
    <div class="popup-fast__title">Быстрый просмотр</div>
        <div class="popup-fast__content">

	<div class="card bx-catalog-element" id="<?=$itemIds['ID']?>" itemscope itemtype="http://schema.org/Product">
	
			
            <div class="row">
              <div class="col-md-6 col-lg-7">
                <!-- Gallery :: START-->
                <div class="gallery" data-gallery>
					<?if (!empty($arResult['SKU_PHOTO'])):?>
						<div class="gallery-slides" data-gallery-slides>
					
							<?foreach ($arResult['SKU_PHOTO'] as $key => $photo):?>
							
								<div class="gallery-slides__item">
									<figure class="gallery-slides__image">
										<img src="<?=$photo['BIG']?>" data-zoom-image="<?=$photo['ORIGINAL']?>">
									</figure>
									<a class="gallery-slides__zoom" href="<?=$photo['ORIGINAL']?>" data-mfp-galllery>
										<svg class="ico ico-zoom">
										  <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/sprite.svg#ico-zoom"></use>
										</svg>
									</a>
								</div>
							
							<?endforeach;?>
						</div>
						
						<div class="gallery-thumbs" data-gallery-thumbs>
							<?foreach ($arResult['SKU_PHOTO'] as $key => $photo):?>
								<div class="gallery-thumbs__item"><img src="<?=$photo['SLIDER']?>"></div>
							<?endforeach;?>
						</div>
					<?endif;?>
					
					

                </div>
                <!-- Gallery :: END-->
              </div>
              <div class="col-md-6 col-lg-5">
                <h1 class="card__heading"><?=$name?></h1>
                <ul class="card__info">
                  <li><mark>Артикул:</mark> <?=$arResult['PROPERTIES']['CML2_ARTICLE']['VALUE']?></li>
                  <li><mark>Коллекция:</mark> <a href="#" class="link-dark">Осень-Зима 2017</a></li>
                </ul>
                <div class="card__price">
				
		
                  <p class="card__price-text product-item-detail-price-current" id="<?=$itemIds['PRICE_ID']?>">
					<?=$price['PRINT_RATIO_PRICE']?> <b>₽</b> 
					<small>Розничная цена</small>
				  </p>
				  
				  <a class="card__price-link" href="#">
                    <svg class="ico ico-commerce">
                      <use xlink:href="img/sprite.svg#ico-commerce"></use>
                    </svg>
                    <u>Показать оптовую цену</u></a>
                </div>
				<div id="<?=$itemIds['TREE_ID']?>">
					<?foreach ($arResult['SKU_PROPS'] as $skuProperty):?>				
					
						<?if (!isset($arResult['OFFERS_PROP'][$skuProperty['CODE']]))
							continue;?>
						<?
							$propertyId = $skuProperty['ID'];
							$skuProps[] = array(
								'ID' => $propertyId,
								'SHOW_MODE' => $skuProperty['SHOW_MODE'],
								'VALUES' => $skuProperty['VALUES'],
								'VALUES_COUNT' => $skuProperty['VALUES_COUNT']
							);
						?>

						<?if ($skuProperty['SHOW_MODE'] === 'PICT'):?>
						
							<div class="card__colors" data-entity="sku-line-block">
								<p class="card__colors-text"><mark><?=$skuProperty['NAME']?>:</mark>
									<span data-color-selected><?=$skuProperty['VALUES'][0]['NAME']?></span>
								</p>
								
					  
								<div class="card__colors-group">
									<?foreach ($skuProperty['VALUES'] as $key=>&$value):?>
									
										<?if ( $key ):?>
											<div class="card__colors-item row_prop_sku" data-color="<?=$value['NAME']?>" 
												data-treevalue="<?=$propertyId?>_<?=$value['ID']?>" data-onevalue="<?=$value['ID']?>">
												<?if ( $arResult['SKU_PHOTO'][$value['ID']]["SMALL"] ):?>
													<img src="<?=$arResult['SKU_PHOTO'][$value['ID']]["SMALL"]?>">
												<?else:?>
													<img src="<?=$value['PICT']['SRC']?>">
												<?endif;?>
											</div>
										<?endif;?>
								   
									<?endforeach;?>
								</div>
							</div>
							
						<?else:?>
							<div class="card__size" data-entity="sku-line-block">
								<p class="card__size-text">Размер:</p>
								<a class="card__size-link" href="#" data-mfp-src="#popup-sizes" js-popup>
									<svg class="ico ico-size">
									  <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/sprite.svg#ico-size"></use>
									</svg>
									<u>Таблица размеров</u>
								</a>
								<div class="card__size-group">
									<?foreach ($skuProperty['VALUES'] as $key => &$value):?>
										<?if ( $key ):?>
											<label class="card__check row_prop_sku" data-treevalue="<?=$propertyId?>_<?=$value['ID']?>" data-onevalue="<?=$value['ID']?>" >
												<input class="card__check-input" type="checkbox"><span class="card__check-btn"><?=$value['NAME']?></span>
											</label>
										<?endif;?>
									<?endforeach;?>
								
								</div>
							</div>
							
						<?endif;?>
						
					<?endforeach;?>
				</div>
				
                <div class="card__ctrl" data-entity="main-button-container">
					<div id="<?=$itemIds['BASKET_ACTIONS_ID']?>"> 
						<a class="btn btn-primary <?=$showButtonClassName?> add-to-cart" href="javascript:void(0);" id="<?=$itemIds['ADD_BASKET_LINK']?>">
							<span>Добавить в корзину</span>
						</a>
					</div>
					
					<a class="btn btn-like" data-id="<?=$arResult['ID']?>" href="#">
						<u class="btn-like-icon">
						  <svg class="ico ico-like">
							<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/sprite.svg#ico-like"></use>
						  </svg>
						</u>
						<span>Добавить в список<br>желаний</span>
					</a>
				</div>
				
                <dl class="card__details">
                  <dt>Информация о товаре:</dt>
                  <dd>
                    <?=$arResult['DETAIL_TEXT']?>
                    <ul>
					
										<?
										foreach ($arResult['DISPLAY_PROPERTIES'] as $property)
										{
											?>
											<li>
												<mark><?=$property['NAME']?>:</mark> 
												<?=(
												is_array($property['DISPLAY_VALUE'])
													? implode(' / ', $property['DISPLAY_VALUE'])
													: $property['DISPLAY_VALUE']
												)?>
											</li>
											<?
										}
										unset($property);
										?>
                    </ul>
                  </dd>
                  <dt>Доставка</dt>
                  <dd>Далеко-далеко за словесными горами в стране, гласных и согласных живут рыбные тексты. Журчит прямо по всей вскоре инициал выйти всеми продолжил, коварный продолжил, свой подзаголовок речью реторический города жизни которое своих семантика, своих.</dd>
                  <dt>Возврат</dt>
                  <dd>Далеко-далеко за словесными горами в стране, гласных и согласных живут рыбные тексты. Журчит прямо по всей вскоре инициал выйти всеми продолжил, коварный продолжил, свой подзаголовок речью реторический города жизни которое своих семантика, своих.</dd>
                  <dt>Для оптовых клиентов</dt>
                  <dd>Далеко-далеко за словесными горами в стране, гласных и согласных живут рыбные тексты. Журчит прямо по всей вскоре инициал выйти всеми продолжил, коварный продолжил, свой подзаголовок речью реторический города жизни которое своих семантика, своих.</dd>
                </dl>
              </div>
            </div>
        </div>
		</div>	
	</div>	
	
		
		<?
		
		
		$jsParams = array(
		'CONFIG' => array(
			'USE_CATALOG' => $arResult['CATALOG'],
			'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
			'SHOW_PRICE' => true,
			'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
			'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] === 'Y',
			'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
			'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
			'SHOW_SKU_PROPS' => $arResult['SHOW_OFFERS_PROPS'],
			'OFFER_GROUP' => $arResult['OFFER_GROUP'],
			'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
			'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
			'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
			'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
			'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
			'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
			'USE_STICKERS' => true,
			'USE_SUBSCRIBE' => $showSubscribe,
			'SHOW_SLIDER' => $arParams['SHOW_SLIDER'],
			'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
			'ALT' => $alt,
			'TITLE' => $title,
			'MAGNIFIER_ZOOM_PERCENT' => 200,
			'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
			'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
			'BRAND_PROPERTY' => !empty($arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']])
				? $arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]['DISPLAY_VALUE']
				: null
		),
		'PRODUCT_TYPE' => $arResult['CATALOG_TYPE'],
		'VISUAL' => $itemIds,
		'DEFAULT_PICTURE' => array(
			'PREVIEW_PICTURE' => $arResult['DEFAULT_PICTURE'],
			'DETAIL_PICTURE' => $arResult['DEFAULT_PICTURE']
		),
		'PRODUCT' => array(
			'ID' => $arResult['ID'],
			'ACTIVE' => $arResult['ACTIVE'],
			'NAME' => $arResult['~NAME'],
			'CATEGORY' => $arResult['CATEGORY_PATH']
		),
		'BASKET' => array(
			'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
			'BASKET_URL' => $arParams['BASKET_URL'],
			'SKU_PROPS' => $arResult['OFFERS_PROP_CODES'],
			'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
			'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
		),
		'OFFERS' => $arResult['JS_OFFERS'],
		'OFFER_SELECTED' => $arResult['OFFERS_SELECTED'],
		'TREE_PROPS' => $skuProps
	);
	unset($emptyProductProperties);
	?>

<script>
	BX.message({
		ECONOMY_INFO_MESSAGE: '<?=GetMessageJS('CT_BCE_CATALOG_ECONOMY_INFO2')?>',
		TITLE_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_TITLE_ERROR')?>',
		TITLE_BASKET_PROPS: '<?=GetMessageJS('CT_BCE_CATALOG_TITLE_BASKET_PROPS')?>',
		BASKET_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR')?>',
		BTN_SEND_PROPS: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_SEND_PROPS')?>',
		BTN_MESSAGE_BASKET_REDIRECT: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_BASKET_REDIRECT')?>',
		BTN_MESSAGE_CLOSE: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE')?>',
		BTN_MESSAGE_CLOSE_POPUP: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE_POPUP')?>',
		TITLE_SUCCESSFUL: '<?=GetMessageJS('CT_BCE_CATALOG_ADD_TO_BASKET_OK')?>',
		COMPARE_MESSAGE_OK: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_OK')?>',
		COMPARE_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_UNKNOWN_ERROR')?>',
		COMPARE_TITLE: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_TITLE')?>',
		BTN_MESSAGE_COMPARE_REDIRECT: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT')?>',
		PRODUCT_GIFT_LABEL: '<?=GetMessageJS('CT_BCE_CATALOG_PRODUCT_GIFT_LABEL')?>',
		PRICE_TOTAL_PREFIX: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_PRICE_TOTAL_PREFIX')?>',
		RELATIVE_QUANTITY_MANY: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY'])?>',
		RELATIVE_QUANTITY_FEW: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW'])?>',
		SITE_ID: '<?=SITE_ID?>'
	});

	var <?=$obName?> = new JCCatalogElement(<?=CUtil::PhpToJSObject($jsParams, false, true)?>);
</script>