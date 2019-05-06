<?php
session_start();
$_SESSION = array();
if (isset($_COOKIE[session_name()]) === true) {
	setcookie(session_name(), '', time() - 42000, '/');
}
session_destroy();

require('C://xampp/htdocs/exam4/register/Bootstrap.class.php');
use register\Bootstrap;

$loader = new \Twig_Loader_Filesystem(Bootstrap::TEMPLATE_DIR);
$twig = new \Twig_Environment($loader, [
	// 'cache' => Bootstrap::CACHE_DIR
	'cache' => false
]);
$context['title'] = 'ログアウト完了';
$template = $twig->loadTemplate('header_cart.html.twig');
$template->display($context);
?>

<!-- Twigで書くこと -->
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Perlebon kids &ndash; ログアウト完了</title>
</head>

<body>

	ログアウトしました。<br />
	<br />
	<a href="shop_list.php">商品一覧へ</a>
	<br/>
	

</body>

</html>