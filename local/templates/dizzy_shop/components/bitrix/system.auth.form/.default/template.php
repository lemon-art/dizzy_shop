<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CJSCore::Init();
?>


		<div class="lk__heading"><?=GetMessage("AUTH_TITLE")?></div>
		
		<?
		if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
			ShowMessage($arResult['ERROR_MESSAGE']);
		?>
		
		
		<form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>" class="lk__form popup-auth__form">
            
			<?if($arResult["BACKURL"] <> ''):?>
				<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
			<?endif?>
			<?foreach ($arResult["POST"] as $key => $value):?>
				<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
			<?endforeach?>
				<input type="hidden" name="AUTH_FORM" value="Y" />
				<input type="hidden" name="TYPE" value="AUTH" />
			
			
			
			<div class="ui-group">
				<label class="ui-label"><?=GetMessage("AUTH_LOGIN")?></label>
				<input class="ui-input" type="text" name="USER_LOGIN" placeholder="Введите email">
				
				<script>
					BX.ready(function() {
						var loginCookie = BX.getCookie("<?=CUtil::JSEscape($arResult["~LOGIN_COOKIE_NAME"])?>");
						if (loginCookie)
						{
							var form = document.forms["system_auth_form<?=$arResult["RND"]?>"];
							var loginInput = form.elements["USER_LOGIN"];
							loginInput.value = loginCookie;
						}
					});
				</script>
				
				
            </div>
            <div class="ui-group">
				<label class="ui-label"><?=GetMessage("AUTH_PASSWORD")?></label>
				<input class="ui-input" type="password" name="USER_PASSWORD" placeholder="Введите пароль">
            </div>
            <div class="ui-group">
				<div class="popup-auth__link"><a href="#">Забыли пароль?</a></div>
            </div>
            <div class="popup-auth__submit">
              <div class="popup-auth__submit-item">
                <button class="btn btn-primary btn-primary_gray"><span><?=GetMessage("AUTH_REGISTER")?></span></button>
              </div>
              <div class="popup-auth__submit-item">
                <button class="btn btn-primary"><span><?=GetMessage("AUTH_LOGIN_BUTTON")?></span></button>
              </div>
            </div>
        </form>
		

