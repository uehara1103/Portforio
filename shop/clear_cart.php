<!-- *アクセスURL：http://localhost/exam4/shop/clear_cart.php -->
<?php
session_start();
$_SESSION = array();
if (isset($_COOKIE[session_name()]) === true) {
    setcookie(session_name(), '', time() - 42000, '/');
}
session_destroy();
?>

<html>

<head>
    <meta charset="UTF-8">
    <title>Perlebon kids &ndash; カートクリア</title>
</head>

<body>
    カートを空にしました。<br />
    <a href="shop_list.php">戻る</a>
</body>

</html>