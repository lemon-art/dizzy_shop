$(document).ready(function() {

	//Обработчик формы авторизации
    $('#popup-auth').on('submit', 'form', function () {

        var form_action = $(this).attr('action');
        var form_backurl = $(this).find('input[name="backurl"]').val();

        $.ajax({
            type: "POST",
            url: '/ajax/auth.php',
            data: $(this).serialize(),
            timeout: 3000,
            success: function (data) {
                $('#popup-auth .popup-auth__content').html(data);

                $('#popup-auth form').attr('action', form_action);
                $('#popup-auth input[name=backurl]').val(form_backurl);
            }
        });

        return false;
    });


	//Обработчик формы регистрации
    $('#popup-reg').on('submit', 'form', function () {

        var form_action = $(this).attr('action');
        var form_backurl = $(this).find('input[name="backurl"]').val();

        $.ajax({
            type: "POST",
            url: '/ajax/auth.php',
            data: $(this).serialize(),
            success: function (data) {

                $('#popup-reg .popup-auth__content').html(data);

                $('#popup-reg form').attr('action', form_action);
                $('#popup-reg input[name=backurl]').val(form_backurl);



            }
        });

        return false;
    });


	//положить в корзину
  $(document).on('click', '.add-to-cart', function(e) {

		el = $(this);

		if ( el.hasClass('added') ){
			window.location = "/personal/cart/";
		}
		else {

			var id = $(this).attr('id');
			arItem = id.split('_');
			var productID = arItem[2];
			var arSku = [];
			var i = 0;
			$.each( $('.card__size-group .row_prop_sku.selected'), function() {
				arSku[i] = $(this).data('treevalue');
				i++;
			});
			
			if ( i > 0 ){

				var postData = {
				  productID: productID,
				  skuProps: arSku
				};

				$.post("/ajax/add_to_cart.php", postData,
					function(data){
					
				
						el.addClass('added').find('span').text('Добавлено в корзину');

						$.post("/ajax/top_basket.php", {},
						  function(data){
							$('.header__cart').html( data );
						});
						

				});
				
			}
			else {
				$('#error_table').show();
			}
		}

		return false;


	});

	//положить в корзину опт
	 $(document).on('click', '.add-to-cart-opt', function(e) {

			elButton = $(this);
			
			if ( elButton.hasClass('added') ){
				window.location = "/personal/cart/";
			}
			else {
				$('#error_table').hide();
				var makeOrder = 0;
				$(".table-size input").each(function (index, el){

					var v  = parseInt($(el).val());
					if ( v > 0 ){
						makeOrder = 1;
					}
				});
				
				if ( makeOrder ){
				
					form = $('.table-size-scroll').find('form');
					$.post("/ajax/add_to_cart_opt.php", form.serialize(),
						function(data){
							
							elButton.addClass('added').find('span').text('Добавлено в корзину');
							
							$.post("/ajax/top_basket.php", {},
							  function(data){
								$('.header__cart').html( data );
							});

					});
				
				
				}
				else {
					$('#error_table').show();
				}
			}

			return false;


	});
	
	//проверка полей оптового заказа
	$(document).on('change', '.table-size input', function() {

		$('#error_table').hide();
		el = $(this);
		var v    = parseInt($(el).val());
		var max  = parseInt($(el).data('max'));
		
		if (!isNaN(parseFloat(v))){
			if ( v > max ){
				$(el).val(max);
			}

			if ( v < 0 ){
				$(el).val('0');
			}
		}
		else {
			$(el).val('');
		}
		
		
		if ( el.hasClass('in_cart') ){
		
			var id_basket = el.data('id');
			var product_id = el.data('product_id');
			var quantity = el.val();

			$.post("/ajax/basket_quant.php", { id_basket: id_basket, product_id: product_id, quantity: quantity },
			  function(data){

						$.post("/personal/cart/?is_ajax=y", {},
						  function(data){
							$('#basket_bx').html( data );
						});

						$.post("/ajax/top_basket.php", {},
						  function(data){
							$('.header__cart').html( data );
							BX.closeWait('basket_bx', wait);
						});

			});
		}
		
		return false;


	});
		
		
	//добавление в избранное товара
  $(document).on('click', '.btn-like', function(e) {

		el = $(this);

		if ( el.hasClass('active') ){
			var action = 'delete';
			el.find('span').html('Добавить в список<br>желаний');
		}
		else {
			var action = 'add';
			el.find('span').html('Убрать из списка<br>желаний');
		}
		var id = el.attr('data-id');
		$(this).toggleClass('active');

		if ( el.hasClass('lk__products-delete') ){
			$(this).parents('tr').remove();
		};

		$.post("/ajax/add_to_like.php", { ProductID: id, ACTION: action },
		  function(data){



			$.post("/ajax/top_favorites.php", {},
			  function(data){
				$('.header__like').html( data );

			});
		});

		return false;

	});

	//добавление в избранное товара
  $(document).on('click', '.btn-like-button', function(e) {

		el = $(this);

		if ( el.hasClass('active') ){
			var action = 'delete';
		}
		else {
			var action = 'add';
		}
		var id = el.attr('data-id');
		$(this).toggleClass('active');



		$.post("/ajax/add_to_like.php", { ProductID: id, ACTION: action },
		  function(data){


			$.post("/ajax/top_favorites.php", {},
			  function(data){
				$('.header__like').html( data );

			});
		});
		return false;
	});

	//удаление товара из корзины
  $(document).on('click', '.lk__products-delete', function(e) {

		var wait = BX.showWait('basket_bx');
		el = $(this);

		var id = el.attr('data-id');

		$.post("/ajax/basket_del.php", { id: id },
		  function(data){


					$.post("/ajax/top_basket.php", {},
					  function(data){
						$('.header__cart').html( data );
					});

					$.post("/personal/cart/?is_ajax=y", {},
					  function(data){
						$('#basket_bx').html( data );
						BX.closeWait('basket_bx', wait);
					});

		});
		return false;
	});

	//изменение товара из корзины
  $(document).on('change', '.lk-number', function(e) {

		var wait = BX.showWait('basket_bx');
		el = $(this);
		var id_basket = el.data('id');
		var quantity = el.val();

		$.post("/ajax/basket_quant.php", { id_basket: id_basket, quantity: quantity },
		  function(data){

					$.post("/personal/cart/?is_ajax=y", {},
					  function(data){
						$('#basket_bx').html( data );
					});

					$.post("/ajax/top_basket.php", {},
					  function(data){
						$('.header__cart').html( data );
						BX.closeWait('basket_bx', wait);
					});

		});


		return false;
	});

	//изменение товара из корзины
  $(document).on('click', '.lk-num', function(e) {

		el = $(this);
		el_num = $(this).parent().find('.lk-number');
		var num = parseInt(el_num.val());

		if ( el.hasClass('minus') ){
			el_num.val( num - 1 ).change();
		}
		else {
			el_num.val( num + 1 ).change();
		}
		return false;
	});

	
	//положить в корзину
	$(document).on('change', '[name="agree"]', function(e) {
		$('[name="register_submit_button"]').prop('disabled', function(i, v) { return !v; });
	});


	/*
	//быстрый просмотр
	$(document).on('click', '.fast_view', function(e) {

		el = $(this);
		var id = el.attr('data-id');


		$.post("/ajax/fast_element.php", { ProductID: id },
		  function(data){
			$('#popup-fast').html( data );
			alert(data);
			$('#popup-fast').magnificPopup({
				type: 'inline',
				fixedContentPos: true,
				fixedBgPos: true,
				overflowY: 'scroll',
				closeBtnInside: true,
				preloader: false,
				midClick: true,
				removalDelay: 300,
				mainClass: 'popup-buble',
            }).magnificPopup('open');

		});

	});
	*/


	$('.fast_view').magnificPopup({
		type: 'ajax',
		callbacks: {
		  ajaxContentAdded: function() {
				
				$('[data-gallery]').each(function () {

					var gallery = $(this),
					  gallerySlides = gallery.find('[data-gallery-slides]'),
					  galleryThumbs = gallery.find('[data-gallery-thumbs]')

					gallerySlides.on('init afterChange',
					  function (event, slick, currentSlide, nextSlide) {
					  })

					gallerySlides.slick({
					  slidesToShow: 1,
					  slidesToScroll: 1,
					  arrows: false,
					  fade: false,
					  asNavFor: galleryThumbs,
					  infinite: true,
					  mobileFirst: true,
					  adaptiveHeight: true,
					  responsive: [
						{
						  breakpoint: 568,
						  settings: {
							fade: true,
						  },
						},
						{
						  breakpoint: 992,
						  settings: {
							fade: true,
							adaptiveHeight: false,
						  },
						},
					  ],
					})

					galleryThumbs.slick({
					  infinite: true,
					  slidesToShow: 3,
					  slidesToScroll: 1,
					  asNavFor: gallerySlides,
					  dots: false,
					  centerMode: false,
					  focusOnSelect: true,
					  vertical: false,
					  arrows: true,
					  mobileFirst: true,
					  responsive: [
						{
						  breakpoint: 568,
						  settings: {
							vertical: true,
						  },
						},
						{
						  breakpoint: 768,
						  settings: {
							vertical: false,
						  },
						},
						{
						  breakpoint: 992,
						  settings: {
							vertical: true,
						  },
						},
					  ],
					})
				  });
				  

				  $('.card__details').
					find('dt:first-child').
					addClass('is-active').
					next('dd').
					show()
					

				  $('.card__details').on('click', 'dt', function (event) {
					event.preventDefault()
					if ($(this).is('.is-active')) {
					  $(this).removeClass('is-active').next('dd').slideUp('fast')
					}
					else {
					  $('.card__details').
						find('dt').
						removeClass('is-active').
						next('dd').
						slideUp('fast')

					  $(this).addClass('is-active').next('dd').slideDown('fast')
					}
				  })

				  $('[data-gallery-slides]').
					on('mouseover', '[data-slick-index]', function (event) {
					  event.preventDefault()
					  var dataIndex = $(this).data('slick-index')

					  $('.zoomContainer').
						removeClass('is-visible').
						eq(dataIndex).
						addClass('is-visible')
					})
				  
		  }
		}
	 });
	 
	 $('.popup_size').magnificPopup({
		type: 'ajax',
	 });
 
	//выбор цвета в быстром просмотре
	$(document).on('click', '.popup_color', function(e) {
		
		
			var url = $(this).attr('href');
			
			$.magnificPopup.open({
			  items: {
				src: url
			  },
			  type: 'ajax'
			});
		/*
		$.post( url,
		  function(data){
			//$('.mfp-content').html( data );
			

			
			
		});
		*/
		return false;
	});





});