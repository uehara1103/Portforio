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
$email = (isset($post['email']) === true && preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/',
    $post['email']) === 1) ? $post['email'] : '';
$postal1 = (isset($post['postal1']) === true && preg_match( '/\A[0-9]+\z/',
    $post['postal1']) === 1) ? $post['postal1'] : '';
$postal2 = (isset($post['postal2']) === true && preg_match( '/\A[0-9]+\z/',
    $post['postal2']) === 1) ? $post['postal2'] : '';
$address = $post['address'];
$tel = (isset($post['tel']) === true && preg_match('/\A\d{2,5}-?\d{2,5}-?\d{4,5}\z/',
    $post['tel']) === 1) ? $post['tel'] : ''; 
$pass = $post['pass'];
$pass2 = $post['pass2'];
$danjo = $post['danjo'];
$birth = $post['birth'];

$okflg = true;

$context['title'] = '会員登録';

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
$context['okflg'] = $okflg;

$template = $twig->loadTemplate('member_register_check.html.twig');
$template->display($context);
?>
