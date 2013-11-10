<?php
// +----------------------------------------------------------------------
// | 科亿php by 老顽童
// +----------------------------------------------------------------------

// 定义 科亿php框架路径
define('APP_PATH',dirname(__FILE__));//当前项目路径
define('KYPHP_PATH',APP_PATH.'/../../kyphp/');//KYPHP框架路径

require KYPHP_PATH."kyphp.php";

KYPHP::Run();

?>