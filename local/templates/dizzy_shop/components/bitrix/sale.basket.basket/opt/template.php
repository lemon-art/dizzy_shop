<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 * @var array $arResult
 * @var string $templateFolder
 * @var CMain $APPLICATION
 * @var CBitrixBasketComponent $component
 * @var CBitrixComponentTemplate $this
 * @var array $giftParameters
 */

$documentRoot = Main\Application::getDocumentRoot();

if (empty($arParams['TEMPLATE_THEME']))
{
	$arParams['TEMPLATE_THEME'] = Main\ModuleManager::isModuleInstalled('bitrix.eshop') ? 'site' : 'blue';
}

if ($arParams['TEMPLATE_THEME'] === 'site')
{
	$templateId = Main\Config\Option::get('main', 'wizard_template_id', 'eshop_bootstrap', $component->getSiteId());
	$templateId = preg_match('/^eshop_adapt/', $templateId) ? 'eshop_adapt' : $templateId;
	$arParams['TEMPLATE_THEME'] = Main\Config\Option::get('main', 'wizard_'.$templateId.'_theme_id', 'blue', $component->getSiteId());
}


if (!isset($arParams['DISPLAY_MODE']) || !in_array($arParams['DISPLAY_MODE'], array('extended', 'compact')))
{
	$arParams['DISPLAY_MODE'] = 'extended';
}

$arParams['USE_DYNAMIC_SCROLL'] = isset($arParams['USE_DYNAMIC_SCROLL']) && $arParams['USE_DYNAMIC_SCROLL'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_FILTER'] = isset($arParams['SHOW_FILTER']) && $arParams['SHOW_FILTER'] === 'N' ? 'N' : 'Y';

$arParams['PRICE_DISPLAY_MODE'] = isset($arParams['PRICE_DISPLAY_MODE']) && $arParams['PRICE_DISPLAY_MODE'] === 'N' ? 'N' : 'Y';

if (!isset($arParams['TOTAL_BLOCK_DISPLAY']) || !is_array($arParams['TOTAL_BLOCK_DISPLAY']))
{
	$arParams['TOTAL_BLOCK_DISPLAY'] = array('top');
}

if (empty($arParams['PRODUCT_BLOCKS_ORDER']))
{
	$arParams['PRODUCT_BLOCKS_ORDER'] = 'props,sku,columns';
}

if (is_string($arParams['PRODUCT_BLOCKS_ORDER']))
{
	$arParams['PRODUCT_BLOCKS_ORDER'] = explode(',', $arParams['PRODUCT_BLOCKS_ORDER']);
}

$arParams['USE_PRICE_ANIMATION'] = isset($arParams['USE_PRICE_ANIMATION']) && $arParams['USE_PRICE_ANIMATION'] === 'N' ? 'N' : 'Y';
$arParams['USE_ENHANCED_ECOMMERCE'] = isset($arParams['USE_ENHANCED_ECOMMERCE']) && $arParams['USE_ENHANCED_ECOMMERCE'] === 'Y' ? 'Y' : 'N';
$arParams['DATA_LAYER_NAME'] = isset($arParams['DATA_LAYER_NAME']) ? trim($arParams['DATA_LAYER_NAME']) : 'dataLayer';
$arParams['BRAND_PROPERTY'] = isset($arParams['BRAND_PROPERTY']) ? trim($arParams['BRAND_PROPERTY']) : '';

if ($arParams['USE_GIFTS'] === 'Y')
{
	$giftParameters = array(
		'SHOW_PRICE_COUNT' => 1,
		'PRODUCT_SUBSCRIPTION' => 'N',
		'PRODUCT_ID_VARIABLE' => 'id',
		'PARTIAL_PRODUCT_PROPERTIES' => 'N',
		'USE_PRODUCT_QUANTITY' => 'N',
		'ACTION_VARIABLE' => 'actionGift',
		'ADD_PROPERTIES_TO_BASKET' => 'Y',

		'BASKET_URL' => $APPLICATION->GetCurPage(),
		'APPLIED_DISCOUNT_LIST' => $arResult['APPLIED_DISCOUNT_LIST'],
		'FULL_DISCOUNT_LIST' => $arResult['FULL_DISCOUNT_LIST'],

		'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
		'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_SHOW_VALUE'],
		'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],

		'BLOCK_TITLE' => $arParams['GIFTS_BLOCK_TITLE'],
		'HIDE_BLOCK_TITLE' => $arParams['GIFTS_HIDE_BLOCK_TITLE'],
		'TEXT_LABEL_GIFT' => $arParams['GIFTS_TEXT_LABEL_GIFT'],
		'PRODUCT_QUANTITY_VARIABLE' => $arParams['GIFTS_PRODUCT_QUANTITY_VARIABLE'],
		'PRODUCT_PROPS_VARIABLE' => $arParams['GIFTS_PRODUCT_PROPS_VARIABLE'],
		'SHOW_OLD_PRICE' => $arParams['GIFTS_SHOW_OLD_PRICE'],
		'SHOW_DISCOUNT_PERCENT' => $arParams['GIFTS_SHOW_DISCOUNT_PERCENT'],
		'SHOW_NAME' => $arParams['GIFTS_SHOW_NAME'],
		'SHOW_IMAGE' => $arParams['GIFTS_SHOW_IMAGE'],
		'MESS_BTN_BUY' => $arParams['GIFTS_MESS_BTN_BUY'],
		'MESS_BTN_DETAIL' => $arParams['GIFTS_MESS_BTN_DETAIL'],
		'PAGE_ELEMENT_COUNT' => $arParams['GIFTS_PAGE_ELEMENT_COUNT'],
		'CONVERT_CURRENCY' => $arParams['GIFTS_CONVERT_CURRENCY'],
		'HIDE_NOT_AVAILABLE' => $arParams['GIFTS_HIDE_NOT_AVAILABLE'],

		'LINE_ELEMENT_COUNT' => $arParams['GIFTS_PAGE_ELEMENT_COUNT'],
	);
}


$this->addExternalJs($templateFolder.'/js/mustache.js');
$this->addExternalJs($templateFolder.'/js/action-pool.js');
$this->addExternalJs($templateFolder.'/js/filter.js');
$this->addExternalJs($templateFolder.'/js/component.js');

$mobileColumns = isset($arParams['COLUMNS_LIST_MOBILE'])
	? $arParams['COLUMNS_LIST_MOBILE']
	: $arParams['COLUMNS_LIST'];
$mobileColumns = array_fill_keys($mobileColumns, true);

$jsTemplates = new Main\IO\Directory($documentRoot.$templateFolder.'/js-templates');
/** @var Main\IO\File $jsTemplate */
foreach ($jsTemplates->getChildren() as $jsTemplate)
{
	include($jsTemplate->getPath());
}

$displayModeClass = $arParams['DISPLAY_MODE'] === 'compact' ? ' basket-items-list-wrapper-compact' : '';

if (empty($arResult['ERROR_MESSAGE']))
{


	if ($arResult['BASKET_ITEM_MAX_COUNT_EXCEEDED'])
	{
		?>
		<div id="basket-item-message">
			<?=Loc::getMessage('SBB_BASKET_ITEM_MAX_COUNT_EXCEEDED', array('#PATH#' => $arParams['PATH_TO_BASKET']))?>
		</div>
		<?
	}
	?>
	


				<span id="lk_overflow">
				
				</span>
	
				<?$i=1;?>
				<?foreach ($arResult["ELEMENTS"] as $k => $item):?>
				
			
					<table class="lk__products">
					  <thead>
						<tr>
						  <th>№</th>
						  <th>Описание</th>
						  <th>Цена</th>
						  <th>Сумма</th>
						  <th data-ctrl></th>
						</tr>
					  </thead>
					  <tbody>
						<tr>
						  <td><?=$i++?></td>
						  <td>
							<div class="lk__products-item">
							
								<?
										if ( $arResult["ELEMENTS_DATA"][$item]["PICTURE"] ):
											$url = $arResult["ELEMENTS_DATA"][$item]["PICTURE"];
										elseif (strlen($arItem["PREVIEW_PICTURE_SRC"]) > 0):
											$url = $arItem["PREVIEW_PICTURE_SRC"];
										elseif (strlen($arItem["DETAIL_PICTURE_SRC"]) > 0):
											$url = $arItem["DETAIL_PICTURE_SRC"];
										else:
											$url = $templateFolder."/images/no_photo.png";
										endif;
								?>
							
								<a class="lk__products-image" href="<?=$arResult["ELEMENTS_DATA"][$item]["DETAIL_PAGE_URL"]?>">
									<img src="<?=$url?>" alt="">
								</a>
								
							  <div class="lk__products-desc">
									<a class="lk__products-title" href="<?=$arResult["ELEMENTS_DATA"][$item]["DETAIL_PAGE_URL"]?>">
										<?=$arResult["ELEMENTS_DATA"][$item]["NAME"]?>
									</a>
								
				
				
									<?$APPLICATION->IncludeComponent(
										"bitrix:catalog.element",
										"cart_opt",
										Array(
											"ACTION_VARIABLE" => "action",
											"ADD_DETAIL_TO_SLIDER" => "N",
											"ADD_ELEMENT_CHAIN" => "N",
											"ADD_PICT_PROP" => "-",
											"ADD_PROPERTIES_TO_BASKET" => "Y",
											"ADD_SECTIONS_CHAIN" => "N",
											"ADD_TO_BASKET_ACTION" => array("BUY"),
											"ADD_TO_BASKET_ACTION_PRIMARY" => array("BUY"),
											"BACKGROUND_IMAGE" => "-",
											"BASKET_URL" => "/personal/basket.php",
											"BRAND_USE" => "N",
											"BROWSER_TITLE" => "-",
											"CACHE_GROUPS" => "N",
											"CACHE_TIME" => "36000000",
											"CACHE_TYPE" => "N",
											"CHECK_SECTION_ID_VARIABLE" => "N",
											"COMPATIBLE_MODE" => "Y",
											"CONVERT_CURRENCY" => "N",
											"DETAIL_PICTURE_MODE" => array("POPUP", "MAGNIFIER"),
											"DETAIL_URL" => "",
											"DISABLE_INIT_JS_IN_COMPONENT" => "N",
											"DISPLAY_COMPARE" => "N",
											"DISPLAY_NAME" => "Y",
											"DISPLAY_PREVIEW_TEXT_MODE" => "E",
											"ELEMENT_CODE" => "",
											"QUANTITY_CART" => $arResult["QUANTITY_CART"],
											"ELEMENT_ID" => $item,
											"GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
											"GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
											"GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "4",
											"GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
											"GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
											"GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
											"GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "4",
											"GIFTS_MESS_BTN_BUY" => "Выбрать",
											"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
											"GIFTS_SHOW_IMAGE" => "Y",
											"GIFTS_SHOW_NAME" => "Y",
											"GIFTS_SHOW_OLD_PRICE" => "Y",
											"HIDE_NOT_AVAILABLE_OFFERS" => "N",
											"IBLOCK_ID" => "4",
											"IBLOCK_TYPE" => "catalog",
											"IMAGE_RESOLUTION" => "16by9",
											"LABEL_PROP" => array(),
											"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
											"LINK_IBLOCK_ID" => "",
											"LINK_IBLOCK_TYPE" => "",
											"LINK_PROPERTY_SID" => "",
											"MAIN_BLOCK_OFFERS_PROPERTY_CODE" => array(),
											"MAIN_BLOCK_PROPERTY_CODE" => array(),
											"MESSAGE_404" => "",
											"MESS_BTN_ADD_TO_BASKET" => "В корзину",
											"MESS_BTN_BUY" => "Купить",
											"MESS_BTN_SUBSCRIBE" => "Подписаться",
											"MESS_COMMENTS_TAB" => "Комментарии",
											"MESS_DESCRIPTION_TAB" => "Описание",
											"MESS_NOT_AVAILABLE" => "Нет в наличии",
											"MESS_PRICE_RANGES_TITLE" => "Цены",
											"MESS_PROPERTIES_TAB" => "Характеристики",
											"META_DESCRIPTION" => "-",
											"META_KEYWORDS" => "-",
											"OFFERS_CART_PROPERTIES" => array(),
											"OFFERS_FIELD_CODE" => array("", ""),
											"OFFERS_LIMIT" => "0",
											"OFFERS_PROPERTY_CODE" => array("SIZES_CLOTHES", "COLOR_REF", ""),
											"OFFERS_SORT_FIELD" => "sort",
											"OFFERS_SORT_FIELD2" => "id",
											"OFFERS_SORT_ORDER" => "asc",
											"OFFERS_SORT_ORDER2" => "desc",
											"OFFER_ADD_PICT_PROP" => "-",
											"OFFER_TREE_PROPS" => array("COLOR_REF", "SIZES_CLOTHES"),
											"PARTIAL_PRODUCT_PROPERTIES" => "N",
											"PRICE_CODE" => array("BASE", "Скидка -10%"),
											"PRICE_VAT_INCLUDE" => "Y",
											"PRICE_VAT_SHOW_VALUE" => "N",
											"PRODUCT_ID_VARIABLE" => "id",
											"PRODUCT_INFO_BLOCK_ORDER" => "sku,props",
											"PRODUCT_PAY_BLOCK_ORDER" => "rating,price,priceRanges,quantityLimit,quantity,buttons",
											"PRODUCT_PROPERTIES" => array(),
											"PRODUCT_PROPS_VARIABLE" => "prop",
											"PRODUCT_QUANTITY_VARIABLE" => "quantity",
											"PRODUCT_SUBSCRIPTION" => "Y",
											"PROPERTY_CODE" => array("CML2_ARTICLE", ""),
											"SECTION_CODE" => "",
											"SECTION_ID" => "",
											"SECTION_ID_VARIABLE" => "SECTION_ID",
											"SECTION_URL" => "",
											"SEF_MODE" => "N",
											"SET_BROWSER_TITLE" => "N",
											"SET_CANONICAL_URL" => "N",
											"SET_LAST_MODIFIED" => "N",
											"SET_META_DESCRIPTION" => "N",
											"SET_META_KEYWORDS" => "N",
											"SET_STATUS_404" => "N",
											"SET_TITLE" => "N",
											"SET_VIEWED_IN_COMPONENT" => "N",
											"SHOW_404" => "N",
											"SHOW_CLOSE_POPUP" => "N",
											"SHOW_DEACTIVATED" => "N",
											"SHOW_DISCOUNT_PERCENT" => "N",
											"SHOW_MAX_QUANTITY" => "N",
											"SHOW_OLD_PRICE" => "N",
											"SHOW_PRICE_COUNT" => "1",
											"SHOW_SLIDER" => "N",
											"STRICT_SECTION_CHECK" => "N",
											"TEMPLATE_THEME" => "blue",
											"USE_COMMENTS" => "N",
											"USE_ELEMENT_COUNTER" => "Y",
											"USE_ENHANCED_ECOMMERCE" => "N",
											"USE_GIFTS_DETAIL" => "Y",
											"USE_GIFTS_MAIN_PR_SECTION_LIST" => "Y",
											"USE_MAIN_ELEMENT_SECTION" => "N",
											"USE_PRICE_COUNT" => "N",
											"USE_PRODUCT_QUANTITY" => "N",
											"USE_RATIO_IN_RANGES" => "N",
											"USE_VOTE_RATING" => "N"
										)
									);?>
				
				
	

                          </div>
                        </div>
                      </td>
                      <td data-text="Цена: "><?=number_format($arResult["PRICE_DATA"][$item]['PRICE'], 0, '', ' ')?> ₽</td>
                      <td data-text="Сумма: "><?=number_format($arResult["PRICE_DATA"][$item]['FULL_PRICE'], 0, '', ' ')?> ₽</td>
                      <td data-ctrl>
                        <div class="lk__products-ctrl"><a class="lk__products-delete" href="#">
                            <svg class="ico ico-delete">
                              <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/sprite.svg#ico-delete"></use>
                            </svg>Удалить</a></div>
                      </td>
                    </tr>
					
					<?endforeach;?>
				    </tbody>
                </table>
				<div class="lk__total">
					<p class="lk__total-text">Итого: <?=count($arResult['ELEMENTS'])?> товар<?=BITGetDeclNum(count($arResult['ELEMENTS']))?> на сумму <?=$arResult['allSum_FORMATED']?> ₽ <small>Заказ рассчитан по розничной цене без учета доставки. Окончательную сумму заказа уточняйте у менеджеров компании.</small></p>
					<button class="btn btn-primary"><span>Подтвердить заказ</span></button>
				</div>
	



	<?
	if (!empty($arResult['CURRENCIES']) && Main\Loader::includeModule('currency'))
	{
		CJSCore::Init('currency');

		?>
		<script>
			BX.Currency.setCurrencies(<?=CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true)?>);
		</script>
		<?
	}

	$signer = new \Bitrix\Main\Security\Sign\Signer;
	$signedParams = $signer->sign(base64_encode(serialize($arParams)), 'sale.basket.basket');
	$messages = Loc::loadLanguageFile(__FILE__);
	?>
	<script>
		BX.message(<?=CUtil::PhpToJSObject($messages)?>);
		BX.Sale.BasketComponent.init({
			result: <?=CUtil::PhpToJSObject($arResult, false, false, true)?>,
			params: <?=CUtil::PhpToJSObject($arParams)?>,
			signedParamsString: '<?=CUtil::JSEscape($signedParams)?>',
			siteId: '<?=CUtil::JSEscape($component->getSiteId())?>',
			ajaxUrl: '<?=CUtil::JSEscape($component->getPath().'/ajax.php')?>',
			templateFolder: '<?=CUtil::JSEscape($templateFolder)?>'
		});
	</script>
	<?
}
else
{
	ShowError($arResult['ERROR_MESSAGE']);
}
?>

	</form>
</div>