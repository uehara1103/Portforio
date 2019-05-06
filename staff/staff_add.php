<!-- *アクセスURL：http://localhost/exam4/staff/staff_add.php -->

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
<title>スタッフ追加</title>
<body>
スタッフ追加<br/><br/>
<form method="post" action="staff_add_check.php">
スタッフ名を入力してください。<br/>
<input type="text" name="name" style="width:200px"><br/>
パスワードを入力してください。<br/>
<input type="password" name="pass" style="width:100px"><br/>
パスワードをもう一度入力してください。<br/>
<input type="password" name="pass2" style="width:100px"><br/>
<br/>
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>
</body>
</html>