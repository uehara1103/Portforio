<?php
	require('C://xampp/htdocs/exam4/register/Bootstrap.class.php');
	use register\Bootstrap;

	$loader = new \Twig_Loader_Filesystem(Bootstrap::TEMPLATE_DIR);
	$twig = new \Twig_Environment($loader, [
		// 'cache' => Bootstrap::CACHE_DIR
		'cache' => false
	]);
	$context['title'] = 'ログインエラー	';
	$template = $twig->loadTemplate('header_cart.html.twig');
	$template->display($context);

try {

	require_once('../common/common.php');

	$post = sanitize($_POST);
	$member_email = $post['email'];
	$member_pass = $post['pass'];

	$member_pass = $member_pass;

	$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
	$user = 'root';
	$password = '';
	$dbh = new PDO($dsn, $user, $password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = 'SELECT code,name FROM dat_member WHERE email=? AND password=?';
	$stmt = $dbh->prepare($sql);
	$data[] = $member_email;
	$data[] = $member_pass;
	$stmt->execute($data);

	$dbh = null;

	$res = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($res === false) {
		echo 'メールアドレスかパスワードが間違っています。<br /><br/>	';
		echo '<a href="member_login.html"> 戻る</a>';
	} else {
		session_start();
		$_SESSION['member_login'] = 1;
		$_SESSION['member_code'] = $res['code'];
		$_SESSION['member_name'] = $res['name'];
		header('Location:shop_list.php');
		exit();
	}
} catch (Exception $e) {
	echo 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}
?>

<html>

<head>
	<meta charset="UTF-8">
	<title>Perlebon kids &ndash; ログインエラー</title>
</head>

<body>
</body>

</html>