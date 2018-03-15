<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);


?>

		<div class="home-promo">
          <div class="container">
            <div class="title"><a href="catalog.html"><?=GetMessage('TITLE_1')?></a></div>
            <div class="home-promo__wrapper">
              <div class="row"> 
				<div class="col-md-6"><a class="promo-card promo-card--1" href="#">
                    <div class="promo-card__image promo-card__image--tr-bottom" style="top: 0; right: 0px; z-index: 3;">
						<img src="<?=$arResult["ITEMS"][0]["PREVIEW_PICTURE"]["SRC"]?>"></div>
                    <div class="promo-card__content promo-card-discount">
                      <div class="promo-card-discount__name"><?=$arResult["ITEMS"][0]["NAME"]?></div>
                      <div class="promo-card-discount__short"><?=$arResult["ITEMS"][0]["PREVIEW_TEXT"]?></div>
                    </div></a>
                  <div class="row">
                    <div class="col-md-6"><a class="promo-card promo-card--2 promo-card--bg-peach" href="#">
                        <div class="promo-card__image" style="top:-19px; left: 5px; z-index: 3;"><img src="img/promoCard-2.png" srcset="img/promoCard-2@2x.png 2x"></div>
                        <div class="promo-card__content promo-card-regular">
                          <div class="promo-card-regular__name">Пальто</div>
                          <div class="promo-card-regular__short">Осень—Зима’13</div>
                          <div class="promo-card-regular__cta">Последняя <br> цена!</div>
                        </div></a></div>
                    <div class="col-md-6"><a class="promo-card promo-card--3 promo-card--bg-peach" href="#">
                        <div class="promo-card__content">
                          <div class="promo-card-center">
                            <div class="promo-card-center__front">-35%</div>
                            <div class="promo-card-center__subject">Платья</div>
                            <div class="promo-card-center__short">Осень—Зима’13</div>
                          </div>
                        </div></a></div>
                  </div>
                </div>
                <div class="col-md-6"><a class="promo-card promo-card--4 promo-card--huge" href="#">
                    <div class="promo-card__image" style="bottom: 0px; left: 15px; z-index: 3;"><img src="img/promoCard-3.png" srcset="img/promoCard-3@2x.png 2x"></div>
                    <div class="promo-card__content promo-card-huge">
                      <div class="promo-card-huge__name">Весна/<br>Лето’16</div>
                      <div class="promo-card-huge__percent">%</div>
                    </div></a></div>
              </div>
            </div>
          </div>
        </div>



