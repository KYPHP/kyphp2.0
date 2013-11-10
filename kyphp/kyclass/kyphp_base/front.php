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
final class front {
	
  	public function __construct($KYPHP,$k) {
		
		$this->kyphp=$KYPHP;
		foreach($KYPHP as $key=>$value){
		
			$this->$key=$value;
		}
		if(substr($k,0,1)=='/'){
			$k=substr($k,1);
		}
		$ks=explode('/',$k);
		if(isset($ks[0])){
			$action=$ks[0];
			if(isset($ks[1])){
				$file=$ks[1];
				if(isset($ks[2])){
					$method=$ks[2];
				}else{
				
					$method='index';
				}
				
			}else{
				$file='';
				$method='index';
			}
			global $_charset;
			if($action){
					$class='controller'.$action.$file;
					$cfile=DEFAULT_C_PATH."/".$action.'/'.$file.'.php';
					
					if(is_file($cfile)){
						require_once $cfile;
						
						$url_class=array('action'=>$action,'file'=>$file,'method'=>$method);
						$controller=new $class($KYPHP,$url_class);
						$controller->$method();
					}else{
						$class=$action.'Action';
						$cfile=DEFAULT_C_PATH."/".$action.'.class.php';
						
						if(is_file($cfile)){
							require_once $cfile;
							if(!$file)$file='index';
							$url_class=array('file'=>$action,'method'=>$file);
							$controller=new $class($KYPHP,$url_class);
							$controller->$file();
						}else{
							error(0,$cfile.$_charset['app_dirnoexist'].$class);
						}
					}
					
			}else{
			
				error(0,'action'.$_charset['noexist']);
			}
		}

		
	}
	
}
?>