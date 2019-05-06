<?php
require_once '../vendor/autoload.php';

// 送信設定
$transport = new Swift_SmtpTransport('localhost', 25);
$transport->setUsername('root');
$transport->setPassword('');

$mailer = new Swift_Mailer($transport);

// メール作成
$message = new Swift_Message('Subject');
$message->setFrom(['everything.is.endeavour@gmail.com' => '上原　和也']);
$message->setTo(['everything.is.endeavour@gmail.com']);
$message->setBody(
	'Hello,'
);

// メール送信
$result = $mailer->send($message);
var_dump($result);