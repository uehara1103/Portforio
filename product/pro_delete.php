<!-- *アクセスURL：http://localhost/exam4/product/pro_delete.php -->
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

try {
    $pro_code=$_GET['procode'];

    $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';

    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // var_dump($dbh);
    $sql = 'SELECT name,gazou FROM mst_product WHERE code=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $pro_code;
    $stmt->execute($data);

    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    $pro_name = $res['name'];
    $pro_gazou_name = $res['gazou'];

    $dbh = null;

       if($pro_gazou_name === '') {
            $disp_gazou = '';
        } else {
        $disp_gazou = '<img src="./images/'.$pro_gazou_name.'">';
    }
}
catch (Exception $e){
    // echo $e->getMessage();
    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}
?>
<!-- twigで書くこと -->
<html>
<head>
<meta charset="UTF-8">
</head>
<body>
商品削除<br/><br/>
商品コード<br/>
<?php echo $pro_code; ?>
<br/>
商品名<br/>
<?php echo $pro_name; ?>
<br/>
<?php echo $disp_gazou; ?>
<br/>
この商品を削除してもよろしいですか？<br/>
<br/>
<form method="post" action="pro_delete_done.php">
<input type="hidden" name="code" value="<?php echo $pro_code; ?>">
<input type="hidden" name="gazou_name" value="<?php echo $pro_gazou_name; ?>">
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>
</body>
</html>