<?php
/*
 * ファイルパス : C:￥xampp￥htdocs￥register￥postcode_search.php
 *ファイル名 : postcode_search.php
 http://localhost/exam4/register/postcode_search.php
 */
// namespace register;

// require_once dirname (__FILE__) . '/Bootstrap.class.php';

// use register\lib\Database;
// use register\Bootstrap;

// $db = new Database(Bootstrap::DB_HOST, Bootstrap::DB_USER, Bootstrap::DB_PASS, Bootstrap::DB_NAME);

// if (isset($_GET['zip1']) === true && isset ($_GET['zip2']) === true) {
//     $zip1 = $_GET['zip1'];
//     $zip2 = $_GET['zip2'];

// $query = "SELECT"
//        . "     pref, "
//        . "     city, "
//        . "     town  "
//        . " FROM "
//        . "     postcode "
//        . " WHERE "
//        . "     zip =  " . $db->str_quote($zip1 . $zip2)
//        . " LIMIT 1 ";

//     $res = $db->select($query);
//     // 出力結果がajaxに渡される
//     echo ($res !== "" && count($res) !== 0) ? $res[0]['pref'] . $res[0]['city'] . $res[0]['town'] : '';
// } else {
//     echo "no";
// }
