<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
use Bitrix\Main\Page\Asset;
if($APPLICATION->GetCurPage(false) === '/'){$isMain = true;}
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
					  <div class="header__logo"><a class="logo" href="/homepage.html">
						  <svg class="ico ico-logo">
							<use xlink:href="img/sprite.svg#ico-logo"></use>
						  </svg></a></div>
					  <div class="header__phone"><a class="h-link" href="tel:+74956451010">+7 (495) 645 10 10</a></div>
					  <div class="header__profile"><span>Личный кабинет</span>
						<div class="header__profile-dropdown">
						  <div class="header__profile-dropdown-menu"><a href="#" data-mfp-src="#popup-auth" js-popup>Вход</a><a href="#">Регистрация</a></div>
						</div>
					  </div>
					  <div class="header__like">
						<svg class="ico ico-like">
						  <use xlink:href="img/sprite.svg#ico-like"></use>
						</svg>
					  </div>
					  <div class="header__cart">
						<svg class="ico ico-cart">
						  <use xlink:href="img/sprite.svg#ico-cart"></use>
						</svg>
						<div class="header__cart-counter"><span>3</span></div>
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
					  <ul class="navi__menu" js-teleport data-teleport-to="mobile-menu" data-teleport-condition="&lt;768">
						<li><a class="js-navi-drop" href="catalog.html" js-navi-drop data-for="catalog">Каталог</a></li>
						<li><a href="collections.html">Коллекции</a></li>
						<li><a href="#">Условия работы</a></li>
						<li><a href="delivery.html">Доставка и оплата</a></li>
						<li><a href="about.html">О компании</a></li>
						<li><a href="contact.html">Контакты</a></li>
					  </ul>
					  <div class="navi__search" js-teleport data-teleport-to="mobile-search" data-teleport-condition="&lt;768">
						<form class="navi__search-form" action="#" js-header-search>
						  <button type="submit"><i class="icon icon-search"></i></button>
						  <input type="text" placeholder="Поиск">
						</form>
					  </div>
					</div>
				  </div>
				</div>
				<!-- DROPDOWN :: START-->
				<div class="navi-drop" data-drop="catalog">
				  <div class="container">
					<div class="row">
					  <div class="col">
						<div class="row navi-drop__menu">
						  <div class="col">
							<div class="navi-drop__icon">
							  <svg class="ico ico-snow">
								<use xlink:href="img/sprite.svg#ico-snow"></use>
							  </svg>
							</div>
							<div class="navi-drop__name">Зима</div>
							<div class="navi-drop__links"><a href="#">Пальто</a><a href="#">Куртки / Парки</a><a href="#">Юбки / Брюки</a><a href="#">Аксессуары</a></div>
						  </div>
						  <!-- col-->
						  <div class="col">
							<div class="navi-drop__icon">
							  <svg class="ico ico-rain">
								<use xlink:href="img/sprite.svg#ico-rain"></use>
							  </svg>
							</div>
							<div class="navi-drop__name">Осень/Весна</div>
							<div class="navi-drop__links"><a href="#">Плащи утепленные</a><a href="#">Куртки / Парки</a><a href="#">Пальто демисезонные</a><a href="#">Плащи / Ветровки</a><a href="#">Аксессуары</a></div>
						  </div>
						  <!--col-->
						  <div class="col">
							<div class="navi-drop__icon">
							  <svg class="ico ico-sun">
								<use xlink:href="img/sprite.svg#ico-sun"></use>
							  </svg>
							</div>
							<div class="navi-drop__name">Лето</div>
							<div class="navi-drop__links"><a href="#">Платья / Комбинезоны</a><a href="#">Блузы / Жакеты</a><a href="#">Юбки</a><a href="#">Брюки</a></div>
						  </div>
						</div>
						<div class="row">
						  <div class="col">
							<div class="navi-drop__socials">
							  <div class="navi-drop__socials-title">Мы в социальных сетях</div>
							  <div class="navi-drop__socials-list" js-teleport data-teleport-to="mobile-socials" data-teleport-condition="&lt;768"><a href="#" target="_blank">
								  <svg class="ico ico-social-vk">
									<use xlink:href="img/sprite.svg#ico-social-vk"></use>
								  </svg></a><a href="#" target="_blank">
								  <svg class="ico ico-social-fb">
									<use xlink:href="img/sprite.svg#ico-social-fb"></use>
								  </svg></a><a href="#" target="_blank">
								  <svg class="ico ico-social-ok">
									<use xlink:href="img/sprite.svg#ico-social-ok"></use>
								  </svg></a></div>
							</div>
						  </div>
						</div>
					  </div>
					  <!-- col last-->
					  <div class="col-md-4 col-grow-child">
						<div class="navi-drop-card"><img class="navi-drop-card__image" src="img/dropdownImg.jpg" srcset="img/dropdownImg@2x.jpg 2x">
						  <div class="navi-drop-card__name">Куртка «Жасмин»</div>
						</div>
					  </div>
					</div>
				  </div>
				</div>
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
				  <div class="mobile-navi__phone"><a class="h-link" href="tel:+74956451010">+7 (495) 645 10 10</a></div>
				  <div class="mobile-navi__socials">
					<div class="navi-drop__socials-list" data-teleport-target="mobile-socials"></div>
				  </div>
				</div>
			  </div>
			  <!-- HEADER :: END-->
			  <div class="page__content">
		