<?php
if (!defined('KY_PATH'))	exit();

$config =require '../config.php';

$array = array(
    'URL_ROUTER_ON' => true,
    'DEFAULT_MODULE' =>'public',
   'super_user'=>'admin',
   'login_page'=>'public/login',
   'app_dir'=>'.',
    
);
return array_merge($config,$array);
?>