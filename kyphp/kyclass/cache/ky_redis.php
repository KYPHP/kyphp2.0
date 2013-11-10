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
final class ky_redis {

        private $connect;
        public function __construct($host,$port) {
				$this->redis = new Redis;
                if(!$this->connect)$this->connect= $this->redis->connect($host,$port);
        }

        public function get($key) {

                $result= $this->redis->get($key);
				return unserialize($result);
        }

        public function set($key, $value,$expire=0,$check_repeat=0) {
				$value = serialize($value);
				if($expire){
					$result=$this->redis->setex($key, $expire, $value);
					}else{
						if($check_repeat){
							$result=$this->redis->setnx($key, $value);

						}else{
							$result=$this->redis->set($key, $value);
						}
					}
				
                return $result;
        }
		

        public function delete($key) {

               return  $this->redis->delete($key);
        }
		public function flushAll() {
			return $this->redis->flushAll();
		}
}
?>