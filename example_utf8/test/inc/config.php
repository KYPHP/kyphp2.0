<?php
if (!defined('KYPHP_PATH'))	exit('未定义KY_PATH');
$array = array(
	'WEBURL'=>'http://localhost',
	'SSLURL'=>'https://localhost',
    'URL_ROUTER_ON' => true,
    'DEFAULT_MODULE' =>'index',
    'PATH_KEY'=>3, // URL类型,兼容模式请设置为3	
	'DB_CHARSET'=>'utf8',
	'DB_HOST'=>'localhost',
	'DB_NAME'=>'kyfrm',
	'DB_USER'=>'test',
	'DB_PWD'=>'123456',
	'DB_PREFIX'=>'ky_',
	'DB_TYPE'=>'mysql',
	'cache'=>array('driver'=>'memcache',//支持redis,file
					'host'=>'127.0.0.1',
					'port'=>'11211',
	),
	'app_dir'=>'app',
	'DEFAULT_M_PATH' =>'m',//指定生成M文件路径 空为'model'
	'DEFAULT_C_PATH' =>'c',//指定生成LIB文件路径，空为'controller'	
	'DEFAULT_V_PATH' =>'v',//指定生成TPL文件路径，空为'tpl'
	'DEFAULT_L_PATH' =>'l',//指定生成TPL文件路径，空为'language'
	'DEFAULT_CMD_PATH'=>'common',//指定生成TPL文件路径，空为'common'
	'error_filename'=>'log.txt',
    
);
return $array;

?>