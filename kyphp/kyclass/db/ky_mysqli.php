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
final class ky_mysqli {
	private $mysqli;
	
	public function __construct($hostname, $username, $password, $database,$charset='utf8') {
		$this->mysqli = new mysqli($hostname, $username, $password, $database);
		
		if ($this->mysqli->connect_error) {
      		trigger_error('Error: Could not make a database link (' . $this->mysqli->connect_errno . ') ' . $this->mysqli->connect_error);
		}
		
		$this->mysqli->query("SET NAMES '{$charset}'");
		$this->mysqli->query("SET CHARACTER SET {$charset}");
		$this->mysqli->query("SET CHARACTER_SET_CONNECTION={$charset}");
		$this->mysqli->query("SET SQL_MODE = ''");
  	}
		
  	public function query($sql) {
		
		$result = $this->mysqli->query($sql);

		

		if ($this->mysqli->errno) {
		
			trigger_error($this->mysqli->error.$sql);
			
		}
		
			//if (is_resource($resource)) {
				$i = 0;
    	
				$data = array();
				if($result){
				while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
					$data[$i] = $row;
    	
					$i++;
				}

				$result->close();
				}
				$query = new stdClass();
				$query->row = isset($data[0]) ? $data[0] : array();
				$query->rows = $data;
				$query->num_rows =$data;
				
				unset($data);
				
				
				
				
				return $query;	
    		
		
  	}
	
	public function escape($value) {
		return $this->mysqli->real_escape_string($value);
	}
	
  	public function countAffected() {
    	return $this->mysqli->affected_rows;
  	}

  	public function getLastId() {
    	return $this->mysqli->insert_id;
  	}	
	
	public function __destruct() {
		$this->mysqli->close();
	}
	public function exec($sql){
	
		return $this->mysqli->query($sql);
	
	}
}
?>