<!-- *アクセスURL：http://localhost/exam4/product/pro_list.php -->
<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['login']) === false) {
    echo 'ログインされていません。<br/>';
    echo '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
    exit();
} else {
    echo $_SESSION['staff_name'];
    echo 'さんログイン中<br/><br/>';
}

try {
    $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';

    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT code,name,price FROM mst_product WHERE 1';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $dbh = null;



    //twigで書くこと
    echo '商品一覧<br/><br/>';
    echo '<form method="post" action="pro_branch.php">';
    while (true) {
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($res == false) {
            break;
        }
        echo '<input type="radio" name="procode" value="' . $res['code'] . '">';
        echo $res['name'] . '---';
        echo number_format($res['price']) . '円<br/>';
    }
    echo '<input type="submit" name="disp" value="参照">';
    echo '<input type="submit" name="add" value="追加">';
    echo '<input type="submit" name="edit" value="修正">';
    echo '<input type="submit" name="delete" value="削除">' . '</form>';
} catch (Exception $e) {
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
    <br />
    <a href="../staff_login/staff_top.php">トップメニューへ<a>
            <br />
</body>

</html>