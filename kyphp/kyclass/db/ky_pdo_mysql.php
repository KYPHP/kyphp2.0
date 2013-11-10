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
final class ky_pdo_mysql {
	private $connection;

	public function __construct($hostname, $username, $password, $database,$charset='utf8') {
		$this->connect($hostname, $username, $password, $database,$charset);
		
  	}
	public function connect($hostname, $username, $password, $database,$charset){

		$dsn = sprintf("mysql:host=%s;dbname=%s", $hostname, $database );

		if(!$this->connection){
			$this->connection = new PDO($dsn, $username, $password);
		}

		$this->connection->query("SET NAMES '{$charset}'");
		$this->connection->query("SET CHARACTER SET {$charset}");
		$this->connection->query("SET CHARACTER_SET_CONNECTION={$charset}");
		$this->connection->query("SET SQL_MODE = ''");
	
	
	}
  	public function query($sql) {		
		
		$result = $this->connection->query($sql);
		if ($result) {
			
				$data = array(); 
				$i = 0;
				while($row =  $result->fetch(PDO::FETCH_ASSOC)){
					$data[$i] = $row;
					$i++;
				}

				$query = new stdClass();	
				$query->row = isset($data[0]) ? $data[0] : array();
				$query->rows = $data;
				$query->num_rows = $i;
				
				unset($data,$result);
				return $query;	
		} else {
			
			trigger_error($this->connection->errorInfo());
			echo $sql;
			
    	}
  	}
	
	public function escape($value) {
		return addslashes($value);
	}
	
  	public function countAffected() {
    	return $this->connection->rowCount();
  	}

  	public function getLastId() {
    	return $this->connection->lastInsertId();
  	}	
	
	public function __destruct() {
		unset($this->connection);
	}
	public function exec($sql){
		$result = $this->connection->query($sql);
		return $result;
	}
}
?>