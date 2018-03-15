<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */
global $APPLICATION, $USER;
?>

		<?if($USER->IsAuthorized()):?>
		
		
							<div class="header__profile">
								<span><?=$arResult["User"]["NAME_FORMATTED"]?></span>
								<div class="header__profile-dropdown">
									<div class="header__profile-dropdown-menu">
										<a href="/personal/"><?=GetMessage("PERSONAL")?></a>
										<a href="?logout=yes"><?=GetMessage("EXIT")?></a>
									</div>
								</div>
							</div>

		<?else:?>
		
							<div class="header__profile">
								<span><?=GetMessage("TITLE")?></span>
								<div class="header__profile-dropdown">
									<div class="header__profile-dropdown-menu">
										<a href="#" data-mfp-src="#popup-auth" js-popup><?=GetMessage("AUTH")?></a>
										<a href="/personal/private/?register=yes"><?=GetMessage("REG")?></a>
									</div>
								</div>
							</div>
		
		
		<?endif;?>


