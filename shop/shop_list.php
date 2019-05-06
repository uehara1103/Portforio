<!-- *アクセスURL：http://localhost/exam4/shop/shop_list.php -->
<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['member_login']) === false) {
    echo 'ようこそゲスト様  ';
    echo '<a href="member_login.html">会員ログイン</a>';
    echo '<br/><br/>';
} else {
    echo 'ようこそ';
    echo $_SESSION['member_name'];
    echo '様　<br/><br/>';
    echo '<a href="member_logout.php">ログアウト<a/><br/>';
}
require('C://xampp/htdocs/exam4/register/Bootstrap.class.php');
use register\Bootstrap;

$loader = new \Twig_Loader_Filesystem(Bootstrap::TEMPLATE_DIR);
$twig = new \Twig_Environment($loader, [
    // 'cache' => Bootstrap::CACHE_DIR
    'cache' => false
]);
$context['title'] = '商品一覧';
$template = $twig->loadTemplate('header.html.twig');
$template->display($context);

try {
    $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';

    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT code,name,price FROM mst_product WHERE 1';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $dbh = null;

    //twigで書くこと
    echo '商品一覧<br/><br/>';
    while (true) {
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($res == false) {
            break;
        }
        echo '<a href="shop_product.php?procode=' . $res['code'] . '">';
        echo $res['name'] . '---';
        echo number_format($res['price']) . '円<br/>';
        echo '</a>';
        echo '<br/><br/>';
    }


    echo '<br/><a href="shop_cartlook.php">カートを見る</a><br/><br/>';
} catch (Exception $e) {
    // echo $e->getMessage();
    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}


echo '<a href="http://localhost/exam4/toppage/index.html">TOPぺージへ戻る</a><br/><br/>';

readfile(dirname(__DIR__) . "/templates/footer.html.twig");

?>