<!-- *アクセスURL：http://localhost/exam4/staff/staff_delete_done.php -->
<?php

// CSRF（クロスサイト・リクエスト・フォージェリ）脆弱性対策が必要
// 参考：https://www.ipa.go.jp/security/vuln/websecurity.html
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
    $staff_code = $_POST['code'];

    $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';

    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // var_dump($dbh);
    $sql = 'DELETE FROM mst_staff WHERE code=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $staff_code;
    $stmt->execute($data);

    $dbh = null;
}
catch (Exception $e){
    // echo $e->getMessage();
    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}
?>
<!-- twigで作成 -->
<html>
<head>
<meta charset="UTF-8">
</head>
<body>
削除しました<br/><br/>
<a href="staff_list.php">戻る<a>
</body>
</html>
