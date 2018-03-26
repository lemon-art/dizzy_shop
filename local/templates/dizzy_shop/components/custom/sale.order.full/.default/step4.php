<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$db_ptype = CSalePaySystem::GetList(
	$arOrder = Array("SORT"=>"ASC", "PSA_NAME"=>"ASC"), 
	Array("LID"=>SITE_ID, "CURRENCY"=>"RUB", "ACTIVE"=>"Y", "PERSON_TYPE_ID"=>$_POST["PERSON_TYPE"])
);
$bFirst = True;
$arPayments = Array();
while ($ptype = $db_ptype->Fetch()){
	$arPayments[] = $ptype;
}

?>

                   <div class="ui-group">
                    <label class="ui-label">Способ оплаты</label>
                    <select class="ui-select" name="PAY_SYSTEM_ID">
						<?foreach ( $arPayments as $key => $arPayment):?>
							<option value="<?=$arPayment["ID"]?>"><?=$arPayment["NAME"]?></option>
						<?endforeach;?>
                    </select>
                  </div>


