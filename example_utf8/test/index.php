<?php
define('APP_PATH',dirname(__FILE__));//当前项目路径
define('KYPHP_PATH',APP_PATH.'/../../kyphp/');//KYPHP框架路径

require KYPHP_PATH."kyphp.php";

KYPHP::Run();

/*
//如果要自定义config路径，需要定义__CONFIG__
define('__CONFIG__',APP_PATH.'/inc/config.php');
$config=require(__CONFIG__);
KYPHP::Run($config);
*/

 
?>