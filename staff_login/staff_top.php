<!-- *アクセスURL：http://localhost/exam4/staff_login/staff_top.php -->
<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login']) === false) {
    echo 'ログインされていません。<br/>';
    echo '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
    exit();
} else {
    echo $_SESSION['staff_name'];
    echo 'さんログイン中<br/><br/>';
}
?>

<html>
<head>
<meta charset="UTF-8">
</head>
<body>
ショップ管理メニュー<br/><br/>
<a href="../staff/staff_list.php">スタッフ管理</a><br/><br/>
<a href="../product/pro_list.php">商品管理</a><br/><br/>
<a href="../shop/shop_list.php">顧客用商品一覧</a><br/><br/>
<a href="../staff_login/staff_logout.php">ログアウト</a><br/><br/>
</body>
</html>
