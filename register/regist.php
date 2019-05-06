<?php
/*
 * ファイルパス : C:￥xampp￥htdocs￥register￥regist.php
 *ファイル名 : regist.php
 *アクセスURL：http://localhost/exam4/register/regist.php
 */
// namespace register;

// session_start();
// session_regenerate_id(true);


// require_once dirname (__FILE__) . '/Bootstrap.class.php';

// use register\master\initMaster;
// use register\Bootstrap;

// // テンプレート指定
// $loader = new \Twig_Loader_Filesystem(Bootstrap::TEMPLATE_DIR);
// $twig = new \Twig_Environment($loader, [
//     // 'cache' => Bootstrap::CACHE_DIR
//     'cache' => false
// ]);

// // 初期データを設定
// $dataArr = [
//     'family_name' => '',
//     'first_name' => '',
//     'family_name_kana' => '',
//     'first_name_kana' => '',
//     'sex' => '',
//     'year' => '',
//     'month' => '',
//     'day' => '',
//     'zip1' => '',
//     'zip2' => '',
//     'address' => '',
//     'email' => '',
//     'tel1' => '',
//     'tel2' => '',
//     'tel3' => '',
//     'contents' => ''
// ];

// // エラーメッセージの定義、初期
// $errArr = [];
// foreach ($dataArr as $key => $value) {
//     $errArr[$key] = '';
// }

// // array($yearArr,$monthArr,$dayArr)
// // 静的クラス

// list($yearArr,$monthArr,$dayArr) = initMaster::getDate();
// // list:右辺の配列要素を、左辺の変数に代入することができる
// $sexArr = initMaster::getSex();

// $context = [];
// $context['yearArr'] = $yearArr ;
// $context['monthArr'] = $monthArr ;
// $context['dayArr'] = $dayArr ;
// $context['sexArr'] = $sexArr ;
// $context['dataArr'] = $dataArr ;
// $context['errArr'] = $errArr ;

// $template = $twig->loadTemplate('register.html.twig');
// $template->display($context);


