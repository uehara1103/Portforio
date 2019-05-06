<!-- *アクセスURL：http://localhost/exam4
/product/pro_add_done.php -->
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

//スクリプト実行脆弱性とjs実行の対策を追加すること
try {
    require_once('../common/common.php');

//クロスサイトスクリプティング（XSS)防止のため、エスケープ処理
    $post = sanitize($_POST);
    $pro_name = $post['name'];
    $pro_price = $post['price'];
    $pro_gazou_name = $_POST['gazou_name'];

    $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';

    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // var_dump($dbh);
    $sql = 'INSERT INTO mst_product(name,price,gazou) VALUES (?,?,?)';
    $stmt = $dbh->prepare($sql);
    $data[] = $pro_name;
    $data[] = $pro_price;
    $data[] = $pro_gazou_name;
    $stmt->execute($data);

    $dbh = null;

    echo $pro_name . 'を追加しました。<br/>';

}
catch (Exception $e){
    // echo $e->getMessage();
    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}
?>
<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<a href="pro_list.php">戻る<a>
</body>
</html>
