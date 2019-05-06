<?php
/*
 * ファイルパス : C:￥xampp￥htdocs￥exam3￥register￥confirm.php
 *ファイル名 : confirm.php
 *アクセスURL：http://localhost/exam4/register/confirm.php
 */
// namespace register;

// session_start();
// session_regenerate_id(true);    

    // require_once dirname(__FILE__) . '/Bootstrap.class.php';

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
// $common = new Common();

// // var_dump($_POST); ["confirm"]=> string(12) "登録確認"
// // モード判定(どの画面から来たかの判断)
// // 登録画面から来た場合
// if (isset($_POST['confirm']) === true) {
//     $mode = 'confirm';
// }
// // 戻る場合
// if (isset($_POST['back']) === true) {
//     $mode = 'back';
// }
// // 登録完了
// if (isset($_POST['complete']) === true) {
//     $mode = 'complete'; 
// }
// // ボタンのモードによって処理を変える


// switch ($mode) {
//     case 'confirm': //新規登録
//                     // データを受け継ぐ 
//                     // ↓ この情報は入力には必要ない ["confirm"]=> string(12) "登録確認"以外のデータが欲しいから　["year"]=> string(4) "1900"など
//     unset($_POST['confirm']);

//     $dataArr = $_POST;
//     // var_dump($dataArr);

//     // この値を入れないでPOSTするとUndefinedとなるので未定義の場合は空白状態としてセットしておく
//     if (isset($_POST['sex']) === false) {
//         $dataArr['sex'] = "";
//     }

//     // エラーメッセージの配列作成
//     $errArr = $common->errorCheck($dataArr);
//     $err_check = $common->getErrorFlg();
//     // err_check = false → エラーがありますよ！
//     // err_check = true → エラーがないですよ！
//     // エラー無ければconfirm.tpl あるとregist.tpl
//     $template = ($err_check === true) ? 'confirm.html.twig' : 'register.html.twig';

//     break;

// case 'back' : //戻ってきた時
//               // ポストされたデータを元に戻すので、$dataArrにいれる
//     $dataArr = $_POST;

//     unset($dataArr['back']);

//     // エラーも定義しておかないと、undefinedエラーがでる
//     foreach ($dataArr as $key => $value) {
//         $errArr[$key] = '';
//     }

//     $template = 'register.html.twig';
//     break;

// case 'complete' : //登録完了
//     $dataArr = $_POST;
    
//         // この情報はいらないので外しておく
//         unset($dataArr['complete']);
//         $column = '';
//         $insData = '';

//         // foreachの中でSQL文を作る
//         foreach ($dataArr as $key => $value) {
//             $column .= $key . ',';
//             $insData .= ($key === 'sex') ? $db->quote($value) . ',' : $db->str_quote($value) . ', ';
//         }

//         $query = " INSERT INTO member ( "
//                 . $column
//                 . " regist_date "
//                 . " ) VALUES ( "
//                 . $insData
//                 . "     NOW() "
//                 . " ) ";
//         $res = $db->execute($query);
//         var_dump($res);

//         $db->close();

//         if ($res === true) {
//             // 登録成功時は完成ぺージへ
//             header('Location: ' . Bootstrap::ENTRY_URL . 'register/complete.php');
//             exit();
//         } else {
//             // 登録失敗時は登録画面に戻る
//             $template = 'register.html.twig';
            
//             foreach ($dataArr as $key => $value) {
//                 $errArr[$key] = '';
//             }
//         }

//         break;
// }
// $sexArr = initMaster::getSex();

// $context['sexArr'] = $sexArr;

// list($yearArr, $monthArr, $dayArr) = initMaster::getDate();

// $context['yearArr'] = $yearArr;
// $context['monthArr'] = $monthArr;
// $context['dayArr'] = $dayArr;
// // var_dump($dataArr);

// $context['dataArr'] = $dataArr;
// $context['errArr'] = $errArr;
// $template = $twig->loadTemplate($template);
// $template->display($context);

