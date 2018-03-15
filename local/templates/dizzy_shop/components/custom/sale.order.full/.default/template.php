<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if ( $arResult["ORDER_ID"] ):?>
      <div class="content__wrap content__wrap_cart">
        <div class="content__container content__container_ordered">
          <div class="content-ordered">
            <h1 class="title-h1 content-ordered__title">Ваш заказ <span class="title-h1_marked">№ <?=$arResult["ORDER_ID"]?></span> оформлен.</h1>
            <p class="content-ordered__text">В ближайшее время наш менеджер свяжется с вами<br>для уточнения деталей оплаты и доставки.</p>
            <p class="content-ordered__text">Спасибо, что выбрали нас.</p>
            <a href="/" class="content-cart__back content-ordered__back">Вернуться на главную</a>

<?else:?>
	
	
<div class="lk__content">	
	
	<form method="post" action="<?= htmlspecialcharsbx($arParams["PATH_TO_ORDER"]) ?>" name="order_form" js-validate-form>
			
		<h1 class="lk__heading"><?$APPLICATION->ShowTitle(false)?></h1>		
		
	<?if ( !$arResult["NO_PROSUCTS"] ):?>
	
	
				<?=bitrix_sessid_post()?>
				<div class="lk__form">
					<?include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/step1.php");?>
						
							


						<input type='hidden' value='<?=$templateFolder?>/' id='step3_file'>
						<input type="hidden" name="DELIVERY_ID" value="" id='DELIVERY_ID'>
						

						<input type="hidden" name="ORDER_PRICE" value="<?= $arResult["ORDER_PRICE"] ?>">
						<input type="hidden" name="ORDER_WEIGHT" value="<?= $arResult["ORDER_WEIGHT"] ?>">
						<input type="hidden" name="SKIP_FIRST_STEP" value="<?= $arResult["SKIP_FIRST_STEP"] ?>">
						<input type="hidden" name="SKIP_SECOND_STEP" value="<?= $arResult["SKIP_SECOND_STEP"] ?>">
						<input type="hidden" name="SKIP_THIRD_STEP" value="<?= $arResult["SKIP_THIRD_STEP"] ?>">
						<input type="hidden" name="SKIP_FORTH_STEP" value="<?= $arResult["SKIP_FORTH_STEP"] ?>">



						<input type="hidden" name="BACK" value="">
						<input type="hidden" name="CurrentStep" value="7">


						<input type="hidden" name="PROFILE_ID" value="<?= $arResult["PROFILE_ID"] ?>">
						<input type="hidden" name="DELIVERY_LOCATION" value="<?= $arResult["DELIVERY_LOCATION"] ?>">
						
						
						<input type="hidden" name="TAX_EXEMPT" value="<?= $arResult["TAX_EXEMPT"] ?>">
						<input type="hidden" name="PAY_CURRENT_ACCOUNT" value="<?= $arResult["PAY_CURRENT_ACCOUNT"] ?>">


				</div>

	<?endif;?>
		
		
<?endif;?>


