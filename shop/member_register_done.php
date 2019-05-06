<?php
session_start();
session_regenerate_id(true);

require('C://xampp/htdocs/exam4/register/Bootstrap.class.php');
use register\Bootstrap;

$loader = new \Twig_Loader_Filesystem(Bootstrap::TEMPLATE_DIR);
$twig = new \Twig_Environment($loader, [
    // 'cache' => Bootstrap::CACHE_DIR
    'cache' => false
]);
$context['title'] = '登録完了';
$template = $twig->loadTemplate('member_register_done.html.twig');
$template->display($context);

try {
    require_once('../common/common.php');

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

    $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $sql = "LOCK TABLES dat_sales WRITE,dat_sales_product WRITE,dat_member WRITE";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $lastmembercode = 0;

    $sql = 'INSERT INTO dat_member (password,name,email,postal1,postal2,address,tel,danjo,born) VALUES (?,?,?,?,?,?,?,?,?)';
    $stmt = $dbh->prepare($sql);
    $data = array();
    $data[] = $pass;
    $data[] = $onamae;
    $data[] = $email;
    $data[] = $postal1;
    $data[] = $postal2;
    $data[] = $address;
    $data[] = $tel;
    if ($danjo === 'dan') {
        $data[] = 1;
    } else {
        $data[] = 2;
    }
    $data[] = $birth;
    $stmt->execute($data);

    $sql = 'SELECT LAST_INSERT_ID()';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    $lastmembercode = $res['LAST_INSERT_ID()'];


    $sql = "UNLOCK TABLES";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $dbh = null;
} catch (Exception $e) {

    echo 'ただいま障害により大変ご迷惑をお掛けしております。';
    echo $e->getMsessage();
    var_dump($e);
    exit();
}

?>
