$(document).ready(function(){
  ////////////////
  // FORM VALIDATIONS
  ////////////////

  // jQuery validate plugin
  // https://jqueryvalidation.org


  // GENERIC FUNCTIONS
  ////////////////////

  var validateErrorPlacement = function(error, element) {
    error.addClass('ui-group__validation');
    error.appendTo(element.parent("div"));
  }
  var validateHighlight = function(element) {
    $(element).parent('div').addClass("has-error");

  }
  var validateUnhighlight = function(element) {
    $(element).parent('div').removeClass("has-error");

  }
  var validateSubmitHandler = function(form) {
  
	$(form).submit();
  
	/*
    $(form).addClass('loading');
    $.ajax({
      type: "POST",
      url: $(form).attr('action'),
      data: $(form).serialize(),
      success: function(response) {
        $(form).removeClass('loading');
		$(form).submit();
		
        var data = $.parseJSON(response);
        if (data.status == 'success') {
          // do something I can't test
        } else {
            $(form).find('[data-error]').html(data.message).show();
        }
		
      }
    });
	*/
  }

  var validatePhone = {
    required: true,
    normalizer: function(value) {
        var PHONE_MASK = '+X (XXX) XXX-XXXX';
        if (!value || value === PHONE_MASK) {
            return value;
        } else {
            return value.replace(/[^\d]/g, '');
        }
    },
    minlength: 11,
    digits: true
  }

  ////////
  // FORMS


  /////////////////////
  // REGISTRATION FORM
  ////////////////////
  $(".js-registration-form").validate({
    errorPlacement: validateErrorPlacement,
    highlight: validateHighlight,
    unhighlight: validateUnhighlight,
    submitHandler: validateSubmitHandler,
    rules: {
      NAME: "required",
      LAST_NAME: "required",
	  captcha_word: "required",
	  CONFIRM_PASSWORD: "required",
      EMAIL: {
        required: true,
        email: true
      },
      PASSWORD: {
        required: true,
        minlength: 6,
      },
      PERSONAL_PHONE: validatePhone
    },
    messages: {
      NAME: "Заполните это поле",
      LAST_NAME: "Заполните это поле",
	  captcha_word: "Заполните это поле",
	  CONFIRM_PASSWORD: "Заполните это поле",
      EMAIL: {
          required: "Заполните это поле",
          email: "Email содержит неправильный формат"
      },
      PASSWORD: {
          required: "Заполните это поле",
          email: "Пароль мимимум 6 символов"
      },
      PERSONAL_PHONE: {
          required: "Заполните это поле",
          minlength: "Введите корректный телефон"
      }
    },
	success: function(error){
        $(".js-registration-form .demon").each(function() { 
			$('[name="REGISTER['+$(this).attr('name')+']"]').val( $(this).val() );
		}); 
		$('[name="REGISTER[LOGIN]"]').val($('[name="REGISTER[EMAIL]"]').val() );
    },
  });



  $("[js-validate-form]").validate({
    errorPlacement: validateErrorPlacement,
    highlight: validateHighlight,
    unhighlight: validateUnhighlight,
    submitHandler: validateSubmitHandler,
    rules: {
      ORDER_PROP_1: "required",
      ORDER_PROP_3: "required",
      ORDER_PROP_2: {
        required: true,
        email: true
      },
      password: {
        required: true,
        minlength: 6,
      },
      password_confirm: {
        required: true,
        minlength: 6,
        equalTo: "#password"
      },

      phone: validatePhone
    },
    messages: {
      ORDER_PROP_1: "Заполните это поле",
      ORDER_PROP_3: "Заполните это поле",
      org: "Заполните это поле",
      ORDER_PROP_2: {
          required: "Заполните это поле",
          email: "Email содержит неправильный формат"
      },
      password: {
          required: "Заполните это поле",
          minlength: "Миниальное количество символов 6"
      },
      password_confirm: {
          required: "Заполните это поле",
          minlength: "Миниальное количество символов 6",
          equalTo: "Пароли не совпадают"
      },
      phone: {
          required: "Заполните это поле",
          minlength: "Введите корректный телефон"
      }
    }
  });


  $("[js-validate-contact]").validate({
    errorPlacement: validateErrorPlacement,
    highlight: validateHighlight,
    unhighlight: validateUnhighlight,
    submitHandler: validateSubmitHandler,
    rules: {
      name: "required",
      email: {
        required: true,
        email: true
      },
      message: {
        required: true,
        minlength: 10
      }
    },
    messages: {
      name: "Заполните это поле",
      email: {
          required: "Заполните это поле",
          email: "Email содержит неправильный формат"
      },
      message: {
          required: "Заполните это поле",
          minlength: "Сообщение слишком короткое"
      }
    }
  });

});
