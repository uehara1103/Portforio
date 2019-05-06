<!-- *アクセスURL：http://localhost/exam4/staff/pro_edit_check.php -->

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

require_once('../common/common.php');

//クロスサイトスクリプティング（XSS)防止のため、エスケープ処理
$post = sanitize($_POST);
$pro_code = $post['code'];
$pro_name = $post['name'];
$pro_price = $post['price'];
$pro_gazou_name_old = $_POST['gazou_name_old'];
$pro_gazou = $_FILES['gazou'];

//以下twigで別ファイル作成すること
if ($pro_name == '') {
    echo '商品名が入力されていません。<br/>';
} else {
    echo '商品名：' . $pro_name . '<br/>';
}

if (preg_match('/\A[0-9]+\z/', $pro_price) === 0) {
    echo '価格を半角数字で入力してください。<br/>';
} else {
    echo '価格：' . number_format($pro_price) . '円<br/>';
}

if ($pro_gazou['size'] > 1048576) {
    echo 'アップロードできる画像のサイズは、1MBまでです';
} else {
    move_uploaded_file($pro_gazou['tmp_name'], './images/' . $pro_gazou['name']);
    echo '<img src="./images/' . $pro_gazou['name'] . '">';
    echo '<br/>';
}

if ($pro_name == '' || preg_match('/\A[0-9]+\z/', $pro_price) === 0 || $pro_gazou['size'] > 1048576) {
    echo '<form>' . '<input type="button" onclick="history.back()" value="戻る">' . '</form>';
} else {
    echo '上記のように変更します。<br/>';
    echo '<form method="post" action="pro_edit_done.php">';
    echo '<input type="hidden" name="code" value="' . $pro_code . '">';
    echo '<input type="hidden" name="name" value="' . $pro_name . '">';
    echo '<input type="hidden" name="price" value="' . $pro_price . '">';
    echo '<input type="hidden" name="gazou_name_old" value="' . $pro_gazou_name_old . '">';
    echo '<input type="hidden" name="gazou_name" value="' . $pro_gazou['name'] . '">' . '<br/>';
    echo '<input type="button" onclick="history.back()" value="戻る">';
    echo '<input type="submit" value="OK">' . '</form>';
}
?>