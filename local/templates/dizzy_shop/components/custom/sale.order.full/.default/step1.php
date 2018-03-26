<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

	<?
	global $USER;
	$class = '';
	if ($USER->IsAuthorized()) {
		
		$filter = Array("ID" => $USER->GetID);
		$rsUsers = CUser::GetList(($by = "NAME"), ($order = "desc"), $filter);
		$arUser = $rsUsers->Fetch();
		$class = 'is-disabled';
		
	}
	
	
	?>

	

	    <div class="ui-group <?=$class?>">
            <label class="ui-label">Имя*</label>
            <input class="ui-input" type="text" name="ORDER_PROP_1" value="<?if ( $arResult["USER_NAME"] ):?><?=$arResult["USER_NAME"]?><?endif;?>">
        </div>
	
	    <div class="ui-group <?=$class?>">
            <label class="ui-label">Телефон*</label>
            <input class="ui-input" type="tel" name="ORDER_PROP_3" value="<?if ( $arUser["PERSONAL_PHONE"] ):?><?=$arUser["PERSONAL_PHONE"]?><?endif;?>">
        </div>
		
		<div class="ui-group <?=$class?>">
            <label class="ui-label">E-mail*</label>
            <input class="ui-input" type="email" name="ORDER_PROP_2" value="<?if ( $arResult["USER_EMAIL"] ):?><?=$arResult["USER_EMAIL"]?><?endif;?>">
        </div>
		
		<div class="ui-group">
            <label class="ui-label">Адрес доставки</label>
            <input class="ui-input" type="text" name="ORDER_PROP_7" value="<?if ( $arUser["PERSONAL_STREET"] ):?><?=$arUser["PERSONAL_STREET"]?><?endif;?>">
        </div>
		
		<div class="ui-group">
            <label class="ui-label">Комментарий</label>
            <textarea class="ui-textarea" name="ORDER_DESCRIPTION" placeholder="Введите комментарии (не обязательно)"><?=$arResult["ORDER_DESCRIPTION"]?></textarea>
        </div>
		
		<input type="hidden" name="PERSON_TYPE" value="1">
	
	
