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
final class DB {
	private $driver;
	
	public function __construct($driver, $hostname, $username, $password, $database,$dbpre='',$chrset='utf8') {
		if(!$chrset)$chrset='utf8';
		if (file_exists(KYPHP_PATH.'kyclass/db/ky_' . $driver . '.php')) {
			require_once(KYPHP_PATH.'kyclass/db/ky_'. $driver . '.php');
		} else {
			exit('Error: Could not load database file ' . $driver . '!');
		}
		$driver='ky_'.$driver;		
		$this->driver = new $driver($hostname, $username, $password, $database,$chrset);
		$this->dbpre=$dbpre;
		
	}
	public function tablename($name){
		 return $this->dbpre.$name;
	}
		
  	public function query($sql) {
		return $this->driver->query($sql);
  	}
	
	public function escape($value) {
		return $this->driver->escape($value);
	}
	
  	public function countAffected() {
		return $this->driver->countAffected();
  	}

  	public function getLastId() {
		return $this->driver->getLastId();
  	}
	public function exec($sql){
		return $this->driver->exec($sql);
	}
	public  function select($fieldstr='*'){
		
		$dbpre=$this->dbpre;
		
		$str='';
	   if(!empty($this->field)){$fieldstr=$this->field;}

      if(!empty($this->where))$str=" where($this->where)";
	  if(!empty($this->order))$str.=' order by '.$this->order;	
	  if(!empty($this->limit))$str.=' limit '.$this->limit;
	   $this->sql="select $fieldstr from ".$dbpre.$this->table." ".$str;
	
		$form=$this->query($this->sql);	 
		return $form->rows;
	}
	public  function findAll($fieldstr='*'){
		$dbpre=$this->dbpre;
		$str='';
	   if(!empty($this->field)){$fieldstr=$this->field;}

      if(!empty($this->where))$str=" where($this->where)";
	  if(!empty($this->order))$str.=' order by '.$this->order;	
	  if(!empty($this->limit))$str.=' limit '.$this->limit;
	   $this->sql="select $fieldstr from ".$dbpre.$this->table." ".$str;
	 
		$form=$this->query($this->sql);	 
		return $form->rows;
	}

	public function find(){
	$dbpre=$this->dbpre;
	$str='';
	   if(!empty($this->field)){$fieldstr=$this->field;}else{$fieldstr='*';}
      if(!empty($this->where))$str=" where($this->where)";
	  if(!empty($this->order))$str.=' order by '.$this->order;	
	  if(!empty($this->limit))$str.=' limit '.$this->limit;
	   $this->sql="select $fieldstr from ".$dbpre.$this->table." ".$str;
	   
	 $form=$this->query($this->sql);
	 
	 return  $form->row;
	}
	public function total(){
	$dbpre=$this->dbpre;
	$str='';
	   
      if(!empty($this->where))$str=" where($this->where)";
	  if(!empty($this->order))$str.=' order by '.$this->order;	
	  if(!empty($this->limit))$str.=' limit '.$this->limit;
	   $this->sql="select count(*) as total from ".$dbpre.$this->table." ".$str;
	   
	 $form=$this->query($this->sql);
	 
	 return  isset($form->row['total'])?$form->row['total']:0;
	}
	function where($where){
	 $this->where=$where; 
	return $this;
	}
	function order($order){
	 $this->order=$order; 
	return $this;
	}
	function limit($limit){
	 $this->limit=$limit; 
	return $this;
	}
	function field($field){
	 $this->field=$field; 
	return $this;
	}
	function add($data=array()){
	$dbpre=$this->dbpre;
		$fields=array();
		if(!$data)$data=$this->field;
		$fieldk=array();
	   foreach($data as $key=>$k){
			$fields[]="'".addslashes($k)."'"	; 
			$fieldk[]=$key;
	   }
	   $valuestr=implode(',', $fields);
	   $this->sql="insert into ".$dbpre.$this->table." (".implode(',',$fieldk).") values ($valuestr)";
	  $form=false;
	 if($valuestr)$form=$this->exec($this->sql);
	
	 return  $form;
	}
	public function addAll($data=array()){
		$dbpre=$this->dbpre;
		$fields=array();
		$form=$this->query("desc ".$dbpre.$this->table." ");
	    $formarr= $form->rows;
	     foreach($formarr as $key=>$k){
			$fields[]=$k['Field'];
	    }
		if(!$data)$data=$this->field;
	  $values=array();
	  if(!empty($_POST))if(is_array($data)){$data=array_merge($data,$_POST);}else{
		if(!$data)$data=$_POST;
	  }
	  $fieldarray=array();
	   foreach($data as $key=>$k){
	   
	    if(in_array($key,$fields)){
		   
	        $fieldarray[]=$key;
	        $values[]="'".addslashes($k)."'";	   
	        
			
	     }
	   }
	   
	   $valuestr=implode(',',$values);
	   $this->sql="insert into ".$dbpre.$this->table." (".implode(',',$fieldarray).") values (".$valuestr.")";
	
	  $result=false;
	 if($valuestr)$result=$this->exec($this->sql);
	 
	 return $result;
	}
	
	public function save($data=array()){
	$dbpre=$this->dbpre;
	$fields=array();
	if(!$data)$data=$this->field;
	   foreach($data as $key=>$k){
	   $fields[]=$key.'='."'".addslashes($k)."'"	; 
	   }
	   if($this->where)$str=" where($this->where)";
	   $fieldstr=implode(',',$fields);
	   $this->sql="update  ".$dbpre.$this->table." set ".$fieldstr.$str;
	  
	  $result=false;
	 if($data)$result=$this->exec($this->sql);
	
	 return $result;
	}
	public function delete(){
	$dbpre=$this->dbpre;
	
	   if($this->where)$str=" where($this->where)";
	   
	   $this->sql="delete from  ".$dbpre.$this->table.$str;
	  
	  $result=false;
	 $result=$this->exec($this->sql);
	
	 return $result;
	}
	public function saveAll($data=array()){
	$dbpre=$this->dbpre;
	
	 $fields=array();
		$form=$this->query("desc ".$dbpre.$this->table." ");
	    $formarr= $form->rows;
	     foreach($formarr as $key=>$k){
			$fields[]=$k['Field'];
	    }
		if(!$data)$data=$this->field;
	  $values=array();
	  if(!empty($_POST))if(is_array($data)){$data=array_merge($data,$_POST);}else{
		if(!$data)$data=$_POST;
	  }
	   foreach($data as $key=>$k){
	   
	    if(in_array($key,$fields)){
		   
	        
	        $values[]="{$key}='".addslashes($k)."'";	   
	        
			
	     }
	   }
	   
	   $valuestr=implode(',',$values);
	   if($this->where)$str=" where($this->where)";
	   
	   $this->sql="update  ".$dbpre.$this->table." set ".$valuestr.$str;
	 $result=false;
	 if($valuestr)$result=$this->exec($this->sql);
	
	 return $result;
	}
}
?>