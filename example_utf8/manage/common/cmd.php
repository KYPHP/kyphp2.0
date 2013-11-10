<?php
function getsh($name='0'){
  
   if($name=='1'){
     $str='ÊÇ';
   }else{
     $str='·ñ';
   }
   return $str;
}
function checklogin(){
	global $KYPHP;
	
   if(!$KYPHP->config->get('login_page')){$login_page='public/login';}else{$login_page=$KYPHP->config->get('login_page');}
   $username=isset($_COOKIE['username'])?$_COOKIE['username']:'';
   $k=isset($_GET['k'])?$_GET['k']:'';
   if(!$username&&!strstr($k,$login_page)&&!strstr($k,'public/verify'))echo "<script>window.location.href='".__APP__."/$login_page';</script>";
}
checklogin();
?>