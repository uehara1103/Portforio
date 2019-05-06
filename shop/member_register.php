<?php 

require('C://xampp/htdocs/exam4/register/Bootstrap.class.php');
use register\Bootstrap;

$loader = new \Twig_Loader_Filesystem(Bootstrap::TEMPLATE_DIR);
$twig = new \Twig_Environment($loader, [
	// 'cache' => Bootstrap::CACHE_DIR
	'cache' => false
]);
$context['title'] = '会員登録';   
$template = $twig->loadTemplate('member_register.html.twig');
$template->display($context);