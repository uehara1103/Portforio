<!-- *アクセスURL：http://localhost/exam4/product/pro_add_check.php -->
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

$pro_name = $_POST['name'];
$pro_price = $_POST['price'];
$pro_gazou = $_FILES['gazou'];


//クロスサイトスクリプティング（XSS)防止のため、エスケープ処理
$pro_name = htmlspecialchars($pro_name,ENT_QUOTES,'UTF-8');
$pro_price = htmlspecialchars($pro_price,ENT_QUOTES,'UTF-8');

//以下twigで別ファイル作成すること
if($pro_name == ''){
    echo '商品名が入力されていません。<br/>';
} else {
    echo '商品名：' . $pro_name . '<br/>';
}

if(preg_match('/\A[0-9]+\z/',$pro_price) === 0){
    echo '価格を半角数字で入力してください。<br/>';
} else {
    echo '価格：' . $pro_price . '円<br/><br/>';
}

// 掲示板用
// if (isset($_POST['send']) === true) {

//     $pro_gazou = $_FILES['gazou'];

// if($pro_gazou['error'] === 0 && $pro_gazou['size'] !== 0) {
//         // 正しくサーバーにアップされているかどうか
//         if (is_uploaded_file($pro_gazou['tmp_name']) === true) {
//             // 画像情報を取得する
//             $image_info = getimagesize($pro_gazou['tmp_name']);
//             // var_dump($image_info);
//             // array(7) { [0]=> int(201) [1]=> int(251) [2]=> int(2) [3]=> string(24) "width="201" height="251"" ["bits"]=> int(8) ["channels"]=> int(3) ["mime"]=> string(10) "image/jpeg" } 
//             $image_mime = $image_info['mime'];
//             // var_dump($image_mime);

//             // 画像サイズが利用できるサイズ以内かどうか
//             if ($pro_gazou['size'] > 1048576) {
//                 echo 'アップロードできる画像のサイズは、1MBまでです';
//                 // 画像の形式が利用できるタイプかどうか
//             } elseif (preg_match('/^image\/jpeg$/', $image_mime) === 0) {
//                 echo 'アップロードできる画像の形式は、JPEG形式だけです';
//                 // time：現在時刻をUnixエポック(1970年1月1日00:00:00GMT）からの通算秒として返す(Unixタイムスタンプ）
//             } elseif (move_uploaded_file($pro_gazou['tmp_name'], './images' .  time() .'.jpg','./imagedir') === true) {
//                 // echo '画像のアップロードが完了しました';
//                 echo '<img src="./images/'.$pro_gazou['name'].'">';
//                 echo '<br/><br/>';
//             }
//         }
//     }
// }

if($pro_gazou['size'] > 1048576) {
    echo 'アップロードできる画像のサイズは、1MBまでです';
} else {
    move_uploaded_file($pro_gazou['tmp_name'],'./images/'.$pro_gazou['name']);
    echo '<img src="./images/'.$pro_gazou['name'].'">';
    echo '<br/>';
}


if($pro_name == '' || preg_match('/\A[0-9]+\z/',$pro_price) === 0){
    echo '<form>' . '<input type="button" onclick="history.back()" value="戻る">' . '</form>';
} else {
    echo '上記の商品を追加します。<br/>';
    echo '<form method="post" action="pro_add_done.php">';
    echo '<input type="hidden" name="name" value="'.$pro_name.'">';
    echo '<input type="hidden" name="price" value="'.$pro_price.'">';
    echo '<input type="hidden" name="gazou_name" value="'.$pro_gazou['name'].'">' . '<br/>';
    echo '<input type="button" onclick="history.back()" value="戻る">';
    echo '<input type="submit" value="OK">' . '</form>';
}
?>
