<?php
/*
 * ファイルパス : C:￥xampp￥htdocs￥register￥list.php
 *ファイル名 : list.php
 *アクセスURL：http://localhost/exam4/register/list.php
 */
// namespace register;

// require_once dirname (__FILE__) . '/Bootstrap.class.php';

// use register\Bootstrap;
// use register\master\initMaster;
// use register\lib\Database;
// use register\lib\Common;

// // テンプレート指定
// $loader = new \Twig_Loader_Filesystem(Bootstrap::TEMPLATE_DIR);
// $twig = new \Twig_Environment($loader, [
//     // 'cache' => Bootstrap::CACHE_DIR
//     'cache' => false
// ]);

// $db = new Database(Bootstrap::DB_HOST, Bootstrap::DB_USER, Bootstrap::DB_PASS, Bootstrap::DB_NAME);

// $query = " SELECT "
//        . "     mem_id, "
//        . "     family_name, "
//        . "     first_name, "
//        . "     family_name_kana, "
//        . "     first_name_kana, "
//        . "     sex, "
//        . "     email, "
//        . "     traffic, "
//        . "     regist_date "
//        . " FROM "
//        . "     member ";

//     //    var_dump ($query);

// $dataArr = $db->select($query);
// $db->close();

// $context = [];
// $context['dataArr'] = $dataArr;

// $template = $twig->loadTemplate('list.html.twig');
// $template->display($context);
