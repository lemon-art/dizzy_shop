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
            error: function (request, error) {
                if (error == "timeout") {
                    alert('timeout');
                }
                else {
                    alert('Error! Please try again!');
                }
            },
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
	$('body').on('click', '.add-to-cart', function(e) {
		
		el = $(this);
		
		if ( el.hasClass('added') ){
			window.location = "/personal/cart/";
		}
		else {
		
			var id = $(this).attr('id');
			arItem = id.split('_');
			var productID = arItem[2];
			var skuDiv = id.replace("add_basket_link","skudiv");
			var arSku = [];
			var i = 0;
			$.each( $('#'+skuDiv + ' .row_prop_sku.selected'), function() { 
				arSku[i] = $(this).data('treevalue');
				i++;
			});
			
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
		
		return false;
		
	   
	});
	
	
	//добавление в избранное товара
	$('body').on('click', '.btn-like', function(e) {
	
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
	$('body').on('click', '.btn-like-button', function(e) {
	
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
	$('body').on('click', '.lk__products-delete', function(e) {
	
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
	$('body').on('change', '.lk-number', function(e) {
	
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
	$('body').on('click', '.lk-num', function(e) {
	
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
	
	
	
	/* 
	//быстрый просмотр
	$('body').on('click', '.fast_view', function(e) {
	
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
		type: 'ajax'
	 });
	
	
	


});