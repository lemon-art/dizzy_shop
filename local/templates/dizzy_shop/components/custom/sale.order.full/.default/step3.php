<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?


CModule::IncludeModule('sale');





$db_dtype = CSaleDelivery::GetList(
    array(
            "SORT" => "ASC",
            "NAME" => "ASC"
        ),
    array(
            "LID" => SITE_ID,
            "ACTIVE" => "Y",
            "LOCATION" => $DELIVERY_LOCATION
        ),
    false,
    false,
    array()
);
$arDeliveries = Array();
while ($arResult = $db_dtype->GetNext())
{
	$arDeliveries[] = $arResult;
}


?>


                   <div class="ui-group">
                    <label class="ui-label">Способ доставки</label>
                    <select class="ui-select" name="DELIVERY_ID">
						<?foreach($arDeliveries as $ar_dtype):?>
							<option value="<?=$ar_dtype["ID"]?>"><?=$ar_dtype["NAME"]?></option>
						<?endforeach;?>
                    </select>
                  </div>


	


