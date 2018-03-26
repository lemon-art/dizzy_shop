<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
?>


<div class="lk__content">	


	<div class="bx_profile bx_<?=$arResult["THEME"]?>">
		<form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>?" enctype="multipart/form-data">
			
			<h1 class="lk__heading"><?=GetMessage("LEGEND_PROFILE")?></h1>
			
			<?=$arResult["BX_SESSION_CHECK"]?>
			
			<?=ShowError($arResult["strProfileError"]);?>
				<?
				if ($arResult['DATA_SAVED'] == 'Y')
					echo ShowNote(GetMessage('PROFILE_DATA_SAVED'));
				?>
			
			
			<input type="hidden" name="lang" value="<?=LANG?>" />
			<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
			<input type="hidden" name="LOGIN" value=<?=$arResult["arUser"]["LOGIN"]?> />
			<input type="hidden" name="EMAIL" value=<?=$arResult["arUser"]["EMAIL"]?> />
			
			<div class="lk__form">

				<div class="ui-group">
                    <label class="ui-label"><?=GetMessage('NAME')?></label>
                    <input class="ui-input" type="text" value="<?=$arResult["arUser"]["NAME"]?>" name="NAME" placeholder="Введите имя">
                </div>
				
				<div class="ui-group">
                    <label class="ui-label"><?=GetMessage('LAST_NAME')?></label>
                    <input class="ui-input" type="text" value="<?=$arResult["arUser"]["LAST_NAME"]?>" name="LAST_NAME" placeholder="Введите фамилию">
                </div>
				
				<div class="ui-group">
                    <label class="ui-label"><?=GetMessage('EMAIL')?></label>
                    <input class="ui-input" type="email" value="<?=$arResult["arUser"]["EMAIL"]?>" name="EMAIL" placeholder="Введите e-mail">
                </div>
				
				<div class="ui-group">
                    <label class="ui-label"><?=GetMessage('PERSONAL_PHONE')?></label>
                    <input class="ui-input" type="tel" value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>" name="PERSONAL_PHONE" placeholder="+7 (123) 456-78-90">
                </div>
				
				<div class="ui-group">
                    <label class="ui-label"><?=GetMessage('PERSONAL_STREET')?></label>
                    <input class="ui-input" type="text" value="<?=$arResult["arUser"]["PERSONAL_STREET"]?>" name="PERSONAL_STREET" placeholder="Введите адрес доставки">
                </div>
				
				<div class="ui-group">
                    <label class="ui-label"><?=GetMessage('NEW_PASSWORD_REQ')?></label>
                    <input class="ui-input" name="NEW_PASSWORD" type="password" placeholder="" id="password">
                </div>
				
				<div class="ui-group">
                    <label class="ui-label"><?=GetMessage('NEW_PASSWORD_CONFIRM')?></label>
                    <input class="ui-input" name="NEW_PASSWORD_CONFIRM" type="password" placeholder="" id="password">
                </div>
				
			
				<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
					<h2><?=strlen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?></h2>
					<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
						<strong><?=$arUserField["EDIT_FORM_LABEL"]?><?if ($arUserField["MANDATORY"]=="Y"):?><span class="starrequired">*</span><?endif;?></strong><br/>
						<?$APPLICATION->IncludeComponent(
							"bitrix:system.field.edit",
							$arUserField["USER_TYPE"]["USER_TYPE_ID"],
							array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField), null, array("HIDE_ICONS"=>"Y")
						);?>
						<br/>
					<?endforeach;?>
				<?endif;?>
				<button name="save" value="<?=GetMessage("MAIN_SAVE")?>" type="submit" class="btn btn-primary"><span>Сохранить</span></button>
			</div>
		</form>
	</div>
	
</div>

