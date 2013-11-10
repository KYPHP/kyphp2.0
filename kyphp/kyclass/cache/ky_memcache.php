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
final class ky_memcache {

        private $connect;
        public function __construct($host,$port) {

                if(!$this->connect)$this->connect= memcache_connect($host, $port);
        }


        public function get($key) {

                return memcache_get($this->connect,$key);
        }

        public function set($key, $value,$expire=3600) {

                return memcache_set($this->connect,$key, $value, 0, $expire);
        }

        public function delete($key) {

                memcache_delete($this->connect,$key);
        }
}
?>