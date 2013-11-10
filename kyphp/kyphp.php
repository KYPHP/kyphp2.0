<?php
// +----------------------------------------------------------------------
// 最便捷的php框架
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.ky53.net All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.ky53.net )
// +----------------------------------------------------------------------

/**
 
 * @author   qq:974005652(zhx626@126.com) by老顽童
 * @version  2.0
 +------------------------------------------------------------------------------
 */
	if(!defined('__CHARSET__')){
		define('__CHARSET__','utf-8');
	}
	 header("Content-type:text/html;charset=".__CHARSET__);
 
	if(!defined('KYPHP_PATH'))die('请定义常量：KYPHP_PATH');
	define('KY_PATH',KYPHP_PATH);
	require_once KYPHP_PATH.'kycmd/message.php';
	require_once KYPHP_PATH.'kycmd/cmd.php';

  
  
?>