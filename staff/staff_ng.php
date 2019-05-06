<!-- *アクセスURL：http://localhost/exam4/staff/staff_ng.php -->
<!-- twigで作成すること -->
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
スタッフが選択されていません。<br/>
<a href="staff_list.php">戻る<a>
</body>
</html>
