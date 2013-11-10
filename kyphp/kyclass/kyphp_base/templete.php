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
class templete{
	public $data=array();
	public function set($tpl){
		extract($this->data);		
      	ob_start();
		$tpldir=$this->config->get('DEFAULT_TPL');
		if(!$tpldir)$tpldir='default';
		require DEFAULT_TPL_PATH.'/'.$tpldir.'/'.$tpl;
		$content = ob_get_contents();
      	ob_end_clean();
		$this->content=$content;
		return $content;
	}
	public function render(){
		return $this->content;
	
	}






}
?>