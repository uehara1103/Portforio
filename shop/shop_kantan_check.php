<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['member_login']) === false) {

	echo 'ログインされていません。<br />';
	echo '<a href="shop_list.php">商品一覧へ</a>';
	exit();
}

require('C://xampp/htdocs/exam4/register/Bootstrap.class.php');
use register\Bootstrap;

$loader = new \Twig_Loader_Filesystem(Bootstrap::TEMPLATE_DIR);
$twig = new \Twig_Environment($loader, [
	// 'cache' => Bootstrap::CACHE_DIR
	'cache' => false
]);


$code = $_SESSION['member_code'];

$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT name,email,postal1,postal2,address,tel FROM dat_member WHERE code=?';
$stmt = $dbh->prepare($sql);
$data[] = $code;
$stmt->execute($data);
$res = $stmt->fetch(PDO::FETCH_ASSOC);

$dbh = null;

$onamae = $res['name'];
$email = $res['email'];
$postal1 = $res['postal1'];
$postal2 = $res['postal2'];
$address = $res['address'];
$tel = $res['tel'];


$context['title'] = '簡単購入確認画面';
$context['onamae'] = $onamae;
$context['email'] = $email;
$context['postal1'] = $postal1;
$context['postal2'] = $postal2;
$context['address'] = $address;
$context['tel'] = $tel;

$template = $twig->loadTemplate('shop_kantan_check.html.twig');
$template->display($context);

// echo '<br/>';
// echo 'お名前<br />';
// echo $onamae;
// echo '<br /><br />';

// echo 'メールアドレス<br />';
// echo $email;
// echo '<br /><br />';

// echo '郵便番号<br />';
// echo $postal1;
// echo '-';
// echo $postal2;
// echo '<br /><br />';

// echo '住所<br />';
// echo $address;
// echo '<br /><br />';

// echo '電話番号<br />';
// echo $tel;
// echo '<br /><br />';

// echo '<form method="post" action="shop_kantan_done.php">';
// echo '<input type="hidden" name="onamae" value="' . $onamae . '">';
// echo '<input type="hidden" name="email" value="' . $email . '">';
// echo '<input type="hidden" name="postal1" value="' . $postal1 . '">';
// echo '<input type="hidden" name="postal2" value="' . $postal2 . '">';
// echo '<input type="hidden" name="address" value="' . $address . '">';
// echo '<input type="hidden" name="tel" value="' . $tel . '">';
// echo '<input type="button" onclick="history.back()" value="戻る">';
// echo '<input type="submit" value="ＯＫ"><br />';
// echo '</form>';

// readfile(dirname(__DIR__) . "../../templates/exam4/footer_cart.html.twig");
