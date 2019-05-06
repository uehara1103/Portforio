<?php
require_once('../common/common.php');

require('C://xampp/htdocs/exam4/register/Bootstrap.class.php');
use register\Bootstrap;

$loader = new \Twig_Loader_Filesystem(Bootstrap::TEMPLATE_DIR);
$twig = new \Twig_Environment($loader, [
    // 'cache' => Bootstrap::CACHE_DIR
    'cache' => false
]);

$post = sanitize($_POST);

$onamae = $post['onamae'];
$email = (isset($post['email']) === true && preg_match(
    '/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/',
    $post['email']
) === 1) ? $post['email'] : '';
$postal1 = (isset($post['postal1']) === true && preg_match(
    '/\A[0-9]+\z/',
    $post['postal1']
) === 1) ? $post['postal1'] : '';
$postal2 = (isset($post['postal2']) === true && preg_match(
    '/\A[0-9]+\z/',
    $post['postal2']
) === 1) ? $post['postal2'] : '';
$address = $post['address'];
$tel = (isset($post['tel']) === true && preg_match(
    '/\A\d{2,5}-?\d{2,5}-?\d{4,5}\z/',
    $post['tel']
) === 1) ? $post['tel'] : '';
$pass = $post['pass'];
$pass2 = $post['pass2'];
$danjo = $post['danjo'];
$birth = $post['birth'];
$chumon = $post['chumon'];  

$okflg = true;


$context['title'] = 'ご購入時会員登録確認';

$context['onamae'] = $onamae;
$context['email'] = $email;
$context['postal1'] = $postal1;
$context['postal2'] = $postal2;
$context['address'] = $address;
$context['tel'] = $tel;
$context['pass'] = $pass;
$context['pass2'] = $pass2;
$context['danjo'] = $danjo;
$context['birth'] = $birth;
$context['chumon'] = $chumon;
$context['okflg'] = $okflg;


$template = $twig->loadTemplate('shop_form_check.html.twig');
$template->display($context);

// $post = sanitize($_POST);

// $onamae = $post['onamae'];
// $email = $post['email'];
// $postal1 = $post['postal1'];
// $postal2 = $post['postal2'];
// $address = $post['address'];
// $tel = $post['tel'];
// $chumon= $post['chumon'];
// $pass = $post['pass'];
// $pass2 = $post['pass2'];
// $danjo = $post['danjo'];
// $birth = $post['birth'];

// $okflg = true;

// if($onamae === '') {
//     echo 'お名前が入力されていません。<br/><br/>';
//     $okflg = false;
// } else {
//     echo 'お名前<br/>' . $onamae . '<br/><br/>';
// }

// if(preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/',$email) === 0) {
//     echo 'メールアドレスを正確に入力してください。<br/><br/>';
//     $okflg = false;
// } else {
//     echo 'メールアドレス<br/>' . $email . '<br/><br/>';

// }

// if(preg_match('/\A[0-9]+\z/',$postal1) === 0) {
//     echo '郵便番号は半角数字で入力してください。<br/><br/>';
//     $okflg = false;
// } else {
//     echo '郵便番号<br/>' . $postal1 . '-'  . $postal2 . '<br/><br/>';
// }

// if(preg_match('/\A[0-9]+\z/',$postal2) === 0) {
//     echo '郵便番号は半角数字で入力してください。<br/><br/>';
//     $okflg = false;
// }

// if($address === '') {
//     echo '住所が入力されていません。<br/><br/>';
//     $okflg = false;
// } else {
//     echo '住所<br/>' . $address . '<br/><br/>';

// }

// if(preg_match('/\A\d{2,5}-?\d{2,5}-?\d{4,5}\z/',$tel) === 0) {
//     echo '電話番号を正確に入力してください。<br/><br/>';
//     $okflg = false;
// } else {
//     echo '電話番号<br/>' . $tel . '<br/><br/>';
// }

// if($chumon === 'chumontouroku') {
// 	if($pass === '') {
// 		echo 'パスワードが入力されていません。<br /><br />';
// 		$okflg = false;
// 	}

// 	if($pass !== $pass2) {
// 		echo 'パスワードが一致しません。<br /><br />';
// 		$okflg = false;
// 	}

// 	echo '性別<br />';
// 	if($danjo === 'dan') {
// 		echo '男性';
// 	} else {
// 		echo '女性';
// 	}
// 	echo '<br /><br />';

// 	echo '生まれ年<br />';
// 	echo $birth;
// 	echo '年代';
// 	echo '<br /><br />';

// }


// if($okflg === true) {
//     echo '<form method="post" action="shop_form_done.php">';
//     echo '<input type="hidden" name="onamae" value="'.$onamae.'">';
//     echo '<input type="hidden" name="email" value="'.$email.'">';
//     echo '<input type="hidden" name="postal1" value="'.$postal1.'">';
//     echo '<input type="hidden" name="postal2" value="'.$postal2.'">';
//     echo '<input type="hidden" name="address" value="'.$address.'">';
//     echo '<input type="hidden" name="tel" value="'.$tel.'">';
//     echo '<input type="hidden" name="chumon" value="'.$chumon.'">';
// 	echo '<input type="hidden" name="pass" value="'.$pass.'">';
// 	echo '<input type="hidden" name="danjo" value="'.$danjo.'">';
// 	echo '<input type="hidden" name="birth" value="'.$birth.'">';
//     echo '<input type="button" onclick="history.back()" value="戻る">  ';
//     echo '<input type="submit" value="OK"><br/>';
// } else {
//     echo '<form>';
//     echo '<input type="button" onclick="history.back()" value="戻る">';
//     echo '</form>';
// }
