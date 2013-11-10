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
class ky_file { 
	private $expire = 3600; 

	public function get($key) {
		$cache_dir=DIR_CACHE;
		
		if(defined('FILE_CACHE_HASH')&&FILE_CACHE_HASH)$cache_dir=DIR_CACHE.$this->getHashDir($key);

		$files = glob($cache_dir . 'cache.' . preg_replace('/[^A-Z0-9\._-]/i', '', $key) . '.*');

		if ($files) {
			$cache = file_get_contents($files[0]);
			
			$data = unserialize($cache);
			
			foreach ($files as $file) {
				$time = substr(strrchr($file, '.'), 1);

      			if ($time < time()) {
					if (file_exists($file)) {
						unlink($file);
					}
      			}
    		}
			
			return $data;			
		}
	}

  	public function set($key, $value,$expire=0) {
    	$this->delete($key);
		if($expire)$this->expire=$expire;
		if(!is_dir(DIR_CACHE))mkdir(DIR_CACHE,0755, true);
		$cache_dir=DIR_CACHE;
		if(defined('FILE_CACHE_HASH')&&FILE_CACHE_HASH)$cache_dir=DIR_CACHE.$this->getHashDir($key);
		if(!is_dir($cache_dir))mkdir($cache_dir,0755, true);

		$file = $cache_dir . 'cache.' . preg_replace('/[^A-Z0-9\._-]/i', '', $key) . '.' . (time() + $this->expire);
    	
		$handle = fopen($file, 'w');

    	fwrite($handle, serialize($value));
		
    	fclose($handle);
  	}
	
  	public function delete($key) {
		$cache_dir=DIR_CACHE;
		if(defined('FILE_CACHE_HASH')&&FILE_CACHE_HASH)$cache_dir=DIR_CACHE.$this->getHashDir($key);
		$files = glob($cache_dir . 'cache.' . preg_replace('/[^A-Z0-9\._-]/i', '', $key) . '.*');
		
		if ($files) {
    		foreach ($files as $file) {
      			if (file_exists($file)) {
					unlink($file);
				}
    		}
		}
  	}
	public static function getHashDir($url) {
		$m = md5($url);
		return implode(DIRECTORY_SEPARATOR, array($m{0}, $m{1}, $m{2}, $m{3})); 
	}

}
?>