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
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

ффывфывфыв
	<div class="lk__heading"><?=GetMessage("AUTH_REGISTER")?></div>

	<?
	ShowMessage($arParams["~AUTH_RESULT"]);
	?>
	

	<noindex>
	<form method="post" action="<?=$arResult["AUTH_URL"]?>" name="bform" enctype="multipart/form-data" class="lk__form popup-auth__form">
		<?
		if (strlen($arResult["BACKURL"]) > 0)
		{
		?>
			<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
		<?
		}
		?>
		<?foreach ($arResult["POST"] as $key => $value):?>
			<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
		<?endforeach?>
		
		<input type="hidden" name="AUTH_FORM" value="Y" />
		<input type="hidden" name="TYPE" value="REGISTRATION" />
		
		
		<div class="ui-group">
			<label class="ui-label"><?=GetMessage("AUTH_NAME")?></label>
			<input class="ui-input" type="text" name="USER_NAME" value="<?=$arResult["USER_NAME"]?>" >
        </div>
		
		<div class="ui-group">
			<label class="ui-label"><?=GetMessage("AUTH_LAST_NAME")?></label>
			<input class="ui-input" type="text" name="USER_LAST_NAME" value="<?=$arResult["USER_LAST_NAME"]?>" >
        </div>
		
		<div class="ui-group">
			<label class="ui-label"><?=GetMessage("AUTH_LOGIN_MIN")?></label>
			<input class="ui-input" type="text" name="USER_LOGIN" value="<?=$arResult["USER_LOGIN"]?>" >
        </div>
		
		<div class="ui-group">
			<label class="ui-label"><?=GetMessage("AUTH_PASSWORD_REQ")?></label>
			<input class="ui-input" type="password" name="USER_PASSWORD" value="<?=$arResult["USER_PASSWORD"]?>" >
        </div>
		
		<div class="ui-group">
			<label class="ui-label"><?=GetMessage("AUTH_CONFIRM")?></label>
			<input class="ui-input" type="password" name="USER_CONFIRM_PASSWORD" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" >
        </div>
		
		<div class="ui-group">
			<label class="ui-label"><?=GetMessage("AUTH_EMAIL")?></label>
			<input class="ui-input" type="email" name="USER_EMAIL" value="<?=$arResult["USER_EMAIL"]?>" >
        </div>


		<div class="popup-auth__submit">
            <div class="popup-auth__submit-item">
                <button type="submit" class="btn btn-primary"><span><?=GetMessage("AUTH_REGISTER")?></span></button>
            </div>
            <div class="popup-auth__submit-item">
                <button class="btn btn-primary btn-primary_gray"><span><?=GetMessage("AUTH_AUTH")?></span></button>
            </div>
        </div>
		
		

	</form>
</noindex>

<script type="text/javascript">
document.bform.USER_NAME.focus();
</script>

