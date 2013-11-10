<?php
// +----------------------------------------------------------------------
// ×î±ã½İµÄphp¿ò¼Ü
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
final class ky_MySQL {
	private $link;
	
	public function __construct($hostname, $username, $password, $database,$charset='utf8') {
		if (!$this->link = mysql_connect($hostname, $username, $password)) {
      		trigger_error('Error: Could not make a database link using ' . $username . '@' . $hostname);
		}

    	if (!mysql_select_db($database, $this->link)) {
      		trigger_error('Error: Could not connect to database ' . $database);
    	}
		
		mysql_query("SET NAMES '{$charset}'", $this->link);
		mysql_query("SET CHARACTER SET {$charset}", $this->link);
		mysql_query("SET CHARACTER_SET_CONNECTION={$charset}", $this->link);
		mysql_query("SET SQL_MODE = ''", $this->link);
  	}
		
  	public function query($sql) {
		if ($this->link) {
			$resource = mysql_query($sql, $this->link);
	
			if ($resource) {
				if (is_resource($resource)) {
					$i = 0;
			
					$data = array();
			
					while ($result = mysql_fetch_assoc($resource)) {
						$data[$i] = $result;
			
						$i++;
					}
					
					mysql_free_result($resource);
					
					$query = new stdClass();
					$query->row = isset($data[0]) ? $data[0] : array();
					$query->rows = $data;
					$query->num_rows = $i;
					
					unset($data);
					
					return $query;	
				} else {
					return true;
				}
			} else {
				trigger_error('Error: ' . mysql_error($this->link) . '<br />Error No: ' . mysql_errno($this->link) . '<br />' . $sql);
				exit();
			}
		}
  	}
	
	public function escape($value) {
		if ($this->link) {
			return mysql_real_escape_string($value, $this->link);
		}
	}
	
  	public function countAffected() {
		if ($this->link) {
    		return mysql_affected_rows($this->link);
		}
  	}

  	public function getLastId() {
		if ($this->link) {
    		return mysql_insert_id($this->link);
		}
  	}	
	
	public function __destruct() {
		if ($this->link) {			
			mysql_close($this->link);
			unset($this->link);
		}
	}
	public function exec($sql){
		return  mysql_query($sql, $this->link);
	}
}
?>