<?php
/*
 * ファイルパス : C:￥xampp￥htdocs￥exam4￥register￥complete.php
 *ファイル名 : complete.php
 *アクセスURL：http://localhost/exam4/register/complete.php
 */
// namespace register;

// session_start();
// session_regenerate_id(true);

// require_once dirname (__FILE__) . '/Bootstrap.class.php';

// use register\Bootstrap;
// use register\lib\Database;


// // テンプレート指定
// $loader = new \Twig_Loader_Filesystem(Bootstrap::TEMPLATE_DIR);
// $twig = new \Twig_Environment($loader, [
//     // 'cache' => Bootstrap::CACHE_DIR
//     'cache' => false
// ]);

// $cart = $_SESSION['cart'];   
// $kazu = $_SESSION['kazu'];   
// // var_dump($kazu);    
// $max = count($cart);

// $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
//     $user = 'root';
//     $password = '';

//     $dbh = new \PDO($dsn, $user, $password);
//     $dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
// for($i = 0; $i < $max; $i++){
//     $sql = 'SELECT name,price FROM mst_product WHERE code=?';
//     $stmt = $dbh->prepare($sql);
//     $data[0] = $cart[$i];
//     $stmt->execute($data);
//     $res = $stmt->fetch(\PDO::FETCH_ASSOC);

//     $name = $res['name'];
//     $price = $res['price'];
//     $suuryo = $kazu[$i];
//     $shoukei = $price * $suuryo;
// }

// // $sql = " INSERT INTO member("
// //        . "     mem_id, "
// //        . "     family_name, "
// //        . "     first_name, "
// //        . "     family_name_kana, "
// //        . "     first_name_kana, "
// //        . "     sex, "
// //        . "     year, "
// //        . "     month, "
// //        . "     day, "
// //        . "     zip1, "
// //        . "     zip2, "
// //        . "     addres, "
// //        . "     email, "
// //        . "     tel1, "
// //        . "     tel2, "
// //        . "     tel3, "
// //        . "     regist_date "
// //        . " ) VALUES ( "
// //        . " =?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
       
// //     // $data = array();
// //     // $data[] = 0;
// //     unset($_POST['complete']);
// //     $data[] = $_POST;
// // var_dump($data);
// // $stmt = $dbh->prepare($sql);
// // $stmt->execute($data);

// // $sql = 'SELECT LAST_INSERT_ID()';
// // $stmt = $dbh->prepare($sql);
// // $res = $stmt->fetch(\PDO::FETCH_ASSOC);
// // $lastcode = $res['LAST_INSERT_ID()'];

// // for($i = 0; $i > $max; $i++) {
// //     $sql = 'INSERT INTO dat_sales_product (code_sales,code_product,price,quantity) VALUES (?,?,?,?)';
// //     $stmt = $dbh->prepare($sql);
// //     $data = array();
// //     $data[] = $lastcode;
// //     $data[] = $cart[$i];
// //     $data[] = $price[$i];      
// //     $data[] = $kazu[$i];     
// // $stmt->execute($data);
// // }
// $dbh = null;

//     $cateArr = [];
//     $cateArr['name'] = $name;
//     $cateArr['price'] = $price;
//     $cateArr['suuryo'] = $suuryo;
//     $cateArr['shoukei'] = $shoukei;
// // var_dump($cateArr);       
//     // var_dump($dataArr);

//     $dataArr = $_POST;    

// $context['cateArr'] = $cateArr;
// $context['dataArr'] = $dataArr;
// $template = $twig->loadTemplate('complete.html.twig');
// $template->display($context);