<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

	<?
		global $USER;
		$arResult["FAVORITES"] = Array();
		if(!$USER->IsAuthorized()){
			$arElements = unserialize($APPLICATION->get_cookie('favorites'));
		}
		else{ 
			$idUser = $USER->GetID();
			$rsUser = CUser::GetByID($idUser);
			$arUser = $rsUser->Fetch();
			$arElements = unserialize($arUser['UF_FAVORITES']);
        }  
		foreach ( $arElements as $key => $arElement){
			if ( !$arElement ) {
				unset( $arElements[$key] );
			}
		}
		if ( !empty($arElements)){
			$arResult["FAVORITES"] = $arElements;
		}
		
	?>
	
	<?if( !empty($arResult['FAVORITES'])):?>
		<a href="/catalog/wishlist/" rel="nofollow">
	<?endif;?>
	
			<svg class="ico ico-like">
				<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/sprite.svg#ico-like"></use>
			</svg>
			
	<?if( !empty($arResult['FAVORITES'])):?>
			<div class="header__cart-counter" style="right: 41px;"><span><?=count( $arResult["FAVORITES"] )?></span></div>
		</a>
	<?endif;?>					
	
	