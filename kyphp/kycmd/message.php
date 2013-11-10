<?php
// +----------------------------------------------------------------------
// 最便捷的php框架
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.ky53.net All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.ky53.net )
// +----------------------------------------------------------------------

/**
 
 * @author   qq:974005652(zhx626@126.com) by老顽童
 * @version  2.0
 +------------------------------------------------------------------------------
 */
$_charset=require_once(KYPHP_PATH.'kydata/'.__CHARSET__.'/data.php');

function error($id,$str){
	global $_charset;
  switch ($id){
   case 0:
   trigger_error($_charset['file'].'"'.$str.$_charset['noexist'].'" ',E_USER_ERROR);
   break;
   case 1:
   trigger_error($_charset['method'].'"'.$str.'()" '.$_charset['noexist'],E_USER_ERROR);
   break;
   case 2:
   trigger_error($_charset['class'].'"'.$str.'()" '.$_charset['noexist'],E_USER_ERROR);
   break;
    case 3:
   trigger_error($str,E_USER_ERROR);
   break;
   default:
   break;


  }

}
$kyphp_error_no=0;$kyphp_errors=array();
function customError($errno, $errstr, $errfile, $errline)
 { global $_charset,$KYPHP,$kyphp_error_no,$kyphp_errors;
	 switch ($errno) {
		case E_NOTICE:
		case E_USER_NOTICE:
			$error = $_charset['notice'];
			break;
		case E_WARNING:
		case E_USER_WARNING:
			$error = $_charset['warning'];
			break;
		case E_ERROR:
		case E_USER_ERROR:
			$error = $_charset['fatal'];
			break;
		default:
			$error = $_charset['unknow'];
			break;
	 }
	 if(empty($KYPHP)){
		 if(!strstr($errstr,'mysql_close')) echo $error.':'.$errstr. 'at:'.$errfile.' line:'.$errline;
		 return;
		 }
	$error_display=$KYPHP->config->get('error_display');
	$error_log=$KYPHP->config->get('error_log');
	if(!$error_display)$error_display='on';
	if(!$error_log)$error_log='on';
	$kyphp_errors[]=array($errno, $errstr, $errfile, $errline);
	$KYPHP->config->set('error',$kyphp_errors);
	if($error_log=='on'){
		$log=new log('error.txt');
		$log->write($error.':'.$errstr.' at:'.$errfile.' line:'. $errline);
	}
	if($error_display=='on'){
		
		kyphp_display_error($errno, $errstr, $errfile, $errline,$kyphp_error_no);		
		$kyphp_error_no++;
	}
	
	//die();
 }


function kyphp_display_error($errno, $errstr, $errfile, $errline,$kyphp_error_no_get){	
	global $_charset,$KYPHP;
	
	if($kyphp_error_no_get==0){
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
		echo "<htmL><head><title>$error{$_charset['error']}：$errstr</title>";
		echo '<meta http-equiv="Content-Type" content="text/html; charset='.__CHARSET__.'" /></head><body>';
		echo "<div style='border-radius: 15px;font-size:30px;height:80px;background:#A5360B;color:#ffffff;padding-top:20px;padding-left:50px;'>{$_charset['title']}</div>";
		echo "<div style='padding:80px; background:#C4FCA9;margin-top:10px;line-height:30px;border-radius: 15px 15px 0px 0px;'>";
		echo "<h2>{$_charset['error_ky']}</h2>";
	}
	echo "<b>{$_charset['error_info']}:</b>$error: {$_charset['error_no']}[$errno] $errstr<br />";
	$debug=debug_backtrace();
	echo '<div><ul>';
	foreach($debug as $key=>$value){
	
		echo "<li>{$_charset['file']}：{$value['file']} ".sprintf($_charset['lineno'],$value['line'])." {$value['function']}</li>";
	}
	echo '</ul></div>';
	if($kyphp_error_no_get==0){
		echo "<div id='kyphp_bottom_foot' style='position:absolute;width:100%;left:0px;bottom:0;height:100px;background:#A5360B;color:#ffffff;padding-top:20px;padding-left:50px;margin-top:30px;'><div style=''>power by ky53.net <a href=http://ky53.net/help>{$_charset['help']}</a></div>";
		echo "<div style=''>{$_charset['kyphp_web']}<a href=http://www.ky53.net>http:www.ky53.net</a></div>";
		echo "<div style=''>{$_charset['version']}E-mail:zhx626@126.com QQ:974005652 </div></div>";
		//echo '<div id="kyphp_out">222</div>';
		$KYPHP->runtime->stop();
		$time=(int)$KYPHP->runtime->spent();
		$time+=2000;
		echo <<<KYPHP
		<script type="text/javascript">
			setKyphpfoot();
			//setInterval('setKyphpfoot()',1000);
			setTimeout('setKyphpfoot()',$time);
			function setKyphpfoot(){
				//document.getElementById('kyphp_out').innerHTML='test';
				document.getElementById('kyphp_bottom_foot').style.top=(document.body.scrollHeight -50)+'px';
				
			}
		</script>

KYPHP;
		
		echo "<pre>";

		echo "</pre>";
		echo "</body></html>";
	}

}

set_error_handler("customError",E_ALL);



?>