var myMap,myPlacemark,myMap2,myPlacemark2;function initMap(){(myMap=new ymaps.Map("footerMap",{center:[55.739483,37.719603],zoom:14})).controls.remove("trafficControl"),myMap.controls.remove("searchControl"),myMap.controls.remove("fullscreenControl"),myMap.controls.remove("rulerControl"),myMap.controls.remove("geolocationControl"),myMap.controls.remove("routeEditor"),myMap.behaviors.disable("scrollZoom"),myPlacemark=new ymaps.Placemark([55.739483,37.719603],{hintContent:"Наш офис"},{iconLayout:"default#image",iconImageHref:"img/el/marker.png",iconImageSize:[50,70],iconImageOffset:[-10,-50]}),myMap.geoObjects.add(myPlacemark),$("#contactMap").length&&((myMap2=new ymaps.Map("contactMap",{center:[55.739483,37.719603],zoom:14})).controls.remove("trafficControl"),myMap2.controls.remove("searchControl"),myMap2.controls.remove("fullscreenControl"),myMap2.controls.remove("rulerControl"),myMap2.controls.remove("geolocationControl"),myMap2.controls.remove("routeEditor"),myMap2.behaviors.disable("scrollZoom"),myPlacemark2=new ymaps.Placemark([55.739483,37.719603],{hintContent:"Наш офис"},{iconLayout:"default#image",iconImageHref:"img/el/marker.png",iconImageSize:[50,70],iconImageOffset:[-10,-50]}),myMap2.geoObjects.add(myPlacemark2))}$(document).ready(function(){var l=$(window),e=$(document);/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)?$("html").addClass("touch-device"):$("html").addClass("no-touch-device"),(0<window.navigator.userAgent.indexOf("MSIE ")||navigator.userAgent.match(/Trident.*rv\:11\./))&&$("body").addClass("is-ie");var i=768;svg4everybody(),viewportUnitsBuggyfill.init({force:!0,refreshDebounceWait:250}),$('[href="#"]').click(function(e){e.preventDefault()}),$('a[href^="#section"]').click(function(){var e=$(this).attr("href");return $("body, html").animate({scrollTop:$(e).offset().top},1e3),!1}),$("[js-up]").on("click",function(e){e.preventDefault(),$("html,body").animate({scrollTop:0},1200)});var t=$("[data-header]"),a=!1,o=!1,s=0;function n(){$("[js-hamburger-menu]").removeClass("is-active"),$(".mobile-navi").removeClass("is-active"),$(".header").removeClass("header--showing-menu")}function r(){var e=$("[data-zoom-image]");768<l.width()?e.elevateZoom({zoomActivation:"hover",zoomEnabled:!0,preloading:1,zoomLevel:1,scrollZoom:!1,scrollZoomIncrement:.1,minZoomLevel:!1,maxZoomLevel:!1,easing:!1,easingAmount:12,zoomWindowWidth:400,zoomWindowHeight:600,zoomWindowOffetx:0,zoomWindowOffety:0,zoomWindowPosition:1,zoomWindowBgColour:"#fff",lensFadeIn:!1,lensFadeOut:!1,debug:!1,zoomWindowFadeIn:!1,zoomWindowFadeOut:!1,zoomWindowAlwaysShow:!1,zoomTintFadeIn:!1,zoomTintFadeOut:!1,borderSize:2,showLens:!0,borderColour:"#FF8F5B",lensBorderSize:1,lensBorderColour:"#FF8F5B",zoomType:"window",containLensZoom:!1,lensColour:"white",lensOpacity:.4,lenszoom:!1,tint:!1,tintColour:"#333",tintOpacity:.4,gallery:!1,galleryActiveClass:"zoomGalleryActive",imageCrossfade:!1,constrainType:!1,constrainSize:!1,loadingIcon:!1,cursor:"pointer",responsive:!0}):($(".zoomContainer").remove(),e.removeData("elevateZoom"),e.removeData("zoomImage"))}l.scrolled(10,function(){var e=l.scrollTop();100<e?(s<e&&o?(t.removeClass("header--show-menu"),o=!1):e<s&&!o&&(t.addClass("header--show-menu"),o=!0),s=e,a||(t.addClass("header--fixed"),a=!0)):e<100&&a&&(t.removeClass("header--fixed header--show-menu"),a=!1)}),e.on("click","[data-toggle-class]",function(){return $($(this).data("toggleClassElement")).toggleClass($(this).data("toggleClass")),!1}),$("[js-hamburger-menu]").on("click",function(){$(this).toggleClass("is-active"),$(".mobile-navi").toggleClass("is-active"),$(".header").toggleClass("header--showing-menu")}),$(".page__content").click(function(e){n()}),l.resized(100,function(){l.width()>i&&n()}),$(".navi__menu li").each(function(e,i){$(i).find("a").attr("href")==window.location.pathname.split("/").pop()?$(i).addClass("is-active"):$(i).removeClass("is-active")}),$("[js-navi-drop]").each(function(e,i){var t=$(i).data("for"),a="[data-drop="+t+"]";$(".navi__menu").on("mouseenter","a[data-for="+t+"]",function(){$(a).addClass("is-active")}).on("mouseleave","a[data-for="+t+"]",function(){$(a).removeClass("is-active")}),$(document).on("mouseenter",a,function(){$(a).addClass("is-active")}),$(document).on("mouseleave",a,function(){$(a).removeClass("is-active")})}),$(".header__profile").hover(function(){$(".header__profile-dropdown").addClass("is-active")},function(){$(".header__profile-dropdown").removeClass("is-active")}),$(document).on("click","[js-header-search]",function(e){$(this).is("is-active")||($(".navi__menu").hide(),$(this).parent().addClass("is-active"),e.preventDefault())}),$("[js-header-search]").on("submit",function(e){e.preventDefault()}),$(document).click(function(e){$(e.target).closest("[js-header-search]").length||($(".navi__menu").show(),$("[js-header-search]").parent().removeClass("is-active"))}),$(".benefits__card").on("click",function(e){l.width()<i&&$(this).find(".benefits__card-plus").click()}),$("[js-hero-slider]").slick({autoplay:!0,autoplaySpeed:5e3,pauseOnHover:!1,fade:!1,dots:!0,arrows:!1,infinite:!0,speed:300,slidesToShow:1,slidesToScroll:1,accesability:!1,variableHeight:!1}),$("[js-slider]").each(function(e,i){var t=$(i);t.on("init",function(e){$(e.target).attr("data-current-slide",1)});var a={autoplay:void 0!==t.data("slick-autoplay")&&t.data("slick-autoplay"),dots:void 0!==t.data("slick-dots")&&t.data("slick-dots"),arrows:void 0!==t.data("slick-arrows")&&t.data("slick-arrows"),infinite:void 0!==t.data("slick-infinite")&&t.data("slick-infinite"),speed:300,accessibility:!1,adaptiveHeight:!0,slidesToShow:void 0===t.data("slick-slides")||t.data("slick-slides"),draggable:void 0===t.data("slick-controls")||t.data("slick-controls"),swipe:void 0===t.data("slick-controls")||t.data("slick-controls"),swipeToSlide:void 0===t.data("slick-controls")||t.data("slick-controls"),touchMove:void 0===t.data("slick-controls")||t.data("slick-controls"),responsive:[{breakpoint:1100,settings:{slidesToShow:5}},{breakpoint:992,settings:{slidesToShow:4}},{breakpoint:768,settings:{slidesToShow:3}},{breakpoint:568,settings:{slidesToShow:2}},{breakpoint:414,settings:{slidesToShow:1}}]};t.slick(a),t.on("beforeChange",function(e,i,t,a){i.$slider.attr("data-current-slide",a+1)})}),$("[js-slick-next]").on("click",function(){$(this).closest("[js-slider]").slick("slickNext")}),$("[js-slick-prev]").on("click",function(){$(this).closest("[js-slider]").slick("slicPrev")}),$(".js-tabs__menu").on("click","li:not(.active)",function(){$(this).addClass("is-active").siblings().removeClass("is-active").closest(".js-tabs").find(".js-tabs__panel").removeClass("is-active").eq($(this).index()).addClass("is-active")}),$(".lk__orders-group").on("click",".lk__orders-group-trigger",function(){$(this).closest(".lk__orders-group").is(".is-open")?$(this).closest(".lk__orders-group").removeClass("is-open").find(".lk__orders-group-content").hide():($(".lk__orders-group").removeClass("is-open").find(".lk__orders-group-content").hide(),$(this).closest(".lk__orders-group").addClass("is-open").find(".lk__orders-group-content").show())}),$(".sorting__select").on("click",".sorting__select-trigger",function(e){e.preventDefault(),$(this).is(".is-active")?$(this).removeClass("is-active").closest(".sorting__select").removeClass("is-open"):$(this).addClass("is-active").closest(".sorting__select").addClass("is-open")}),$(".sorting__select").on("click",".sorting__select-option",function(e){e.preventDefault(),$(".sorting__select-option").removeClass("is-active"),$(this).addClass("is-active");var i=$(this).text();$(".sorting__select-trigger").text(i),alert(i)}),$("body").on("click",function(e){0==$(e.target).closest(".sorting__select").length&&$(".sorting__select, .sorting__select-trigger").removeClass("is-open is-active")}),$(".filter").on("click",".filter__toggle",function(e){e.preventDefault(),$(this).is(".is-active")?($(this).removeClass("is-active").text("Показать фильтр"),$(".filter__dropdown").slideUp("fast")):($(this).addClass("is-active").text("Скрыть фильтр"),$(".filter__dropdown").slideDown("fast"))}),$(".filter-group").on("change","input",function(e){var i=$(this).closest(".filter-group");1<=i.find("input:checked").length?i.addClass("is-change"):i.removeClass("is-change")}),$(".filter-group").on("change","input[type=range]",function(e){$(this).closest(".filter-group").addClass("is-change")}),$(".filter-group").on("click",".filter-group__reset",function(e){e.preventDefault();var i=$(this).closest(".filter-group");i.removeClass("is-change").find("input:checked").prop("checked",!1),i.find("input[type=range]").data("ionRangeSlider").update({from:3e3,to:25e3}),i.removeClass("is-change")}),$(".filter-group").on("click",".filter-group__btn",function(e){e.preventDefault(),$(this).closest(".filter-group").find(".filter-group__content").is(":hidden")?$(this).closest(".filter-group").removeClass("is-open").find(".filter-group__content").slideDown("fast"):$(this).closest(".filter-group").addClass("is-open").find(".filter-group__content").slideUp("fast")}),$(".filter").on("click",".btn-reset",function(e){$(".filter-group").find("input[type=range]").data("ionRangeSlider").update({from:3e3,to:25e3}),$(".filter-group").removeClass("is-change")}),$("[data-benefits-slides]").slick({slidesToShow:1,slidesToScroll:1,arrows:!0,fade:!1,infinite:!0,dots:!0}),$("[data-card]").each(function(){var e=$(this),i=e.find("[data-card-slides]"),t=e.find("[data-card-thumbs]");i.slick({slidesToShow:1,slidesToScroll:1,arrows:!0,fade:!0,asNavFor:t,infinite:!0,responsive:[{breakpoint:767,settings:{fade:!1}}]}),t.slick({infinite:!0,slidesToShow:4,slidesToScroll:1,asNavFor:i,dots:!1,centerMode:!1,focusOnSelect:!0,vertical:!0,arrows:!0,centerPadding:"80px"})}),$("[data-gallery]").each(function(){var e=$(this),i=e.find("[data-gallery-slides]"),t=e.find("[data-gallery-thumbs]");i.on("init afterChange",function(e,i,t,a){$("[data-color]").removeClass("is-active").eq(i.currentSlide).addClass("is-active")}),i.slick({slidesToShow:1,slidesToScroll:1,arrows:!1,fade:!1,asNavFor:t,infinite:!0,mobileFirst:!0,adaptiveHeight:!0,responsive:[{breakpoint:568,settings:{fade:!0}},{breakpoint:992,settings:{fade:!0,adaptiveHeight:!1}}]}),t.slick({infinite:!0,slidesToShow:3,slidesToScroll:1,asNavFor:i,dots:!1,centerMode:!1,focusOnSelect:!0,vertical:!1,arrows:!0,mobileFirst:!0,responsive:[{breakpoint:568,settings:{vertical:!0}},{breakpoint:768,settings:{vertical:!1}},{breakpoint:992,settings:{vertical:!0}}]})}),$("[data-color]").on("click",function(e){e.preventDefault();var i=$(this).data("color"),t=$(this).index();""===i&&(i="Цвет не указан"),$("[data-color]").removeClass("is-active").eq(t).addClass("is-active"),$("[data-color-selected]").text(i),$("[data-gallery-slides]").slick("slickGoTo",t)}),r(),l.resized(300,r),$("[data-gallery-slides]").on("mouseover","[data-slick-index]",function(e){e.preventDefault();var i=$(this).data("slick-index");$(".zoomContainer").removeClass("is-visible").eq(i).addClass("is-visible")}),$(document).on("click",".zoomContainer",function(e){e.preventDefault();var i=$(this).index()-3;$('[data-slick-index="'+i+'"]').find("[data-mfp-galllery]").trigger("click")}),$("[data-mfp-galllery]").magnificPopup({type:"image",closeOnContentClick:!1,closeBtnInside:!1,tLoading:"Загрузка #%curr%...",mainClass:"mfp-with-scale",removalDelay:300,gallery:{enabled:!0,navigateByImgClick:!0,preload:[0,1],tPrev:"Назад",tNext:"Вперед",tCounter:'<span class="mfp-counter"><span>%curr%</span> из %total%</span>'},image:{verticalFit:!0,tError:'<a href="%url%">Изображение #%curr%</a> не может быть загружено.'}}),$(".ui-select, .ui-number").styler({selectSmartPositioning:!1,selectSearch:!1,selectVisibleOptions:0,selectSearchLimit:6}),$(".ui-range__input").ionRangeSlider({type:"double",from:0,step:1,hide_min_max:!0,hide_from_to:!0,force_edges:!0,grid:!1}),$(".ui-range__input").on("change",function(e){e.preventDefault();var i=$(this),t=(i.data("ionRangeSlider"),i.data("from")),a=i.data("to");i.closest(".ui-range").find(".ui-range__from").text(t),i.closest(".ui-range").find(".ui-range__to").text(a)}),$(".card__details").find("dt:first-child").addClass("is-active").next("dd").show(),$(".card__details").on("click","dt",function(e){e.preventDefault(),$(this).is(".is-active")?$(this).removeClass("is-active").next("dd").slideUp("fast"):($(".card__details").find("dt").removeClass("is-active").next("dd").slideUp("fast"),$(this).addClass("is-active").next("dd").slideDown("fast"))}),$("[data-close-popup]").on("click",function(){return $.magnificPopup.close(),!1}),$("[js-popup]").magnificPopup({type:"inline",fixedContentPos:!0,fixedBgPos:!0,overflowY:"scroll",closeBtnInside:!0,preloader:!1,midClick:!0,removalDelay:300,mainClass:"popup-buble",callbacks:{beforeOpen:function(){$("[data-benefits-slides]").slick("slickGoTo",$.magnificPopup.instance.index)},close:function(){}}}),$("[js-popup-gallery]").magnificPopup({delegate:"a",type:"image",closeOnContentClick:!1,closeBtnInside:!1,tLoading:"Loading image #%curr%...",mainClass:"mfp-with-zoom mfp-img-mobile",removalDelay:300,gallery:{enabled:!0,navigateByImgClick:!0,preload:[1,1]},image:{verticalFit:!0,tError:'<a href="%url%">Изображение #%curr%</a> не может быть загружено.',tCounter:'<span class="mfp-counter"><span>%curr%</span> из %total%</span>'},zoom:{enabled:!0,duration:300,easing:"ease-out",opener:function(e){return e.find("img")}}}),$("[js-teleport]").each(function(e,i){var t=$(i),a=$(i).html(),o=$("[data-teleport-target="+$(i).data("teleport-to")+"]"),s=$(i).data("teleport-condition").substring(1),n=$(i).data("teleport-condition").substring(0,1);if(o&&a&&n){function r(){var e;"<"===n?e=l.width()<s:">"===n&&(e=l.width()>s),e?(o.html(a),t.html("")):(t.html(a),o.html(""))}l.resized(100,function(){r()}),r()}}),$("[js-tab]").each(function(e,i){var t=$(i);t.on("click",function(){var e=t.data("tab-for"),i=$("[data-tab="+e+"]");i&&(i.siblings().removeClass("is-active"),t.siblings().removeClass("is-active"),i.addClass("is-active"),t.addClass("is-active"))})}),$(".card__check-input").on("change",function(){$(this).parent().siblings().find("input").prop("checked",!1)}),$(".ui-number span").on("click",function(e){var i=$(this).parent().find("input"),t=parseInt($(this).parent().find("input").val())||0;if("minus"==$(this).data("action")){if(t<=1)return!1;i.val(t-1)}else if("plus"==$(this).data("action")){if(99<=t)return!1;i.val(t+1)}}),$(document).one("focus.js-autoExpand","textarea.js-autoExpand",function(){var e=this.value;this.value="",this.baseScrollHeight=this.scrollHeight,this.value=e}).on("input.js-autoExpand","textarea.js-autoExpand",function(){var e,i=0|this.getAttribute("data-min-rows");this.rows=i,e=Math.ceil((this.scrollHeight-this.baseScrollHeight)/17),this.rows=i+e}),$(".js-dateMask").mask("99.99.99",{placeholder:"ДД.ММ.ГГ"}),$("input[type='tel']").mask("+7 (000) 000-0000",{placeholder:"+7 (___) ___-____"})}),ymaps.ready(initMap),function(s){var e=0;s.fn.scrolled=function(t,a){"function"==typeof t&&(a=t,t=50);var o="scrollTimer"+e++;this.scroll(function(){var e=s(this),i=e.data(o);i&&clearTimeout(i),i=setTimeout(function(){e.removeData(o),a.call(e[0])},t),e.data(o,i)})}}(jQuery),function(s){var e=0;s.fn.resized=function(t,a){"function"==typeof t&&(a=t,t=50);var o="scrollTimer"+e++;this.resize(function(){var e=s(this),i=e.data(o);i&&clearTimeout(i),i=setTimeout(function(){e.removeData(o),a.call(e[0])},t),e.data(o,i)})}}(jQuery),$(document).ready(function(){var e=function(e,i){e.addClass("ui-group__validation"),e.appendTo(i.parent("div"))},i=function(e){$(e).parent("div").addClass("has-error")},t=function(e){$(e).parent("div").removeClass("has-error")},a=function(t){$(t).addClass("loading"),$.ajax({type:"POST",url:$(t).attr("action"),data:$(t).serialize(),success:function(e){$(t).removeClass("loading");var i=$.parseJSON(e);"success"==i.status||$(t).find("[data-error]").html(i.message).show()}})};$(".js-registration-form").validate({errorPlacement:e,highlight:i,unhighlight:t,submitHandler:a,rules:{last_name:"required",first_name:"required",email:{required:!0,email:!0},password:{required:!0,minlength:6}},messages:{last_name:"Заполните это поле",first_name:"Заполните это поле",email:{required:"Заполните это поле",email:"Email содержит неправильный формат"},password:{required:"Заполните это поле",email:"Пароль мимимум 6 символов"}}}),$("[js-validate-form]").validate({errorPlacement:e,highlight:i,unhighlight:t,submitHandler:a,rules:{last_name:"required",first_name:"required",org:"required",email:{required:!0,email:!0},password:{required:!0,minlength:6},password_confirm:{required:!0,minlength:6,equalTo:"#password"},phone:{required:!0,normalizer:function(e){return e&&"+X (XXX) XXX-XXXX"!==e?e.replace(/[^\d]/g,""):e},minlength:11,digits:!0}},messages:{last_name:"Заполните это поле",first_name:"Заполните это поле",org:"Заполните это поле",email:{required:"Заполните это поле",email:"Email содержит неправильный формат"},password:{required:"Заполните это поле",minlength:"Миниальное количество символов 6"},password_confirm:{required:"Заполните это поле",minlength:"Миниальное количество символов 6",equalTo:"Пароли не совпадают"},phone:{required:"Заполните это поле",minlength:"Введите корректный телефон"}}}),$("[js-validate-contact]").validate({errorPlacement:e,highlight:i,unhighlight:t,submitHandler:a,rules:{name:"required",email:{required:!0,email:!0},message:{required:!0,minlength:10}},messages:{name:"Заполните это поле",email:{required:"Заполните это поле",email:"Email содержит неправильный формат"},message:{required:"Заполните это поле",minlength:"Сообщение слишком короткое"}}})});