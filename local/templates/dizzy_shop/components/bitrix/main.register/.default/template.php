<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();
?>

<div class="lk__content">

	<h1 class="lk__heading"><?=GetMessage("AUTH_REGISTER")?></h1>
	
	
	<?if($USER->IsAuthorized()):?>

		<p><?echo GetMessage("MAIN_REGISTER_AUTH")?></p>

	<?else:?>
	
		
	<?
	if (count($arResult["ERRORS"]) > 0):
		foreach ($arResult["ERRORS"] as $key => $error)
			if (intval($key) == 0 && $key !== 0) 
				$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);

		ShowError(implode("<br />", $arResult["ERRORS"]));

	elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):
	?>
		<p><?echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?></p>
	<?endif?>

	<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">
	<?
	if($arResult["BACKURL"] <> ''):
	?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
	<?
	endif;
	?>
		<div class="lk__form">
		
			<input class="ui-input" type="text" name="REGISTER[LOGIN]">
		
			<div class="ui-group">
				<label class="ui-label">Имя*</label>
				<input class="ui-input" type="text" name="REGISTER[NAME]" placeholder="Введите имя">
			</div>
		
			<div class="ui-group">
				<label class="ui-label">Фамилия*</label>
				<input class="ui-input" type="text" name="REGISTER[LAST_NAME]" placeholder="Введите фамилию">
			</div>
				  <div class="ui-group">
                    <label class="ui-label">Название организации*</label>
                    <input class="ui-input" type="text" name="REGISTER[WORK_COMPANY]">
                  </div>
                  <div class="ui-group">
                    <label class="ui-label">Телефон*</label>
                    <input class="ui-input" type="tel" name="REGISTER[PERSONAL_PHONE]" placeholder="+7 (123) 456-78-90">
                  </div>
                  <div class="ui-group">
                    <label class="ui-label">E-mail*</label>
                    <div class="ui-group-content">
                      <input class="ui-input" type="email" name="REGISTER[EMAIL]" placeholder="">
                      <label class="ui-check">
                        <input class="ui-check__input" type="checkbox"><span class="ui-check__checkbox">
                          <svg class="ico ico-check">
                            <use xlink:href="img/sprite.svg#ico-check"></use>
                          </svg></span>Подписаться на новости и скидки
                      </label>
                    </div>
                  </div>
                  <div class="ui-group">
                    <label class="ui-label">Адрес доставки</label>
                    <textarea class="ui-textarea ui-textarea__50" name="REGISTER[PERSONAL_STREET]">Россия, Москва, Саянска ул. 11/2/291</textarea>
                  </div>
                  <div class="ui-group">
                    <label class="ui-label">Пароль*</label>
                    <input class="ui-input" type="password" name="REGISTER[PASSWORD]" placeholder="" id="password">
                  </div>
                  <div class="ui-group">
                    <label class="ui-label">Подтверждение*</label>
                    <input class="ui-input" type="password" name="REGISTER[CONFIRM_PASSWORD]" placeholder="">
                  </div>
	
	                  <p class="ui-attention">
                    <svg class="ico ico-attention">
                      <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/sprite.svg#ico-attention"></use>
                    </svg>Поля, отмеченные (*) обязательны для заполнения
                  </p>
                  <button name="register_submit_button" class="btn btn-primary"><span>Регистрация</span></button>
		</div>

	</form>
	<?endif?> 

</div>