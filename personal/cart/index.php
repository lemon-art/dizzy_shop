<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
?>


<?$APPLICATION->IncludeComponent("custom:sale.order.full", ".default", Array(
	"ADDITIONAL_PICT_PROP_1" => "-",
		"ADDITIONAL_PICT_PROP_10" => "-",
		"ADDITIONAL_PICT_PROP_12" => "-",
		"ADDITIONAL_PICT_PROP_8" => "-",
		"ALLOW_AUTO_REGISTER" => "N",
		"ALLOW_NEW_PROFILE" => "N",
		"ALLOW_PAY_FROM_ACCOUNT" => "N",	// Позволять оплачивать с внутреннего счета
		"ALLOW_USER_PROFILES" => "N",
		"BASKET_IMAGES_SCALING" => "standard",
		"BASKET_POSITION" => "after",
		"CITY_OUT_LOCATION" => "Y",	// Выбор города местоположения не обязателен
		"COMPATIBLE_MODE" => "Y",
		"COUNT_DELIVERY_TAX" => "N",	// Рассчитывать налог для доставки
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",	// Рассчитывать скидку для каждой позиции (на все количество товара)
		"DELIVERIES_PER_PAGE" => "8",
		"DELIVERY_FADE_EXTRA_SERVICES" => "N",
		"DELIVERY_NO_AJAX" => "N",
		"DELIVERY_NO_SESSION" => "Y",	// Проверять сессию при оформлении заказа
		"DELIVERY_TO_PAYSYSTEM" => "d2p",
		"DISABLE_BASKET_REDIRECT" => "N",
		"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",	// Позволять оплачивать с внутреннего счета только в полном объеме
		"PATH_TO_AUTH" => "/auth/",	// Страница авторизации
		"PATH_TO_BASKET" => "/personal/cart/",	// Страница корзины
		"PATH_TO_PAYMENT" => "payment.php",	// Страница подключения платежной системы
		"PATH_TO_PERSONAL" => "index.php",	// Страница персонального раздела
		"PAY_FROM_ACCOUNT" => "N",
		"PAY_SYSTEMS_PER_PAGE" => "8",
		"PICKUPS_PER_PAGE" => "5",
		"PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
		"PRICE_VAT_SHOW_VALUE" => "Y",	// Отображать значение НДС
		"PRODUCT_COLUMNS_HIDDEN" => "",
		"PRODUCT_COLUMNS_VISIBLE" => array(
			0 => "PREVIEW_PICTURE",
			1 => "PROPS",
		),
		"PROPS_FADE_LIST_1" => "",
		"PROPS_FADE_LIST_2" => "",
		"PROP_1" => array(	// Не показывать свойства для типа плательщика "Физическое лицо" (s1)
			0 => "20",
			1 => "22",
		),
		"PROP_2" => array(	// Не показывать свойства для типа плательщика "Юридическое лицо" (s1)
			0 => "21",
		),
		"SEND_NEW_USER_NOTIFY" => "Y",	// Отправлять пользователю письмо, что он зарегистрирован на сайте
		"SERVICES_IMAGES_SCALING" => "standard",
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"SHOW_AJAX_DELIVERY_LINK" => "Y",	// Запускать расчет стоимости доставки?
		"SHOW_BASKET_HEADERS" => "N",
		"SHOW_COUPONS_BASKET" => "Y",
		"SHOW_COUPONS_DELIVERY" => "Y",
		"SHOW_COUPONS_PAY_SYSTEM" => "Y",
		"SHOW_DELIVERY_INFO_NAME" => "Y",
		"SHOW_DELIVERY_LIST_NAMES" => "Y",
		"SHOW_DELIVERY_PARENT_NAMES" => "Y",
		"SHOW_MAP_IN_PROPS" => "N",
		"SHOW_MENU" => "Y",	// Показывать меню навигации по процедуре оформления заказа
		"SHOW_NEAREST_PICKUP" => "N",
		"SHOW_ORDER_BUTTON" => "final_step",
		"SHOW_PAY_SYSTEM_INFO_NAME" => "Y",
		"SHOW_PAY_SYSTEM_LIST_NAMES" => "Y",
		"SHOW_STORES_IMAGES" => "Y",
		"SHOW_TOTAL_ORDER_BUTTON" => "N",
		"SKIP_USELESS_BLOCK" => "Y",
		"TEMPLATE_LOCATION" => "popup",
		"TEMPLATE_THEME" => "site",
		"USE_AJAX_LOCATIONS" => "Y",	// Использовать расширенную форму местоположения
		"USE_CUSTOM_ADDITIONAL_MESSAGES" => "N",
		"USE_CUSTOM_ERROR_MESSAGES" => "N",
		"USE_CUSTOM_MAIN_MESSAGES" => "N",
		"USE_PREPAYMENT" => "N",
		"USE_YM_GOALS" => "N"
	),
	false
);?>

<span id="basket_bx">
<?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket",
	"",
	Array(
		"ACTION_VARIABLE" => "basketAction",
		"ADDITIONAL_PICT_PROP_2" => "-",
		"ADDITIONAL_PICT_PROP_3" => "-",
		"ADDITIONAL_PICT_PROP_4" => "-",
		"ADDITIONAL_PICT_PROP_5" => "-",
		"AUTO_CALCULATION" => "Y",
		"BASKET_IMAGES_SCALING" => "adaptive",
		"COLUMNS_LIST_EXT" => array("PREVIEW_PICTURE", "DISCOUNT", "DELETE", "DELAY", "TYPE", "SUM"),
		"COLUMNS_LIST_MOBILE" => array("PREVIEW_PICTURE", "DISCOUNT", "DELETE", "DELAY", "TYPE", "SUM"),
		"COMPATIBLE_MODE" => "Y",
		"CORRECT_RATIO" => "Y",
		"DEFERRED_REFRESH" => "N",
		"DISCOUNT_PERCENT_POSITION" => "bottom-right",
		"DISPLAY_MODE" => "extended",
		"GIFTS_BLOCK_TITLE" => "Выберите один из подарков",
		"GIFTS_CONVERT_CURRENCY" => "N",
		"GIFTS_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_HIDE_NOT_AVAILABLE" => "N",
		"GIFTS_MESS_BTN_BUY" => "Выбрать",
		"GIFTS_MESS_BTN_DETAIL" => "Подробнее",
		"GIFTS_PAGE_ELEMENT_COUNT" => "4",
		"GIFTS_PLACE" => "BOTTOM",
		"GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",
		"GIFTS_PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
		"GIFTS_SHOW_IMAGE" => "Y",
		"GIFTS_SHOW_NAME" => "Y",
		"GIFTS_SHOW_OLD_PRICE" => "N",
		"GIFTS_TEXT_LABEL_GIFT" => "Подарок",
		"HIDE_COUPON" => "N",
		"LABEL_PROP" => array(),
		"LABEL_PROP_MOBILE" => "",
		"LABEL_PROP_POSITION" => "",
		"OFFERS_PROPS" => array("COLOR_REF", "SIZES_CLOTHES"),
		"PATH_TO_ORDER" => "/personal/order/make/",
		"PRICE_DISPLAY_MODE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"PRODUCT_BLOCKS_ORDER" => "props,sku,columns",
		"QUANTITY_FLOAT" => "Y",
		"SET_TITLE" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"SHOW_FILTER" => "Y",
		"SHOW_RESTORE" => "Y",
		"TEMPLATE_THEME" => "blue",
		"TOTAL_BLOCK_DISPLAY" => array("top"),
		"USE_DYNAMIC_SCROLL" => "Y",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_GIFTS" => "Y",
		"USE_PREPAYMENT" => "N",
		"USE_PRICE_ANIMATION" => "Y"
	)
);?>
</span>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>