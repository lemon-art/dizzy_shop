<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>

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
                          <use xlink:href="img/sprite.svg#ico-location"></use>
                        </svg>
                      </div><span>111024, г. Москва, ул.Авиамоторная, д.44, стр.1 <br> (м.Авиамоторная) (территория бывшего  таксомоторного парка).</span>
                    </div>
                    <div class="footer__contact-row">
                      <div class="footer__icon">
                        <svg class="ico ico-phone">
                          <use xlink:href="img/sprite.svg#ico-phone"></use>
                        </svg>
                      </div><span><a href="tel:+74956478901">+7 (495) 647-89-01</a> (многоканальный), <br> <a href="tel:+74957960605">+7 (495) 796-06-05</a></span>
                    </div>
                    <div class="footer__contact-row">
                      <div class="footer__icon">
                        <svg class="ico ico-mail">
                          <use xlink:href="img/sprite.svg#ico-mail"></use>
                        </svg>
                      </div><span><a href="mailto:sales@diway.ru">sales@diway.ru</a></span>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-12">
                    <div class="footer__head">Мы в социальных сетях</div><a class="footer__social" href="#" target="_blank">
                      <div class="footer__icon">
                        <svg class="ico ico-social-vk">
                          <use xlink:href="img/sprite.svg#ico-social-vk"></use>
                        </svg>
                      </div><span>Vkontakte</span></a><a class="footer__social" href="#" target="_blank">
                      <div class="footer__icon">
                        <svg class="ico ico-social-fb">
                          <use xlink:href="img/sprite.svg#ico-social-fb"></use>
                        </svg>
                      </div><span>Facebook  </span></a><a class="footer__social" href="#" target="_blank">
                      <div class="footer__icon">
                        <svg class="ico ico-social-ok">
                          <use xlink:href="img/sprite.svg#ico-social-ok"></use>
                        </svg>
                      </div><span>Odnoklassniki  </span></a><a class="footer__social" href="#" target="_blank">
                      <div class="footer__icon"><i class="icon icon-social-insta"></i></div><span>Instagram  </span></a>
                    <div class="footer__copywrite">Copyright © 2017 www.diway.ru</div>
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
          <div class="lk__heading">Вход</div>
          <form class="lk__form popup-auth__form">
            <div class="ui-group">
              <label class="ui-label">Email</label>
              <input class="ui-input" type="email" name="email" placeholder="Введите email">
            </div>
            <div class="ui-group">
              <label class="ui-label">Пароль</label>
              <input class="ui-input" type="password" name="password" placeholder="Введите пароль">
            </div>
            <div class="ui-group">
              <div class="popup-auth__link"><a href="#">Забыли пароль?</a></div>
            </div>
            <div class="popup-auth__submit">
              <div class="popup-auth__submit-item">
                <button class="btn btn-primary btn-primary_gray"><span>Регистрация</span></button>
              </div>
              <div class="popup-auth__submit-item">
                <button class="btn btn-primary"><span>Войти</span></button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
      <script src="<?=SITE_TEMPLATE_PATH?>/js/vendor.js?v10"></script>
      <script src="<?=SITE_TEMPLATE_PATH?>/js/app.js?v10"></script>
    </div>
  </body>
</html>