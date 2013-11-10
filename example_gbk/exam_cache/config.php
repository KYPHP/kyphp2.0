<?php
if (!defined('KY_PATH'))	exit();

$config=require('../config.php');
$array = array(
    'DEFAULT_TPL'=>'blue',
    'URL_ROUTER_ON' => true,
    'DEFAULT_MODULE' =>'',
    'CACHE_ON'=>false,
    'DEFAULT_C_PATH' =>'lib',
	'app_dir' =>'.',
	'DIR_CACHE'=>'cache',//cache路径,仅文件cache
	'CACHE_TIME_EXPIRE'=>120,//设置过期时间
	'CACHE_CONTENT_WITHTIME'=>'off',//设置缓存文件内容后缀 off为关,为空是自带后缀，其它字符串将直接显示在页面底部
	'CACHE_HASH'=>'on',//是否用hash出的目录，如果页面较多建议设置为on
	
);
return array_merge($config,$array);
?>