<?
$aMenuLinks = Array(
	Array(
		"Вход", 
		"/personal/auth/", 
		Array(), 
		Array(), 
		"!\$USER->IsAuthorized()" 
	),
	Array(
		"Регистрация", 
		"/personal/register/", 
		Array(), 
		Array(), 
		"!\$USER->IsAuthorized()" 
	),
	Array(
		"Восстановление пароля", 
		"/personal/?forgot_password=yes", 
		Array(), 
		Array(), 
		"!\$USER->IsAuthorized()" 
	),
	Array(
		"Мои заказы", 
		"/personal/", 
		Array(), 
		Array(), 
		"\$USER->IsAuthorized()" 
	),
	Array(
		"Моя корзина", 
		"/personal/cart/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Избранное", 
		"/personal/wishlist/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Мои данные", 
		"/personal/edit/", 
		Array(), 
		Array(), 
		"\$USER->IsAuthorized()" 
	)
);
?>