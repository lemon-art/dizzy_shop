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

	<form method="post" class="js-registration-form" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">
	<?
	if($arResult["BACKURL"] <> ''):
	?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
	<?
	endif;
	?>
		<div class="lk__form">
		
			<input class="ui-input" type="hidden" name="REGISTER[LOGIN]"  value="<?=$arResult["VALUES"]["LOGIN"]?>">
		
			<div class="ui-group">
				<label class="ui-label">Имя*</label>
				<input class="ui-input demon" type="text" name="NAME" value="<?=$arResult["VALUES"]["NAME"]?>" placeholder="Введите имя">
				<input class="ui-input" type="hidden" name="REGISTER[NAME]" value="<?=$arResult["VALUES"]["NAME"]?>" placeholder="Введите имя">
			</div>
		
			<div class="ui-group">
				<label class="ui-label">Фамилия*</label>
				<input class="ui-input demon" type="text" name="LAST_NAME" value="<?=$arResult["VALUES"]["LAST_NAME"]?>" placeholder="Введите фамилию">
				<input class="ui-input" type="hidden" name="REGISTER[LAST_NAME]" value="<?=$arResult["VALUES"]["LAST_NAME"]?>" placeholder="Введите фамилию">
			</div>
				  <div class="ui-group">
                    <label class="ui-label">Название организации</label>
                    <input class="ui-input" type="text" name="REGISTER[WORK_COMPANY]" value="<?=$arResult["VALUES"]["WORK_COMPANY"]?>" >
                  </div>
                  <div class="ui-group">
                    <label class="ui-label">Телефон*</label>
                    <input class="ui-input demon" type="tel" name="PERSONAL_PHONE" value="<?=$arResult["VALUES"]["PERSONAL_PHONE"]?>" placeholder="+7 (123) 456-78-90">
					<input class="ui-input" type="hidden" name="REGISTER[PERSONAL_PHONE]" value="<?=$arResult["VALUES"]["PERSONAL_PHONE"]?>" placeholder="+7 (123) 456-78-90">
                  </div>
                  <div class="ui-group">
                    <label class="ui-label">E-mail*</label>
                    <div class="ui-group-content">
					  <input class="ui-input demon" type="email" name="EMAIL" value="<?=$arResult["VALUES"]["EMAIL"]?>" placeholder="">
                      <input class="ui-input" type="hidden" name="REGISTER[EMAIL]" value="<?=$arResult["VALUES"]["EMAIL"]?>" placeholder="">
                      <label class="ui-check">
                        <input class="ui-check__input" type="checkbox"><span class="ui-check__checkbox">
                          <svg class="ico ico-check">
                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/sprite.svg#ico-check"></use>
                          </svg></span>Подписаться на новости и скидки
                      </label>
                    </div>
                  </div>
                  <div class="ui-group">
                    <label class="ui-label">Адрес доставки</label>
                    <textarea class="ui-textarea ui-textarea__50" name="REGISTER[PERSONAL_STREET]"><?=$arResult["VALUES"]["PERSONAL_STREET"]?></textarea>
                  </div>
                  <div class="ui-group">
                    <label class="ui-label">Пароль*</label>
					<input class="ui-input demon" type="password" name="PASSWORD" placeholder="">
                    <input class="ui-input" type="hidden" name="REGISTER[PASSWORD]" placeholder="" id="password">
                  </div>
                  <div class="ui-group">
                    <label class="ui-label">Подтверждение*</label>
					<input class="ui-input demon" type="password" name="CONFIRM_PASSWORD" placeholder="">
                    <input class="ui-input" type="hidden" name="REGISTER[CONFIRM_PASSWORD]" placeholder="">
                  </div>
				  
			  
                  <div class="ui-group">
                    <label class="ui-label">Введите код,<br>указанный на картинке</label>
                    <div class="ui-group-content">
                      <div class="ui-captcha">
                        <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
						<input type="text" name="captcha_word" maxlength="50" value="" class="ui-captcha__input"/>
                        <figure class="ui-captcha__image"><img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /></figure>
                      </div>
                      <label class="ui-check">
                        <input class="ui-check__input" <?if ( $_POST["agree"] ):?>checked<?endif;?> name="agree" type="checkbox"><span class="ui-check__checkbox">
                          <svg class="ico ico-check">
                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/sprite.svg#ico-check"></use>
                          </svg></span>Да, я принимаю условия работы Diway.ru
                      </label>
                    </div>
                  </div>
	
	                  <p class="ui-attention">
                    <svg class="ico ico-attention">
                      <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/sprite.svg#ico-attention"></use>
                    </svg>Поля, отмеченные (*) обязательны для заполнения
                  </p>
				  <input type="submit" <?if ( !$_POST["agree"] ):?>disabled<?endif;?> class="btn btn-primary" name="register_submit_button" value="<?=GetMessage("AUTH_REGISTER")?>" />
		</div>

	</form>
	<?endif?> 

