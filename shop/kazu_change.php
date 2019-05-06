<!-- *アクセスURL：http://localhost/exam4/shop/kazu_change.php -->
<?php
session_start();
session_regenerate_id(true);

require_once('../common/common.php');

require('C://xampp/htdocs/exam4/register/Bootstrap.class.php');
use register\Bootstrap;

$loader = new \Twig_Loader_Filesystem(Bootstrap::TEMPLATE_DIR);
$twig = new \Twig_Environment($loader, [
	// 'cache' => Bootstrap::CACHE_DIR
	'cache' => false
]);
$context['title'] = '入力エラー';
$template = $twig->loadTemplate('kazu_change.html.twig');
$template->display($context);

$post = sanitize($_POST);

$max = $post['max'];
for ($i = 0; $i < $max; $i++) {
	if (preg_match("/\A[0-9]+\z/", $post['kazu' . $i]) === 0) {
		echo '<br/><br/><br/>';
		echo '数量に誤りがあります。';
		echo '<br/><br/><br/>';
		echo '<a href="shop_cartlook.php">カートに戻る</a>';
		readfile('../templates/footer_cart.html.twig');

		exit();
	}
	if ($post['kazu' . $i] < 1 || 10 < $post['kazu' . $i]) {
		echo '<br/><br/><br/>';
		echo '数量は必ず1個以上、10個までです。';
		echo '<br/><br/><br/>';
		echo '<a href="shop_cartlook.php">カートに戻る</a>';
		readfile('../templates/footer_cart.html.twig');

		exit();
	}
	$kazu[] = $post['kazu' . $i];
}

$cart = $_SESSION['cart'];

for ($i = $max; 0 <= $i; $i--) {
	if (isset($_POST['sakujo' . $i]) === true) {
		array_splice($cart, $i, 1);
		array_splice($kazu, $i, 1);
	}
}

$_SESSION['cart'] = $cart;
$_SESSION['kazu'] = $kazu;

header('Location:shop_cartlook.php');
?>