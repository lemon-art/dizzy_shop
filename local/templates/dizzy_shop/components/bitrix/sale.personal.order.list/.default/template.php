<?

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main,
	Bitrix\Main\Localization\Loc,
	Bitrix\Main\Page\Asset;

CJSCore::Init(array('clipboard', 'fx'));

Loc::loadMessages(__FILE__);

if (!empty($arResult['ERRORS']['FATAL']))
{
	foreach($arResult['ERRORS']['FATAL'] as $error)
	{
		ShowError($error);
	}
	$component = $this->__component;
	if ($arParams['AUTH_FORM_IN_TEMPLATE'] && isset($arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED]))
	{
		$APPLICATION->AuthForm('', false, false, 'N', false);
	}

}
else
{
	if (!empty($arResult['ERRORS']['NONFATAL']))
	{
		foreach($arResult['ERRORS']['NONFATAL'] as $error)
		{
			ShowError($error);
		}
	}
	if (!count($arResult['ORDERS']))
	{
		if ($_REQUEST["filter_history"] == 'Y')
		{
			if ($_REQUEST["show_canceled"] == 'Y')
			{
				?>
				<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_CANCELED_ORDER')?></h3>
				<?
			}
			else
			{
				?>
				<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_HISTORY_ORDER_LIST')?></h3>
				<?
			}
		}
		else
		{
			?>
			<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_ORDER_LIST')?></h3>
			<?
		}
	}
	?>
	

	
	<div class="lk__content">
        <h1 class="lk__heading"><?$APPLICATION->ShowTitle(false)?></h1>
	
	
		<?if (!count($arResult['ORDERS']))
		{
			?>
			<div class="row col-md-12 col-sm-12">
				<a href="<?=htmlspecialcharsbx($arParams['PATH_TO_CATALOG'])?>" class="sale-order-history-link">
					<?=Loc::getMessage('SPOL_TPL_LINK_TO_CATALOG')?>
				</a>
			</div>
			<?
		}
		else{
		?>
	
			<table class="lk__orders">
                <thead>
                  <tr>
                    <th>Заказ</th>
                    <th>Дата и время заказа</th>
                    <th>Количество</th>
                    <th>Сумма</th>
                    <th>Статус</th>
                  </tr>
                </thead>
               
				
					<?foreach ($arResult['ORDERS'] as $key => $order):?>
					
						<?
						$orderHeaderStatus = $order['ORDER']['STATUS_ID'];
						?>
					
						 <tbody class="lk__orders-group">
							<tr class="lk__orders-group-trigger">
								<td><?=$order["ORDER"]["ID"]?></td>
								<td><?=$order['ORDER']['DATE_INSERT']->format($arParams['ACTIVE_DATE_FORMAT'])?></td>
								<td><?=count($order['BASKET_ITEMS'])?></td>
								<td><?=$order["ORDER"]["FORMATED_PRICE"]?> ₽</td>
								<td><?=htmlspecialcharsbx($arResult['INFO']['STATUS'][$orderHeaderStatus]['NAME'])?></td>
							</tr>
							<tr class="lk__orders-group-content">
								<td colspan="100">
									<table class="lk__products">
										<thead>
										  <tr>
											<td colspan="100">
											  <p class="lk__products-number">Заказ № <?=$order["ORDER"]["ID"]?> </p>
											</td>
										  </tr>
										  <tr>
											<th>№</th>
											<th>Описание</th>
											<th>Количество</th>
											<th>Цена</th>
											<th>Сумма</th>
										  </tr>
										</thead>
										<tbody>
											<?$i=1;?>
											<?foreach ( $order['BASKET_ITEMS'] as $arPropduct):?>
												
											
												<?
														if ( $arResult["ELEMENTS"][$arPropduct["PRODUCT_ID"]]["PICTURE"] ):
															$url = $arResult["ELEMENTS"][$arPropduct["PRODUCT_ID"]]["PICTURE"];
														elseif (strlen($arPropduct["PREVIEW_PICTURE_SRC"]) > 0):
															$url = $arPropduct["PREVIEW_PICTURE_SRC"];
														elseif (strlen($arPropduct["DETAIL_PICTURE_SRC"]) > 0):
															$url = $arPropduct["DETAIL_PICTURE_SRC"];
														else:
															$url = $templateFolder."/images/no_photo.png";
														endif;
												?>
												
												<tr>
													<td><?=$i++?></td>
													<td>
													  <div class="lk__products-item">
														<figure class="lk__products-image">
															<img src="<?=$url?>" alt="">
														</figure>
														<div class="lk__products-desc">
														  <h2 class="lk__products-title"><?=$arResult["ELEMENTS"][$arPropduct["PRODUCT_ID"]]["NAME"]?></h2>
														  <ul class="lk__products-info">
															<li><mark>Артикул:</mark> <?=$arResult["ELEMENTS"][$arPropduct["PRODUCT_ID"]]["ARTICLE"]?></li>
															<?/*
															<li><mark>Коллекция:</mark> <a href="#" class="link-dark">Осень-Зима 2017</a></li>
															*/?>
															<li><mark>Размер:</mark> <?=$arResult["ELEMENTS"][$arPropduct["PRODUCT_ID"]]["SIZE"]?></li>
															<li><mark>Цвет:</mark> <?=$arResult["ELEMENTS"][$arPropduct["PRODUCT_ID"]]["COLOR"]?></li>
														  </ul>
														</div>
													  </div>
													</td>
													<td data-text="Количество: "><?=$arPropduct["QUANTITY"]?></td>
													<td data-text="Цена: "><?=number_format($arPropduct["PRICE"], 0, '', ' ')?> ₽</td>
													<td data-text="Сумма: "><?=(number_format($arPropduct["PRICE"] * $arPropduct["QUANTITY"], 0, '', ' '))?> ₽</td>
												</tr>
											
											<?endforeach;?>
										</tbody>
									</table>
						</tbody>	
					<?endforeach;?>
			</table>
			
		<?}?>
	
		<div class="row col-md-12 col-sm-12">
			<?
			$nothing = !isset($_REQUEST["filter_history"]) && !isset($_REQUEST["show_all"]);
			$clearFromLink = array("filter_history","filter_status","show_all", "show_canceled");

			if ($nothing || $_REQUEST["filter_history"] == 'N')
			{
				?>
				<a class="sale-order-history-link" href="<?=$APPLICATION->GetCurPageParam("filter_history=Y", $clearFromLink, false)?>">
					<?echo Loc::getMessage("SPOL_TPL_VIEW_ORDERS_HISTORY")?>
				</a>
				<?
			}
			if ($_REQUEST["filter_history"] == 'Y')
			{
				?>
				<a class="sale-order-history-link" href="<?=$APPLICATION->GetCurPageParam("", $clearFromLink, false)?>">
					<?echo Loc::getMessage("SPOL_TPL_CUR_ORDERS")?>
				</a>
				<?
				if ($_REQUEST["show_canceled"] == 'Y')
				{
					?>
					<a class="sale-order-history-link" href="<?=$APPLICATION->GetCurPageParam("filter_history=Y", $clearFromLink, false)?>">
						<?echo Loc::getMessage("SPOL_TPL_VIEW_ORDERS_HISTORY")?>
					</a>
					<?
				}
				else
				{
					?>
					<a class="sale-order-history-link" href="<?=$APPLICATION->GetCurPageParam("filter_history=Y&show_canceled=Y", $clearFromLink, false)?>">
						<?echo Loc::getMessage("SPOL_TPL_VIEW_ORDERS_CANCELED")?>
					</a>
					<?
				}
			} 
			?>
		</div>
	
	
	
	</div>	
<?	
}
?>
