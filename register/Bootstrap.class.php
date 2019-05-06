<?php
/*
 * ファイルパス : C:￥xampp/htdocs/exam4/register/bootstrap.class.php
 *ファイル名 : Bootstrap.class.php (設定に関するプログラム)
 */
namespace register;
require_once dirname(__FILE__) . './../../vendor/autoload.php';
class Bootstrap
{
    const DB_HOST = 'localhost';
    const DB_NAME = 'shop';
    const DB_USER = 'root';
    const DB_PASS = '';
    // const DB_TYPE = 'mysql';

    // macユーザーは下段
    const APP_DIR = 'c:/xampp/htdocs/';
    // const APP_DIR = '/Applications/XAMPP/xamppfiles/htdocs';

    const TEMPLATE_DIR = self::APP_DIR . 'exam4/templates';


    const CACHE_DIR = self::APP_DIR . 'templates_c/exam4/';

    const APP_URL = 'http://localhost/';

    const ENTRY_URL = self::APP_URL . 'exam4/';

    const DIRECTORY_SEPARATOR = '/';

    public static function loadClass($class)
    {
        $path = str_replace('\\', self::DIRECTORY_SEPARATOR, 'C:/xampp/htdocs/exam4/register/lib/' . $class . '.class.php');
        require_once $path; 
    }
}

// これを実行しないとオートローダーとして動かない
spl_autoload_register([
    'register\Bootstrap',
    'loadClass'
]);