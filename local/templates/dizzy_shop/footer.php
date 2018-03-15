<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>

	<?if ( !$isPersonal && !$isCatalog ):?>       
			</div>
		</div>
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => SITE_DIR."include/main_page_ban1.php",
							"AREA_FILE_RECURSIVE" => "N",
							"EDIT_MODE" => "html",
						),
						false,
						Array('HIDE_ICONS' => 'Y')
					);?>
	<?endif;?>

	<?if ( $isPersonal ):?>   

				<div class="lk__left-sidebar">
						<?$APPLICATION->IncludeComponent(
							"bitrix:menu", 
							"personal_menu", 
							array(
								"ROOT_MENU_TYPE" => "left",
								"MENU_CACHE_TYPE" => "A",
								"MENU_CACHE_TIME" => "36000000",
								"MENU_CACHE_USE_GROUPS" => "Y",
								"MENU_THEME" => "site",
								"CACHE_SELECTED_ITEMS" => "N",
								"MENU_CACHE_GET_VARS" => array(
								),
								"MAX_LEVEL" => "1",
								"CHILD_MENU_TYPE" => "left",
								"USE_EXT" => "Y",
								"DELAY" => "N",
								"ALLOW_MULTI_SELECT" => "N",
								"COMPONENT_TEMPLATE" => "top"
							),
							false
						);?>
				</div>	
				<div class="lk__right-sidebar">
				  <div class="adv">
					<div class="adv__item">
					  <figure class="adv__item-icon">
						<svg class="ico ico-adv-1">
						  <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/sprite.svg#ico-adv-1"></use>
						</svg>
					  </figure>
					  <p class="adv__item-text">Качественное Российское производство</p>
					</div>
					<div class="adv__item">
					  <figure class="adv__item-icon">
						<svg class="ico ico-adv-2">
						  <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/sprite.svg#ico-adv-2"></use>
						</svg>
					  </figure>
					  <p class="adv__item-text">Лучшее сочетание <br>цена-качество</p>
					</div>
					<div class="adv__item">
					  <figure class="adv__item-icon">
						<svg class="ico ico-adv-3">
						  <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/sprite.svg#ico-adv-3"></use>
						</svg>
					  </figure>
					  <p class="adv__item-text">Выгодные условия сотрудничества</p>
					</div>
					<div class="adv__item">
					  <figure class="adv__item-icon">
						<svg class="ico ico-adv-4">
						  <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/sprite.svg#ico-adv-4"></use>
						</svg>
					  </figure>
					  <p class="adv__item-text">Широкий размерный ряд</p>
					</div>
					<div class="adv__item">
					  <figure class="adv__item-icon">
						<svg class="ico ico-adv-5">
						  <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/sprite.svg#ico-adv-5"></use>
						</svg>
					  </figure>
					  <p class="adv__item-text">Бесплатная доставка <br>по Москве      </p>
					</div>
				  </div>
				</div>
    
			</div>
        </div>
	<?endif;?>

				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "sect",
						"AREA_FILE_SUFFIX" => "bottom_text",
						"AREA_FILE_RECURSIVE" => "N",
						"EDIT_MODE" => "html",
					),
					false,
					Array('HIDE_ICONS' => 'Y')
				);?>

</div>
      <!-- FOOTER :: START-->
      <footer class="footer" js-reveal-footer>
        <div class="footer__top">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-lg-3">
                <div class="footer__head">О компании</div>
                <div class="footer__links"><a href="#">О компании	</a><a href="#">Наши сотрудники</a><a href="#">Дипломы и награды</a><a href="#">Благотворительность</a><a href="#">Обратная связь</a></div>
              </div>
              <div class="col-sm-6 col-lg-3">
                <div class="footer__head">Полезная <br>информация</div>
                <div class="footer__links"><a href="#">Размерная сетка</a><a href="#">Используемые материалы </a><a href="#">Уход за одеждой.</a></div>
              </div>
              <div class="col-sm-6 col-lg-3">
                <div class="footer__head">Новости/<br>Акции</div>
                <div class="footer__links"><a href="#">Новости</a><a href="#">Акции</a></div>
              </div>
              <div class="col-sm-6 col-lg-3">
                <div class="footer__head">Магазины</div>
              </div>
            </div>
          </div>
        </div>
        <div class="footer__bottom">
          <div class="container">
            <div class="row">
              <div class="col-md-12 col-lg-6">
                <div class="row">
                  <div class="col-sm-6 col-lg-12">
                    <div class="footer__head">Контакты</div>
                    <div class="footer__contact-row">
                      <div class="footer__icon">
                        <svg class="ico ico-location">
                          <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/sprite.svg#ico-location"></use>
                        </svg>
                      </div>
					  
					  
					  <span>
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							Array(
								"AREA_FILE_SHOW" => "file",
								"PATH" => SITE_DIR."include/footer_contacts.php",
								"AREA_FILE_RECURSIVE" => "N",
								"EDIT_MODE" => "html",
							),
							false,
							Array('HIDE_ICONS' => 'N')
						);?>
					  </span>
                    </div>
                    <div class="footer__contact-row">
                      <div class="footer__icon">
                        <svg class="ico ico-phone">
                          <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/sprite.svg#ico-phone"></use>
                        </svg>
                      </div><span>
									<?$APPLICATION->IncludeComponent(
										"bitrix:main.include",
										"",
										Array(
											"AREA_FILE_SHOW" => "file",
											"AREA_FILE_SUFFIX" => "inc",
											"EDIT_TEMPLATE" => "",
											"PATH" => "/include/footer_phone.php"
										)
									);?>
					  </span>
                    </div>
                    <div class="footer__contact-row">
                      <div class="footer__icon">
                        <svg class="ico ico-mail">
                          <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/sprite.svg#ico-mail"></use>
                        </svg>
                      </div><span>
									<?$APPLICATION->IncludeComponent(
										"bitrix:main.include",
										"",
										Array(
											"AREA_FILE_SHOW" => "file",
											"AREA_FILE_SUFFIX" => "inc",
											"EDIT_TEMPLATE" => "",
											"PATH" => "/include/footer_email.php"
										)
									);?>
					  
					  </span>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-12">
                    <div class="footer__head">Мы в социальных сетях</div>
					
									<?$APPLICATION->IncludeComponent(
										"bitrix:main.include",
										"",
										Array(
											"AREA_FILE_SHOW" => "file",
											"AREA_FILE_SUFFIX" => "inc",
											"EDIT_TEMPLATE" => "",
											"PATH" => "/include/footer_social.php"
										)
									);?>
					
					
                    <div class="footer__copywrite">
						<?$APPLICATION->IncludeComponent(
										"bitrix:main.include",
										"",
										Array(
											"AREA_FILE_SHOW" => "file",
											"AREA_FILE_SUFFIX" => "inc",
											"EDIT_TEMPLATE" => "",
											"PATH" => "/include/copyright.php"
										)
									);?>
</div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-grow-child">
                <div class="footer__map" id="footerMap"></div>
              </div>
            </div>
          </div>
        </div>
      </footer>
	  
		<!-- FOOTER :: END-->
		<div class="popup-dialog popup-auth mfp-hide" id="popup-auth">
			<div class="popup-auth__content">
		
				<?$APPLICATION->IncludeComponent(
					"bitrix:system.auth.form",
					"",
					Array(
						"FORGOT_PASSWORD_URL" => "",
						"PROFILE_URL" => "",
						"REGISTER_URL" => "",
						"SHOW_ERRORS" => "N"
					)
				);?>
			</div>
		</div>
		
		
		<div class="popup-dialog popup-auth mfp-hide" id="popup-reg">
			<div class="popup-auth__content">
		
				<?$APPLICATION->IncludeComponent("bitrix:system.auth.registration","",Array());?>
				
			</div>
		</div>
		
		<div class="popup-dialog popup-fast mfp-hide" id="popup-fast">
		
		</div>
		
      <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
      <script src="<?=SITE_TEMPLATE_PATH?>/js/vendor.js?v10"></script>
	  <script src="<?=SITE_TEMPLATE_PATH?>/js/utils.js"></script>
	  <script src="<?=SITE_TEMPLATE_PATH?>/js/validate.js"></script>
	  <script src="<?=SITE_TEMPLATE_PATH?>/js/main.js"></script>
	  <script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.formstyler.js"></script>
      <script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.elevateZoom-3.0.8.min.js"></script>
	  <script src="<?=SITE_TEMPLATE_PATH?>/js/script.js"></script>
    </div>
  </body>
</html>