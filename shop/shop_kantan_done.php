<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['member_login']) === false) {

    echo 'ログインされていません。<br />';
    echo '<a href="shop_list.php">商品一覧へ</a>';
    exit();
}


try {

    require_once('../common/common.php');

    $post = sanitize($_POST);

    $onamae = $post['onamae'];
    $email = $post['email'];
    $postal1 = $post['postal1'];
    $postal2 = $post['postal2'];
    $address = $post['address'];
    $tel = $post['tel'];

    $cart = $_SESSION['cart'];
    $kazu = $_SESSION['kazu'];
    $max = count($cart);

    $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    for ($i = 0; $i < $max; $i++) {

        $sql = "SELECT name,price FROM mst_product WHERE code=?";
        $stmt = $dbh->prepare($sql);
        $data[0] = $cart[$i];
        $stmt->execute($data);

        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        $name = $res['name'];
        $price = $res['price'];
        $suryo = $kazu[$i];
        $shokei = $price * $suryo;
        $shouhinmei[] = $name;
        $kakaku[] = $price;
        $suuryo[] = $suryo;
        $shoukei[] = $shokei;
    }

    $sql = "LOCK TABLES dat_sales WRITE,dat_sales_product WRITE,dat_member WRITE";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $lastmembercode = $_SESSION['member_code'];

    $sql = 'INSERT INTO dat_sales (code_member,name,email,postal1,postal2,address,tel) VALUES (?,?,?,?,?,?,?)';
    $stmt = $dbh->prepare($sql);
    $data = array();
    $data[] = $lastmembercode;
    $data[] = $onamae;
    $data[] = $email;
    $data[] = $postal1;
    $data[] = $postal2;
    $data[] = $address;
    $data[] = $tel;

    $stmt->execute($data);

    $sql = 'SELECT LAST_INSERT_ID()';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    $lastmembercode = $res['LAST_INSERT_ID()'];

    $sql = "INSERT INTO dat_sales(code_member,name,email,postal1,postal2,address,tel)VALUES(?,?,?,?,?,?,?)";
    $stmt = $dbh->prepare($sql);
    $data = array();
    $data[] = $lastmembercode;
    $data[] = $onamae;
    $data[] = $email;
    $data[] = $postal1;
    $data[] = $postal2;
    $data[] = $address;
    $data[] = $tel;
    $stmt->execute($data);

    $sql = 'SELECT LAST_INSERT_ID()';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    $lastcode = $res['LAST_INSERT_ID()'];

    for ($i = 0; $i < $max; $i++) {

        $sql = "INSERT INTO dat_sales_product (code_sales,code_product,price,quantity) VALUES (?,?,?,?)";
        $stmt = $dbh->prepare($sql);
        $data = array();
        $data[] = $lastcode;
        $data[] = $cart[$i];
        $data[] = $kakaku[$i];
        $data[] = $kazu[$i];
        $stmt->execute($data);
    }

    $sql = "UNLOCK TABLES";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $dbh = null;

    // $dataArr = $cart;
    // var_dump($cart);
    // var_dump($name);    
    // var_dump($shouhinmei);
    // var_dump($price);
    // var_dump($suuryo);
    // var_dump($shoukei);
    // foreach($shouhinmei as $key => $value) {
    //     echo $value;
    // }

    $honbun = "";
    $honbun .= $onamae . "様\n\n";
    $honbun .= "※このメールは、ご注文いただきますと自動的に送信されます。\n\n";
    $honbun .= "このたびは、当店をご利用いただき誠にありがとうございます。\n";
    $honbun .= "お客様のご注文を下記の内容で承りましたのでご連絡申し上げます。\n\n";
    $honbun .= "商品到着まで、このメールは大切に保管しておいてくださいますようお願い申し上げます。\n\n\n";
    $honbun .= "▼お客様情報\n";
    $honbun .= "=======================================\n";
    $honbun .= "【　お　　名　　前　】" . $onamae . "\n";
    $honbun .= "【　メールアドレス　】" . $email . "\n";
    $honbun .= "【　郵　便　番　号　】" . $postal1 . "-" . $postal2 . "\n";
    $honbun .= "【　ご　　住　　所　】" . $address . "\n";
    $honbun .= "【　電　話　番　号　】" . $tel . "\n";
    $honbun .= "=======================================\n\n";
    $honbun .= "▼商品情報\n";
    for ($i = 0; $i < $max; $i++) {
            $honbun .= "=======================================\n";
            $honbun .= "【　商　　品　　名　】" . $shouhinmei[$i] . "\n";
            $honbun .= "【　価　格　(税込)　】" . number_format($kakaku[$i]) . "円\n";
            $honbun .= "【　　数　　　量　　】" . $suuryo[$i] . "個\n";
            $honbun .= "【　　小　　　計　　】" . number_format($shoukei[$i]) . "円\n";
            $honbun .= "=======================================\n\n";
        }
    $honbun .= "代金は以下の口座にお振込みください。\n";
    $honbun .= "上原銀行　上原支店　普通口座１２３４５６７\n";
    $honbun .= "入金確認が取れ次第、梱包、発送させていただきます。\n\n";
    $honbun .= "このメールに心当たりのない場合や、ご不明な点がございましたら、下記までご連絡ください。\n\n";
    $honbun .= "*******************************************\n";
    $honbun .= "お受験・面接・通学スタイル｜子供服のパールボンキッズ\n\n";
    $honbun .= "東京都豊島区西池袋５－８－６\n\n";
    $honbun .= "090-4371-3571\n\n";
    $honbun .= "uehara@perlebon.co.jp\n";
    $honbun .= "*******************************************\n\n";

    echo nl2br($honbun);

    $title = 'ご注文ありがとうございます。';
    $header = 'From:everything.is.endeavour@gamail.com';
    $honbun = html_entity_decode($honbun, ENT_QUOTES, 'UTF-8');
    mb_language('Japanese');
    mb_internal_encoding('UTF-8');
    mb_send_mail($email, $title, $honbun, $header);

    $title = 'お客様からご注文がありました。';
    $header = 'From:' . $email;
    $honbun = html_entity_decode($honbun, ENT_QUOTES, 'UTF-8');
    mb_language('Japanese');
    mb_internal_encoding('UTF-8');
    mb_send_mail('info@rokumarunouen.co.jp', $title, $honbun, $header);
} catch (Exception $e) {

    echo 'ただいま障害により大変ご迷惑をお掛けしております。';
    echo $e->getMsessage();
    var_dump($e);
    exit();
}

?>
<html>

<head></head>

<body>
    <br />
    <a href="shop_list.php">商品画面へ</a>

</body>

</html>