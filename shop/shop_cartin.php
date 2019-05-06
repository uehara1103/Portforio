<!-- *アクセスURL：http://localhost/exam4/shop/shop_cartin.php -->
<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['member_login']) === false) {
	echo 'ようこそゲスト様　';
	echo '<a href="member_login.html">会員ログイン</a><br />';
	echo '<br />';
} else {
	echo 'ようこそ';
	echo $_SESSION['member_name'];
	echo '様　';
	echo '<a href="member_logout.php">ログアウト</a><br />';
	echo '<br />';
}

require('C://xampp/htdocs/exam4/register/Bootstrap.class.php');
use register\Bootstrap;

$loader = new \Twig_Loader_Filesystem(Bootstrap::TEMPLATE_DIR);
$twig = new \Twig_Environment($loader, [
	// 'cache' => Bootstrap::CACHE_DIR
	'cache' => false
]);
$context['title'] = 'ショッピングカート';
$template = $twig->loadTemplate('header_cart.html.twig');
$template->display($context);

try {

	$pro_code = $_GET['procode'];

	if (isset($_SESSION['cart']) === true) {

		$cart = $_SESSION['cart'];
		$kazu = $_SESSION['kazu'];

		if (in_array($pro_code, $cart) === true) {
			echo '<br/><br/>';
			echo 'その商品はすでにカートに入っています。<br /><br/><br/>';
			echo '<a href="shop_list.php">商品一覧に戻る</a>';
			echo '<br/><br/><br/>';
			readfile(dirname(__DIR__) . "/templates/footer.html.twig");
			exit();
		}
	}
	$cart[] = $pro_code;
	$kazu[] = 1;
	$_SESSION['cart'] = $cart;
	$_SESSION['kazu'] = $kazu;
} catch (Exception $e) {
	echo 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>
<!-- Twigで書くこと -->
<html>

<head></head>

<body>
	カートに追加しました。<br />
	<br />
	<a href="shop_list.php">商品一覧に戻る</a>
	<br />
	<br />
	<?php readfile(dirname(__DIR__) . "/templates/footer_cart.html.twig"); ?>
</body>

</html>