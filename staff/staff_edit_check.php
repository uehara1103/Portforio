<!-- *アクセスURL：http://localhost/exam4/staff/staff_edit_check.php -->
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

require_once('../common/common.php');

//クロスサイトスクリプティング（XSS)防止のため、エスケープ処理
$post = sanitize($_POST);
$staff_code = $post['code'];
$staff_name = $post['name'];
$staff_pass = $post['pass'];
$staff_pass2 = $post['pass2'];

//以下twigで別ファイル作成すること
if($staff_name == ''){
    echo 'スタッフ名が入力されていません。<br/>';
} else {
    echo 'スタッフ名：' . $staff_name . '<br/>';
}

if($staff_pass == ''){
    echo 'パスワードが入力されていません。<br/>';
}

if($staff_pass !== $staff_pass2){
    echo 'パスワードが一致しません。<br/>';
}

if($staff_name == '' || $staff_pass == '' || $staff_pass !== $staff_pass2){
    echo '<form>' . '<input type="button" onclick="history.back()" value="戻る">' . '</form>';
} else {
    //パスワードのハッシュ化
    // $staff_pass = password_hash($staff_pass, PASSWORD_DEFAULT);
//         $options = [
//     'cost' => 10,
// ];
//     $hash = password_hash($staff_pass, PASSWORD_DEFAULT,$options);
//     if (password_verify($staff_pass, $hash)) {
//     echo 'Password is valid!';
// } else {
//     echo 'Invalid password.';
// }
    // $staff_pass = md5($staff_pass);
    echo '<form method="post" action="staff_edit_done.php">';
    echo '<input type="hidden" name="code" value="'.$staff_code.'">';
    echo '<input type="hidden" name="name" value="'.$staff_name.'">';
    echo '<input type="hidden" name="pass" value="'.$staff_pass.'">' . '<br/>';
    echo '<input type="button" onclick="history.back()" value="戻る">';
    echo '<input type="submit" value="OK">' . '</form>';
}
?>
