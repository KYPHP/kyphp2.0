<?php
// +----------------------------------------------------------------------
// ×î±ã½ÝµÄphp¿ò¼Ü
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.ky53.net All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.ky53.net )
// +----------------------------------------------------------------------

/**
 
 * @author   qq:974005652(zhx626@126.com) byÀÏÍçÍ¯
 * @version  2.0
 +------------------------------------------------------------------------------
 */
final class Cookie {	 
	public static  function set($name,$value,$time=0,$path='/',$host='',$secure=0,$httponly =0){
		if(!$host){
			$hosts=isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:'';
			$hostss=explode('.',$hosts);
			if(count($hostss)==3)$host=$hostss[1].'.'.$hostss[2];
			
			}
		if(!$time)$time=time()+3600*24*30;
		setcookie($name,$value,$time,$path,$host,$secure,$httponly);	
	}
	public static function remove($name){	
		setcookie($name,'',-1);
	}
	public static function get($name=''){
		if($name){
			if(isset($_COOKIE[$name]))return $_COOKIE[$name];
		}
		else{
			return $_COOKIE;
		}
	}
	
}
?>