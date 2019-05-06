<!-- *アクセスURL：http://localhost/exam4/product/pro_edit.php -->
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
    $sql = 'SELECT name,price,gazou FROM mst_product WHERE code=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $pro_code;
    $stmt->execute($data);

    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    $pro_name = $res['name'];
    $pro_price = $res['price'];
    $pro_gazou_name_old = $res['gazou'];

    $dbh = null;

    if($pro_gazou_name_old === '') {
        $disp_gazou = '';
    } else {
        $disp_gazou = '<img src="./images/'.$pro_gazou_name_old.'">';
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
商品修正<br/><br/>
商品コード<br/>
<?php echo $pro_code; ?>
<br/><br/>
<form method="post" action="pro_edit_check.php" enctype="multipart/form-data">
<input type="hidden" name="code" value="<?php echo $pro_code; ?>">
<input type="hidden" name="gazou_name_old" value="<?php echo $pro_gazou_name_old; ?>">
商品名<br/>
<input type="text" name="name" style="width:200px" value="<?php echo $pro_name; ?>"><br/>
<br/>
価格<br/>
<input type="text" name="price" style="width:50px" value="<?php echo $pro_price; ?>"><br/>
<br/>
<?php echo $disp_gazou; ?>
<br/>
画像を選んでください<br/>
<input type="file" name="gazou" style="width:400px"><br/>
<br/>
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>
</body>
</html>
