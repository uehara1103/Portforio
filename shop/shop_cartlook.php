<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['member_login']) === false) {
	echo "<html>
			<head>
			<title>Perlebon kids &ndash; ショッピングカート</title>
			</head>
			</html>";
	echo 'ようこそゲスト様　';
	echo '<a href="member_login.html">会員ログイン</a><br />';
	echo '<br />';
} else {
	echo "<html>
			<head>
			<title>Perlebon kids &ndash; ショッピングカート</title>
			</head>
			</html>";
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

	if (isset($_SESSION['cart']) === true) {

		$cart = $_SESSION['cart'];
		$kazu = $_SESSION['kazu'];
		$max = count($cart);
	} else {
		$max = 0;
	}

	if ($max === 0) {
		echo 'カートに商品が入っていません。<br />';
		echo '<br />';
		echo '<a href="shop_list.php">商品一覧へ戻る</a>';
		echo '<br />';
		echo '<a href="../toppage/index.html">TOPぺージへ戻る</a>';
		echo readfile(dirname(__DIR__) . "/templates/footer_cart.html.twig");
		exit();
	}

	$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
	$user = 'root';
	$password = '';
	$dbh = new PDO($dsn, $user, $password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	foreach ($cart as $key => $val) {
		$sql = 'SELECT code,name,price,gazou FROM mst_product WHERE code=?';
		$stmt = $dbh->prepare($sql);
		$data[0] = $val;
		$stmt->execute($data);

		$res = $stmt->fetch(PDO::FETCH_ASSOC);

		$pro_name[] = $res['name'];
		$pro_price[] = $res['price'];
		if ($res['gazou'] === '') {
			$pro_gazou[] = '';
		} else {
			$pro_gazou[] = '<img src="../product/images/' . $res['gazou'] . '">';
		}
	}
	$dbh = null;
} catch (Exception $e) {
	echo 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

<html>

<head>
	<meta charset="UTF-8">
	<title>Perlebon kids &ndash; ショッピングカート</title>
</head>

<body>
	<br />
	<br />
	<form method="post" action="kazu_change.php">
		<table border="1">
			<tr>
				<td>商品</td>
				<td>商品画像</td>
				<td>価格</td>
				<td>数量</td>
				<td>小計</td>
				<td>削除</td>
			</tr>
			<?php for ($i = 0; $i < $max; $i++) { ?>
				<tr>
					<td><?php echo $pro_name[$i]; ?></td>
					<td><?php echo $pro_gazou[$i]; ?></td>
					<td><?php echo number_format($pro_price[$i]); ?>円</td>
					<td><input type="text" name="kazu<?php echo $i; ?>" value="<?php echo $kazu[$i]; ?>"></td>
					<td><?php echo number_format($pro_price[$i] * $kazu[$i]); ?>円</td>
					<td><input type="checkbox" name="sakujo<?php echo $i; ?>"></td>
				</tr>
			<?php
		}
		?>
		</table>
		<input type="hidden" name="max" value="<?php echo $max; ?>">
		<input type="submit" value="数量変更"><br />
		<input type="button" onclick="history.back()" value="戻る">
	</form>
	<br />
	<a href="shop_form.php">ご購入手続きへ進む</a><br />

	<?php
	if (isset($_SESSION["member_login"]) === true) {
		echo '<a href="shop_kantan_check.php">会員かんたん注文へ進む</a><br /><br/>';
	}
	?>

	<a href="http://localhost/exam4/toppage/index.html">TOPぺージへ戻る</a><br /><br />

	<?php readfile(dirname(__DIR__) . "/templates/footer_cart.html.twig"); ?>
</body>

</html>