<?php
require_once('../common/common.php');

require('C://xampp/htdocs/exam4/register/Bootstrap.class.php');
use register\Bootstrap;

$loader = new \Twig_Loader_Filesystem(Bootstrap::TEMPLATE_DIR);
$twig = new \Twig_Environment($loader, [
    // 'cache' => Bootstrap::CACHE_DIR
    'cache' => false
]);
$template = $twig->loadTemplate('search.html.twig');


// var_dump($_POST['search']);

try {

    $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $dbh->prepare("SELECT * FROM mst_product WHERE name LIKE (:name) ");

        
    if ($stmt) {
        $post = sanitize($_POST);
        $search = $post['search'];
  
        $like_search = "%" . $search . "%";
        //プレースホルダへ実際の値を設定する
        $stmt->bindValue(':name', $like_search, PDO::PARAM_STR);

        if ($stmt->execute()) {
            //レコード件数取得
            $row_count = $stmt->rowCount();
            
            while(true) {
                $res = $stmt->fetch(PDO::FETCH_ASSOC);  
                
                if ($res == false) {
                    $data[] = '';
                    break;
                }
                $data[] = [ $res['name'], $res['code']];

            }
        }
    }
   
// var_dump($data);
// var_dump($search);

    $dbh = null;

    } catch (Exception $e) {
        echo 'ただいま障害により大変ご迷惑をお掛けしております。';
        exit();
}

$context['title'] = '検索結果';
$context['search'] = $search;
$context['row_count'] = $row_count;
$context['data'] = $data;

$template = $twig->loadTemplate('search.html.twig');
$template->display($context);
