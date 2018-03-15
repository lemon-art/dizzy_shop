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

if (!empty($arParams['TEMPLATE_THEME']))
{
	if (!is_file($documentRoot.'/bitrix/css/main/themes/'.$arParams['TEMPLATE_THEME'].'/style.css'))
	{
		$arParams['TEMPLATE_THEME'] = 'blue';
	}
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

$this->addExternalCss('/bitrix/css/main/bootstrap.css');
$this->addExternalCss($templateFolder.'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css');

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
	
				<table class="lk__products">
                  <thead>
                    <tr>
                      <th>№</th>
                      <th>Описание</th>
                      <th>Количество</th>
                      <th>Цена</th>
                      <th>Сумма</th>
                      <th data-ctrl></th>
                    </tr>
                  </thead>
                  <tbody>
					<?$i=1;?>
                    <?foreach ($arResult["GRID"]["ROWS"] as $k => $arItem):?>
					

					
					
						<tr>
						  <td><?=$i++?></td>
						  <td>
							<div class="lk__products-item">
							
								<?
										if ( $arResult["ELEMENTS"][$arItem["PRODUCT_ID"]]["PICTURE"] ):
											$url = $arResult["ELEMENTS"][$arItem["PRODUCT_ID"]]["PICTURE"];
										elseif (strlen($arItem["PREVIEW_PICTURE_SRC"]) > 0):
											$url = $arItem["PREVIEW_PICTURE_SRC"];
										elseif (strlen($arItem["DETAIL_PICTURE_SRC"]) > 0):
											$url = $arItem["DETAIL_PICTURE_SRC"];
										else:
											$url = $templateFolder."/images/no_photo.png";
										endif;
								?>
							
								<a class="lk__products-image" href="<?=$arResult["ELEMENTS"][$arItem["PRODUCT_ID"]]["DETAIL_PAGE_URL"]?>">
									<img src="<?=$url?>" alt="">
								</a>
								

								
								
								<div class="lk__products-desc">
									<a class="lk__products-title" href="<?=$arResult["ELEMENTS"][$arItem["PRODUCT_ID"]]["DETAIL_PAGE_URL"]?>">
										<?=$arResult["ELEMENTS"][$arItem["PRODUCT_ID"]]["NAME"]?>
									</a>
									
									<ul class="lk__products-info">
										<li><mark>Артикул:</mark> <?=$arResult["ELEMENTS"][$arItem["PRODUCT_ID"]]["ARTICLE"]?></li>	
										<?foreach ($arItem["PROPS"] as $val):?>
											<?if ( $val['CODE'] == 'COLOR_REF'):?>
												<li><mark><?=htmlspecialcharsbx($val["NAME"])?>:</mark> <?=$arResult["COLORS"][$val["VALUE"]]?></li>
											<?else:?>
												<li><mark><?=htmlspecialcharsbx($val["NAME"])?>:</mark> <?=$val["VALUE"]?></li>
											<?endif;?>
											
										<?endforeach;?>
									</ul>
							  </div>
							</div>
						  </td>
						  <td data-text="Количество: ">
						  
						  
								<div class="jq-number ui-number lk-number" id="QUANTITY_INPUT_<?=$arItem["ID"]?>-styler">
									<div class="jq-number__field">
									
													<input
														class="lk-number"
														type="number"
														size="3"
														id="QUANTITY_INPUT_<?=$arItem["ID"]?>"
														name="QUANTITY_INPUT_<?=$arItem["ID"]?>"
														maxlength="18"
														data-id=<?=$arItem["ID"]?>
														style="max-width: 50px"
														value="<?=$arItem["QUANTITY"]?>"
													>
									</div>
									<div class="jq-number__spin minus lk-num"></div>
									<div class="jq-number__spin plus lk-num"></div>
								</div>
						  					
													
													
							<input type="hidden" id="QUANTITY_<?=$arItem['ID']?>" name="QUANTITY_<?=$arItem['ID']?>" value="<?=$arItem["QUANTITY"]?>" />
						  </td>
						  <td data-text="Цена: "><?=$arItem["PRICE_FORMATED"]?> ₽</td>
						  <td data-text="Сумма: "><?=$arItem["SUM_FULL_PRICE_FORMATED"]?> ₽</td>
							<td data-ctrl>
								<div class="lk__products-ctrl">
									<a class="lk__products-add" href="#">Добавить размер для примерки</a>
									<a class="lk__products-delete" href="#" data-id="<?=$arItem["ID"]?>">
										<svg class="ico ico-delete">
											<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/sprite.svg#ico-delete"></use>
										</svg>Удалить
									</a>
								</div>
							</td>
						</tr>
                    
					<?endforeach;?>
					
                  </tbody>
                </table>
				
				
				<div class="lk__total">
					<p class="lk__total-text">Итого: <?=$arResult['BASKET_ITEMS_COUNT']?> товар<?=BITGetDeclNum($arResult['BASKET_ITEMS_COUNT'])?> на сумму <?=$arResult['allSum_FORMATED']?> ₽ <small>Заказ рассчитан по розничной цене без учета доставки. Окончательную сумму заказа уточняйте у менеджеров компании.</small></p>
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