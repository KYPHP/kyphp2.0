<?php
if (!defined('KY_PATH'))	exit();
$config =require '../config.php';

$array = array(
 'PATH_KEY'=>2, // URL类型,兼容模式请设置为3,1为path_info ,2为伪静态，4为静态
    'URL_ROUTER_ON' => false,//静态自动跳转
    'DEFAULT_MODULE' =>'',
	'app_dir'=>'.',
	'DEFAULT_C_PATH' =>'lib'
   
    
);
return array_merge($config,$array);
?>