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
class Cache { 
	private $expire = 3600; 
	private $driver;
	public function __construct($config) {
		$driver=isset($config['driver'])?$config['driver']:'file';
		$hostname=isset($config['host'])?$config['host']:'';
		$port=isset($config['port'])?$config['port']:'';
		
		if (file_exists(KYPHP_PATH.'kyclass/cache/ky_'. $driver . '.php')) {
			require_once(KYPHP_PATH.'kyclass/cache/ky_'. $driver . '.php');
		} else {
			exit('Error: Could not load cache file ' . $driver . '!');
		}
		$driver='ky_'.$driver;		
		$this->driver = new $driver($hostname, $port);
	}
	public function get($key) {

		return $this->driver->get($key);
	}

  	public function set($key, $value,$expire=3600) {
		return $this->driver->set($key,$value,$expire);

    	
  	}
	
  	public function delete($key) {
		return $this->driver->delete($key);

		
  	}
}
?>