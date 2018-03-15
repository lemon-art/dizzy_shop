<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
use Bitrix\Main\Page\Asset;
if($APPLICATION->GetCurPage(false) === '/'){$isMain = true;}
if(CSite::InDir(SITE_DIR.'personal/')){$isPersonal = true;}
if(CSite::InDir(SITE_DIR.'catalog/')){$isCatalog = true;}
?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		
		<title>
			<?$APPLICATION->ShowTitle();?>
		</title>
		<?$APPLICATION->ShowHead();?>
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="theme-color" content="#fff">
		<meta name="format-detection" content="telephone=no">
		<!-- remove for production-->
		<meta name="robots" content="noindex">
		<?Asset::getInstance()->addCss( SITE_TEMPLATE_PATH . "/css/app.css?v10" ); ?>
		
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	
	<body class="homepage">
		<div id="panel">
			<?$APPLICATION->ShowPanel();?>
		</div>
		
		<div class="page <?if ( $isMain ):?>home<?else:?>inner<?endif;?>">
		
			<header class="header" data-header>
				<div class="header__fix">
				  <div class="container">
					<div class="header__wrapper">
						<div class="header__logo">
							<a class="logo" href="/">
								<svg class="ico ico-logo">
									<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/sprite.svg#ico-logo"></use>
								</svg>
							</a>
						</div>
						
						<div class="header__phone">
									<?$APPLICATION->IncludeComponent(
										"bitrix:main.include",
										"",
										Array(
											"AREA_FILE_SHOW" => "file",
											"AREA_FILE_SUFFIX" => "inc",
											"EDIT_TEMPLATE" => "",
											"PATH" => "/include/telephone.php"
										)
									);?>
						</div>
						
						
							<?
							global $USER;
							$APPLICATION->IncludeComponent(
								"bitrix:main.user.link",
								"",
								Array(
									"CACHE_TIME" => "7200",
									"CACHE_TYPE" => "A",
									"DATE_TIME_FORMAT" => "d.m.Y H:i:s",
									"ID" => $USER->GetID(),
									"NAME_TEMPLATE" => "",
									"PATH_TO_SONET_USER_PROFILE" => "",
									"PROFILE_URL" => "",
									"SHOW_FIELDS" => array(),
									"SHOW_LOGIN" => "Y",
									"SHOW_YEAR" => "N",
									"THUMBNAIL_DETAIL_SIZE" => "100",
									"USER_PROPERTY" => array(),
									"USE_THUMBNAIL_LIST" => "N"
								)
							);?>
						

						  
					  <div class="header__like">
							<?include( $_SERVER["DOCUMENT_ROOT"]."/ajax/top_favorites.php" );?>
					  </div>
					  <div class="header__cart">
						
						<?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "in_header", Array(
								"PATH_TO_BASKET" => "/personals/cart/", 
								"PATH_TO_PERSONAL" => SITE_DIR."personal/",
								"SHOW_PERSONAL_LINK" => "N",
								"SHOW_NUM_PRODUCTS" => "Y",
								"SHOW_TOTAL_PRICE" => "Y",
								"SHOW_PRODUCTS" => "N",
								"POSITION_FIXED" => "N",
							),
							false
						);?>
 
					  </div>
					  <div class="header__hamburger">
						<div class="hamburger hamburger--squeeze" js-hamburger-menu><span class="hamburger-box"><span class="hamburger-inner"></span></span></div>
					  </div>
					</div>
				  </div>
				</div>
				<!-- NAVI :: START-->
				<div class="navi">
				  <div class="container">
					<div class="navi__wrapper">
					
						<?$APPLICATION->IncludeComponent(
							"bitrix:menu", 
							"top", 
							array(
								"ROOT_MENU_TYPE" => "top",
								"MENU_CACHE_TYPE" => "A",
								"MENU_CACHE_TIME" => "36000000",
								"MENU_CACHE_USE_GROUPS" => "Y",
								"MENU_THEME" => "site",
								"CACHE_SELECTED_ITEMS" => "N",
								"MENU_CACHE_GET_VARS" => array(
								),
								"MAX_LEVEL" => "4",
								"CHILD_MENU_TYPE" => "left",
								"USE_EXT" => "Y",
								"DELAY" => "N",
								"ALLOW_MULTI_SELECT" => "N",
								"COMPONENT_TEMPLATE" => "top"
							),
							false
						);?>

						<?$APPLICATION->IncludeComponent(
							"bitrix:search.suggest.input",
							"",
							Array(
								"DROPDOWN_SIZE" => "10",
								"INPUT_SIZE" => "40",
								"NAME" => "q",
								"VALUE" => ""
							)
						);?>
						

					</div>
				  </div>
				</div>
				
						<?$APPLICATION->IncludeComponent(
							"bitrix:menu", 
							"drop", 
							array(
								"ROOT_MENU_TYPE" => "top",
								"MENU_CACHE_TYPE" => "A",
								"MENU_CACHE_TIME" => "36000000",
								"MENU_CACHE_USE_GROUPS" => "Y",
								"MENU_THEME" => "site",
								"CACHE_SELECTED_ITEMS" => "N",
								"MENU_CACHE_GET_VARS" => array(
								),
								"MAX_LEVEL" => "4",
								"CHILD_MENU_TYPE" => "left",
								"USE_EXT" => "Y",
								"DELAY" => "N",
								"ALLOW_MULTI_SELECT" => "N",
								"COMPONENT_TEMPLATE" => "top"
							),
							false
						);?>
				
				
			</header>
			  
			  <!-- MOBILE NAVI :: START-->
			<div class="mobile-navi">
				<div class="mobile-navi__wrapper">
				  <ul class="mobile-navi__menu" data-teleport-target="mobile-menu">
					<!-- teleported content-->
				  </ul>
				  <div class="mobile-navi__search" data-teleport-target="mobile-search">
					<!-- teleported-->
				  </div>
					<div class="mobile-navi__phone">
									<?$APPLICATION->IncludeComponent(
										"bitrix:main.include",
										"",
										Array(
											"AREA_FILE_SHOW" => "file",
											"AREA_FILE_SUFFIX" => "inc",
											"EDIT_TEMPLATE" => "",
											"PATH" => "/include/phone.php"
										)
									);?>
					
					</div>
				  <div class="mobile-navi__socials">
					<div class="navi-drop__socials-list" data-teleport-target="mobile-socials"></div>
				  </div>
				</div>
			  </div>
			  <!-- HEADER :: END-->
			  <div class="page__content">
						
						<?if ( !$isMain ):?>
							<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", ".default", Array(
								"START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
									"PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
									"SITE_ID" => "-",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
								),
								false
							);?>
						<?endif;?>
						
						<?if ( $isPersonal ):?>       
							   <div class="lk">
								<div class="container">
						<?endif;?>
						
						<?if ( !$isPersonal && !$isCatalog && !$isMain):?>       
							<div class="text-page">
								<div class="container">
									<h1><?$APPLICATION->ShowTitle(false);?></h1>
						<?endif;?>