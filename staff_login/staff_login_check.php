<?php
//アクセスURL：http://localhost/exam4/staff_login/staff_login_check.php


try {
    require_once('../common/common.php');

//クロスサイトスクリプティング（XSS)防止のため、エスケープ処理
    // $post = sanitize($_POST);
    $staff_code = $_POST['code'];
    $staff_pass = $_POST['pass'];

    $options = [
        'cost' => 10,
    ];
    $hash = password_hash($staff_pass, PASSWORD_DEFAULT,$options);
    if (password_verify($staff_pass, $hash)) {
        // echo 'Password is good!';
        // echo $staff_pass;
        // echo $hash;
        // $staff_pass = $hash;
        // session_start();
        // $_SESSION['login'] = 1;
        // $_SESSION['staff_code'] = $staff_code;
        // $_SESSION['staff_name'] = $res['name'];
        // header('Location:staff_top.php');
        // exit();
    } else {
        
        echo 'Invalid password.';
    }

    // $staff_hash = password_hash($staff_pass, PASSWORD_DEFAULT);
    // $staffpass = md5($staff_pass);
    $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';

    $dbh = new PDO($dsn, $user, $password);
    // var_dump($dbh);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // var_dump($dbh);
    $sql = 'SELECT name FROM mst_staff WHERE code=? AND password=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $staff_code;
    $data[] = $staff_pass;
    $stmt->execute($data);
    // var_dump($stmt);
    // $pass = $stmt->fetch();
    // var_dump($pass);

    $dbh = null;

    $res = $stmt->fetch(PDO::FETCH_ASSOC);
//  while ($result = $stmt->fetch(\PDO::FETCH_ASSOC)) {
//  array_push($data, $result);
//  return $data;
//  }

    // var_dump($data);
    // var_dump($res);
    if($res === false) {
    // if($data === false) {
        echo 'スタッフコードかパスワードが間違っています。<br/>';
        echo '<a href="staff_login.html">戻る</a>';
    } else {
        session_start();
        $_SESSION['login'] = 1;
        $_SESSION['staff_code'] = $staff_code;
        $_SESSION['staff_name'] = $res['name'];
        header('Location:staff_top.php');
        exit();
    }
}
catch (Exception $e){
    // echo $e->getMessage();
    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}
?>
