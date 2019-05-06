<!-- *アクセスURL：http://localhost/exam4/shop/shop_product.php -->
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
$context['title'] = '商品詳細';
$template = $twig->loadTemplate('header.html.twig');
$template->display($context);


try {
    $pro_code = $_GET['procode'];

    $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';

    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // var_dump($dbh);
    $sql = 'SELECT name,price,gazou FROM mst_product WHERE code=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $pro_code;
    $stmt->execute($data);

    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    $pro_name = $res['name'];
    $pro_price = $res['price'];
    $pro_gazou_name = $res['gazou'];

    $dbh = null;

    if ($pro_gazou_name === '') {
        $disp_gazou = '';
    } else {
        $disp_gazou = '<img src="../product/images/' . $pro_gazou_name . '">';
    }
} catch (Exception $e) {
    // echo $e->getMessage();
    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}
?>
<!-- twigで書くこと -->
<html>

<head>
    <meta charset="UTF-8">
</head>

<body>
    <div class="product_detail"
        商品情報参照<br /><br />
        商品コード<br />
        <?php echo $pro_code; ?>
        <br />
        商品名<br />
        <?php echo $pro_name; ?><br />
        <br />
        価格<br />
        <?php echo number_format($pro_price) . '円'; ?><br />
        <br />
        <?php echo $disp_gazou; ?><br />
        <br />
        <form>
            <input type="button" onclick="history.back()" value="戻る">
            <?php echo '<a href="shop_cartin.php?procode=' . $pro_code . '">カートに入れる</a><br/><br/>'; ?>
        </form>
    </div>
    <?php readfile(dirname(__DIR__) . "/templates/footer.html.twig"); ?>
</body>

</html>