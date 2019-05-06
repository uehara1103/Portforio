<!-- *アクセスURL：http://localhost/exam4/staff/staff_add_done.php -->

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

    require_once('../common/common.php');

//クロスサイトスクリプティング（XSS)防止のため、エスケープ処理
    $post = sanitize($_POST);
    $staff_name=$post['name'];
    $staff_pass=$post['pass'];

    $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';

    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // var_dump($dbh);
    $sql = 'INSERT INTO mst_staff(name,password) VALUES (?,?)';
    $stmt = $dbh->prepare($sql);
    $data[] = $staff_name;
    $data[] = $staff_pass;
    $stmt->execute($data);

    $dbh = null;

    echo $staff_name . 'さんを追加しました。<br/>';

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
<a href="staff_list.php">戻る<a>
</body>
</html>
