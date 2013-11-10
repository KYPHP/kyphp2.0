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
if(!defined('__CONFIG__'))define('__CONFIG__',APP_PATH.'/inc/config.php');
require KYPHP_PATH.'kyclass/kyphp_mvc/controller.php';
require KYPHP_PATH.'kyclass/kyphp_mvc/model.php';
require KYPHP_PATH.'kyclass/kyphp_mvc/view.php';
final class KYPHP {
	
  	public function __construct() {
		
	}
	public static function Run($config=array()){
		global $KYPHP,$_charset;
		if(!$config){
			$config=require(APP_PATH."/inc/config.php");		
		}

		
		$KYPHP=new stdClass();
		$KYPHP->runtime=new runtime();
		$KYPHP->runtime->start();
		$conf = new Config();
		if(isset($config['DEFAULT_LIB_PATH']))$config['DEFAULT_C_PATH']=$config['DEFAULT_LIB_PATH'];
		if(isset($config['DEFAULT_TPL_PATH']))$config['DEFAULT_V_PATH']=$config['DEFAULT_TPL_PATH'];
			
		foreach ($config as $key=>$value) {
			$conf->set($key, $value);
		}
		$KYPHP->config=$conf;
		$DIR_CACHE=$conf->get('DIR_CACHE');
		if(!$DIR_CACHE) $DIR_CACHE='cache';
		define('DIR_CACHE', APP_PATH.'/'.$DIR_CACHE.'/');
		
		$DIR_LOGS=$conf->get('DIR_LOGS');
		if(!$DIR_LOGS) $DIR_LOGS='log';
		define('DIR_LOGS', APP_PATH.'/'.$DIR_LOGS.'/');


		 $urlpath_array=array(1,2,4,5);
		if(in_array($KYPHP->config->get('PATH_KEY'),$urlpath_array)){
			$uri=$_SERVER['REQUEST_URI'];
			if(strstr($uri,'?')){
				$wenum=strpos($uri,'?');
				$urlars=substr($uri,$wenum+1);
				$urlars=str_replace('&amp;','&',$urlars);
				$urlargs=explode('&',$urlars);
				if($urlargs)foreach($urlargs as $urlvalue){
					$urlagrsand=explode('=',$urlvalue);
					if($urlagrsand)$_GET[$urlagrsand[0]]=isset($urlagrsand[1])?$urlagrsand[1]:'';
					$KYPHP->request->get=$_GET;
				}
			
			}
		
		}
		
		if(!$conf->get('app_dir'))$conf->set('app_dir','app');
		if(is_array($conf->get('app_dir'))){
			$app_dirs=$conf->get('app_dir');			
			$conf->set('app_dir',$app_dirs[0]);			
			if(isset($_GET['app'])&&in_array($_GET['app'],$app_dirs))$conf->set('app_dir',$_GET['app']);
			}
		if($conf->get('CACHE_HASH')=='on'){
			define('FILE_CACHE_HASH','on');
		}
		if($conf->get('DB_TYPE'))$KYPHP->db = new DB($conf->get('DB_TYPE'), $conf->get('DB_HOST'), $conf->get('DB_USER'), $conf->get('DB_PWD'), $conf->get('DB_NAME'),$conf->get('DB_PREFIX'),$conf->get('DB_CHARSET'));
		$KYPHP->_db=array();
		if($conf->get('_db')){
			if(is_array($conf->get('_db')))foreach($conf->get('_db') as $_dbkey=>$_dbvalue){
				$KYPHP->_db[$_dbkey]= new DB($_dbvalue['DB_TYPE'], $_dbvalue['DB_HOST'], $_dbvalue['DB_USER'], $_dbvalue['DB_PWD'], $_dbvalue['DB_NAME'],$_dbvalue['DB_PREFIX'],isset($_dbvalue['DB_CHARSET'])?$_dbvalue['DB_CHARSET']:'utf8');
			}
		
		
		
		}
		if($conf->get('WEBURL')){ define('__WEBURL__', $conf->get('WEBURL'));}else{
			$phpself=$_SERVER['PHP_SELF'];
			$phpselfs=explode('/',$phpself);
			unset($phpselfs[count($phpselfs)-1]);
			$phpself=implode('/',$phpselfs);
			define('__WEBURL__', $phpself);
		
		}
		if($conf->get('SSLURL')){ define('__SSLURL__', $conf->get('SSLURL'));}
		$KYPHP->url = new Url(__WEBURL__,$conf->get('SSLURL'));	
		$KYPHP->log = new Log($conf->get('error_filename'));	
		$KYPHP->request = new Request();	
		$KYPHP->response = new Response();	
		$cache=$conf->get('cache');
		if(!$cache)$cache=array('dirver'=>'file');
		$KYPHP->cache=new Cache($cache);
		$KYPHP->_cache=array();
		if($conf->get('_cache')){
			if(is_array($conf->get('_cache')))foreach($conf->get('_cache') as $_cachekey=>$_cachevalue){
				
				$KYPHP->_cache[$_cachekey]= new Cache($_cachevalue);
			}	
		
		}



		$KYPHP->session = new Session();
		
		

		$DEFAULT_MODULE=$conf->get('DEFAULT_MODULE');
		 if($DEFAULT_MODULE){define('DEFAULT_MODULE', $DEFAULT_MODULE);}else{define('DEFAULT_MODULE','index/index');}
		$k=isset($_GET['k'])?$_GET['k']:DEFAULT_MODULE;

		
		 define('__ROOT__', APP_PATH);
		 $app_dir=$conf->get('app_dir');		
		 if($app_dir){define('APP_DIR',APP_PATH.'/'.$app_dir);}else{define('APP_DIR',APP_PATH);}
		 $DEFAULT_M_PATH=$conf->get('DEFAULT_M_PATH');
		 if($DEFAULT_M_PATH){define('DEFAULT_M_PATH',APP_DIR.'/'.$DEFAULT_M_PATH);}else{define('DEFAULT_M_PATH',APP_DIR.'/model');}
		 $DEFAULT_C_PATH=$conf->get('DEFAULT_C_PATH');
		 if($DEFAULT_C_PATH){define('DEFAULT_C_PATH',APP_DIR.'/'.$DEFAULT_C_PATH);}else{define('DEFAULT_C_PATH',APP_DIR.'/controller');}
		 $DEFAULT_V_PATH=$conf->get('DEFAULT_V_PATH');
		 if($DEFAULT_V_PATH){define('DEFAULT_V_PATH',APP_DIR.'/'.$DEFAULT_V_PATH);}else{define('DEFAULT_V_PATH',APP_DIR.'/tpl');}
		 $DEFAULT_L_PATH=$conf->get('DEFAULT_L_PATH');
		 if($DEFAULT_L_PATH){define('DEFAULT_L_PATH',APP_DIR.'/'.$DEFAULT_L_PATH.'/');}else{define('DEFAULT_L_PATH',APP_DIR.'/language/');}

		  $DEFAULT_CMD_PATH=$conf->get('DEFAULT_CMD_PATH');
		 if($DEFAULT_CMD_PATH){define('DEFAULT_CMD_PATH',APP_DIR.'/'.$DEFAULT_CMD_PATH);}else{define('DEFAULT_CMD_PATH',APP_DIR.'/common');}
		define('DIR_LANGUAGE',DEFAULT_L_PATH);
		 define('DEFAULT_TPL_PATH',DEFAULT_V_PATH);
		 define('DEFAULT_LIB_PATH',DEFAULT_C_PATH);

		 $code=$conf->get('code');
		if(!$code)$code='zh-cn';
		$KYPHP->language = new Language($code);

		 if(substr($k,0,1)=='/'){
			$k=substr($k,1);
		}
		 $kkks=explode('/',$k);

		 if($conf->get('PATH_KEY')==5||$conf->get('PATH_KEY')==3||!$conf->get('PATH_KEY')){

			define('__URL__', $_SERVER['PHP_SELF'].'?k='.$kkks[0]);
			define('__APP__', $_SERVER['PHP_SELF'].'?k=');
			
		  }
		   
		  if($conf->get('PATH_KEY')==1){
			define('__URL__', $_SERVER['PHP_SELF'].'/'.$kkks[0]);
			define('__APP__', $_SERVER['PHP_SELF'].'');
			
		  }
		  if($conf->get('PATH_KEY')==2){
			define('__URL__', __WEBURL__.'/'.$kkks[0]);
			 define('__APP__', __WEBURL__);
		  }
			
		  if($conf->get('PATH_KEY')==4){
			
			if(!$conf->get('DEFAULT_HTML_PATH'))$conf->set('DEFAULT_HTML_PATH','html');
			$locurl=__WEBURL__;		  
			define('__URL__', $locurl.'/'.$conf->get('DEFAULT_HTML_PATH').'/'.$kkks[0]);
			 define('__APP__', $locurl.'/'.$conf->get('DEFAULT_HTML_PATH'));
		  
		  }
		  if($conf->get('PATH_KEY')>5||$conf->get('PATH_KEY')<0){
	      error(3,$_charset['path_key_model']);
		  }
		 
		 if(is_file(DEFAULT_CMD_PATH.'/cmd.php'))require_once(DEFAULT_CMD_PATH.'/cmd.php');	
		
		if($KYPHP->config->get('PATH_KEY')==5){
			if($KYPHP->config->get('URL_MODULE')){
				$urlmodule=$KYPHP->config->get('URL_MODULE');
				$urlcontrolclassfile=DEFAULT_C_PATH.'/'.$urlmodule.'.php';
				
			
				if(is_file($urlcontrolclassfile)){			
				require_once $urlcontrolclassfile;
		
				}
				$urlmoduleclass='Controller'.preg_replace('/[^a-zA-Z0-9]/', '', $urlmodule);
				$urlsc=explode('/',$urlmodule);
				$url_classc=array('action'=>$urlsc[0],'file'=>$urlsc[1],'method'=>'index');
				$url_class=new $urlmoduleclass($KYPHP,$url_classc);
				$kkk_try=$url_class->index();
				if($kkk_try){
					$KYPHP->request->get['k']=$kkk_try;
					$_GET['k']=$kkk_try;
					$k=$kkk_try;
				}
			}
		
		}
		if($KYPHP->config->get('CACHE_ON')=='on'){
			$urlcachekey='KYPHP_URL'.$_SERVER['REQUEST_URI'];
			$urlcache=array('dirver'=>'file');
			$kyphpcache=new Cache($urlcache);
			if($kyphpcache->get($urlcachekey)){			
				if($kyphpcache->get($urlcachekey)!='NULL')echo $kyphpcache->get($urlcachekey);exit;			
			}
		
		}
		$controller=new front($KYPHP,$k);
	
		
	}
	static function autoload_APP($class,$locdirs){
		
		$config=require(__CONFIG__);
		if(isset($config['app_dir'])){
			if(is_array($config['app_dir'])){
				$app_dirs=$config['app_dir'];
				$config['app_dir']=$config['app_dir'][0];
				if(isset($_GET['app'])&&in_array($_GET['app'],$app_dirs))$config['app_dir']=$_GET['app'];
				
			 }
			$config['app_dir']=$config['app_dir'].DIRECTORY_SEPARATOR;}else{
			$config['app_dir']='app'.DIRECTORY_SEPARATOR;
		}
		if(isset($config['DEFAULT_C_PATH'])){$config['DEFAULT_C_PATH']=$config['DEFAULT_C_PATH'].DIRECTORY_SEPARATOR;}else{
			$config['DEFAULT_C_PATH']='controller'.DIRECTORY_SEPARATOR;
		}
		if(isset($config['DEFAULT_M_PATH'])){$config['DEFAULT_M_PATH']=$config['DEFAULT_M_PATH'].DIRECTORY_SEPARATOR;}else{
			$config['DEFAULT_M_PATH']='model'.DIRECTORY_SEPARATOR;
		}
		
		if($locdirs){
			$controlclassfile=APP_PATH.DIRECTORY_SEPARATOR.$config['app_dir'].$config['DEFAULT_C_PATH'].$locdirs[0].'/'.str_ireplace('Controller'.$locdirs[0],'',strtolower($class)).'.php';
			
			if(is_file($controlclassfile)){			
			require_once $controlclassfile;
		
			}
			$controlclassfile=APP_PATH.DIRECTORY_SEPARATOR.$config['app_dir'].$config['DEFAULT_C_PATH'].'public'.'/'.str_ireplace('ControllerPublic','',strtolower($class)).'.php';	
			
			if(is_file($controlclassfile)){			
			require_once $controlclassfile;
		
			}
		
		}
		$actionclassfile=APP_PATH.DIRECTORY_SEPARATOR.$config['app_dir'].$config['DEFAULT_C_PATH'].str_ireplace('Action','',$class).'.class.php';
		
		if(is_file($actionclassfile)){			
			require_once $actionclassfile;
		
		}
		$actionclassfile=APP_PATH.DIRECTORY_SEPARATOR.$config['app_dir'].$config['DEFAULT_M_PATH'].str_ireplace('Model','',$class).'.class.php';
		
		if(is_file($actionclassfile)){			
			require_once $actionclassfile;
		
		}
		

	}
}


?>