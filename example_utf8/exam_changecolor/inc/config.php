<?php
if (!defined('KY_PATH'))	exit();
$config =require '../config.php';

$array = array(
    'DEFAULT_TPL'=>'blue',
    'URL_ROUTER_ON' => true,
    'DEFAULT_MODULE' =>'',
	'app_dir'=>'.',
   'DEFAULT_C_PATH' =>'lib',//指定生成M文件路径
    
);
return array_merge($config,$array);
?>