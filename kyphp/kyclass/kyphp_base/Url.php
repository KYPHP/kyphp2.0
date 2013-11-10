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
class Url {
	private $url;
	private $ssl;
	private $rewrite = array();
	
	public function __construct($url, $ssl = '') {
		$this->url = $url;
		$this->ssl = $ssl;
	}
		
	public function addRewrite($rewrite) {
		$this->rewrite[] = $rewrite;
	}
		
	public function link($route='', $args = '', $connection = 'NONSSL') {
		if ($connection ==  'NONSSL') {
			$url = $this->url;
		} else {
			$url = $this->ssl;	
		}
		
		if(empty($route))return $url;
		global $KYPHP;
		$htmlon=true;
		if($KYPHP->config->get('PATH_KEY')==1){
			$url.='/index.php/'.$route;
			
		}elseif($KYPHP->config->get('PATH_KEY')==2){
			$url.='/'.$route;
		}elseif($KYPHP->config->get('PATH_KEY')==4){
			$url.='/'.$conf->get('DEFAULT_HTML_PATH').'/'.$route;
		}else{
			$htmlon=false;

			$url .= '/index.php?k=' . $route;
		}
		if($htmlon)	{
			if ($args) {
				$url .= str_replace('&', '&amp;', '?' . ltrim($args, '&')); 
			}
		
			}else{
			if ($args) {
				$url .= str_replace('&', '&amp;', '&' . ltrim($args, '&')); 
			}
		}
		
		foreach ($this->rewrite as $rewrite) {
			$url = $rewrite->rewrite($url);
		}

				
		return $url;
	}
}
?>