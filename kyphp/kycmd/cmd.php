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
 * @version  1.0
 +------------------------------------------------------------------------------
 */
function key_hash($str,$m='khash'){
if($m=='khash')$str=substr(md5(md5($str)),0,16).substr(md5($str),16,32);
if($m=='md5')$str=md5($str);
return $str;
}
function _pvolist($name,$nid,$id,$content){
global $volist,$lable,$list;

if($list[$name][$nid]){
 foreach($list[$name][$nid] as $key=>$k){
    
	
	if(!strstr($content,$id.'.')){ 	
	  $content1.=preg_replace("/[{][$](\w+)[}]/eis",'$k[\\1]',$content);
     }else{
	 //echo $id;
	  $content1.=preg_replace("/[{][$]$id\.(\w+)[}]/eis",'$k[\\1]',$content);
     } 
   }
  }
return $content1;
}
function _if($value1,$condition,$value2,$result){

if($condition=="=="){
  if($value1==$value2)return $result;
  }
  if($condition=="<"){
  if($value1<$value2)return $result;
  }
  if($condition=="<="){
  if($value1<=$value2)return $result;
  }
  if($condition==">"){
  if($value1>$value2)return $result;
  }
  if($condition==">="){
  if($value1>=$value2)return $result;
  }
  
}
function _volist($name,$id,$content){
global $volist,$lable,$list,$$id;
$content1='';
  foreach($volist[$name] as $key=>$k){
    $$id=$k;
	
	
	  $content2=preg_replace("/[{][$](\w+)[}]/eis",'$k[\'\\1\']',$content);
      
	  $content1.=preg_replace("/[{][$]$id\.(\w+)[}]/eis",'$k[\'\\1\']',$content2);
    
	 
  }
  
  $content1=preg_replace("/<list\s+name=[\\\][\"|\'|](\w+)\[(.*?)\][\\\][\"|\'|]\s+id=[\\\][\"|\'|](\w+)[\\\][\"|\'|]>(.*?)<\/list>/eis","_pvolist('\\1','\\2','\\3','\\4')",$content1);
  $content1=str_replace('\"','"',$content1);
  
return $content1;

}
function include_file($file){

	return require_once($file);
}
function label($key,$key0=''){
	global $lable;
	
	if($key0&&isset($lable[$key][$key0]))return $lable[$key][$key0];
	if(isset($lable[$key]))return $lable[$key];
}
function make_html($content,$path){
global $lable,$list,$KYPHP,$volist,$datalist;
	$templetedir=DEFAULT_TPL_PATH.'/'.DEFAULT_TPL;
	$templetedir=str_replace('\\','/',$templetedir);
  $content=preg_replace("/<include\s+file=\"(\w+):(\w+)\">/eis",'include_file("'.$templetedir.'/\\1/\\2.htm")',$content);
     
     $content=str_replace('__URL__',__URL__,$content);
	 $content=str_replace('__ROOT__',__ROOT__,$content);
     $content=str_replace('__APP__',__APP__,$content);
	if(defined('__WEBURL__'))$content=str_replace('__WEBURL__',__WEBURL__,$content);

	 $content=str_replace('{$','{--|',$content);
     $content=preg_replace("/\{\-\-\|([\w\d\_\-]+)\;\}/eis",'label(\'\\1\')',$content);
	  $content=str_replace('{--|','{$',$content);
     $content=preg_replace("/<lable[ \f\r\t\n]+name=(\"|\'|)(\w+)(\"|\'|)>/eis",'label(\'\\2\')',$content);
	 $content=preg_replace('/\$lable\[(\"|\'|)(\w+)(\"|\'|)\]\[(\"|\'|)(\w+)(\"|\'|)\]/eis','label(\'\\2\',\'\\5\')',$content);
	 $content=preg_replace('/\$lable\[(\"|\'|)(\w+)(\"|\'|)\]/eis','label(\'\\2\')',$content);	
	 $content=preg_replace('/\$volist\[(\"|\'|)(\w+)(\"|\'|)\]/eis','$volist[\'\\2\']',$content);
	 $content=preg_replace("/<volist\s+name=(\"|\'|)(\w+)(\"|\'|)\s+id=(\"|\'|)(\w+)(\"|\'|)>(.*?)<\/volist>/eis","_volist('\\2','\\5','\\7')",$content);
	 $content=preg_replace("/<if\s+condition=[(](\w+)(==|<|>|>=|<=)(\w+)[)]>(\w+)<\/if>/eis","_if('\\1','\\2','\\3','\\4')",$content);
	 $content=preg_replace("/<datalist\s+name=(\"|\'|)(\w+|)(\"|\'|)\s+id=(\"|\'|)(\w+|)(\"|\'|)\s+row=(\"|\'|)(\w+|)(\"|\'|)\s+field=(\"|\')(.*?)(\"|\')\s+manage=(\"|\')(.*?)(\"|\')\s+edit=(\"|\'|)(\w+|)(\"|\'|)\s+title=(\"|\'|)(\w+|)(\"|\'|)\s+page=(\"|\'|)(\w+|)(\"|\'|)\s+table=(\"|\')(.*?)(\"|\')\s+list=(\"|\')(\w+|)(\"|\')(\s+|)>/eis","_datalist('\\2','\\5','\\8','\\11','\\14','\\17','\\20','\\23','\\26','\\29')",$content);
	
	 if(strstr($content,'row=')&&strstr($content,'field=')&&strstr($content,'manage=')&&strstr($content,'edit=')&&strstr($content,'title=')&&strstr($content,'page=')&&strstr($content,'table=')&&!strstr($content,'list='))$content=preg_replace("/<datalist\s+name=(\"|\'|)(\w+|)(\"|\'|)\s+id=(\"|\'|)(\w+|)(\"|\'|)\s+row=(\"|\'|)(\w+|)(\"|\'|)\s+field=(\"|\'|)(.*?)(\"|\'|)\s+manage=(\"|\'|)(.*?)(\"|\'|)\s+edit=(\"|\'|)(\w+|)(\"|\'|)\s+title=(\"|\'|)(\w+|)(\"|\'|)\s+page=(\"|\'|)(\w+|)(\"|\'|)\s+table=(\"|\')(.*?)(\"|\')(\s+|)>/eis","_datalist('\\2','\\5','\\8','\\11','\\14','\\17','\\20','\\23','\\26')",$content);
	  if(strstr($content,'row=')&&strstr($content,'field=')&&strstr($content,'manage=')&&strstr($content,'edit=')&&strstr($content,'title=')&&strstr($content,'page=')&&!strstr($content,'list=')&&!strstr($content,'table='))$content=preg_replace("/<datalist\s+name=(\"|\'|)(\w+|)(\"|\'|)\s+id=(\"|\'|)(\w+|)(\"|\'|)\s+row=(\"|\'|)(\w+|)(\"|\'|)\s+field=(\"|\'|)(.*?)(\"|\'|)\s+manage=(\"|\'|)(.*?)(\"|\'|)\s+edit=(\"|\'|)(\w+|)(\"|\'|)\s+title=(\"|\'|)(\w+|)(\"|\'|)\s+page=(\"|\'|)(\w+|)(\"|\'|)(\s+|)>/eis","_datalist('\\2','\\5','\\8','\\11','\\14','\\17','\\20','\\23')",$content);
	if(strstr($content,'row=')&&strstr($content,'field=')&&strstr($content,'manage=')&&strstr($content,'edit=')&&strstr($content,'title=')&&!strstr($content,'list=')&&!strstr($content,'page=')&&!strstr($content,'table=')) $content=preg_replace("/<datalist\s+name=(\"|\'|)(\w+|)(\"|\'|)\s+id=(\"|\'|)(\w+|)(\"|\'|)\s+row=(\"|\'|)(\w+|)(\"|\'|)\s+field=(\"|\'|)(.*?)(\"|\'|)\s+manage=(\"|\'|)(.*?)(\"|\'|)\s+edit=(\"|\'|)(\w+|)(\"|\'|)\s+title=(\"|\'|)(\w+|)(\"|\'|)(\s+|)>/eis","_datalist('\\2','\\5','\\8','\\11','\\14','\\17','\\20')",$content);
	 
	 if(strstr($content,'row=')&&strstr($content,'field=')&&strstr($content,'manage=')&&strstr($content,'edit=')&&!strstr($content,'list=')&&!strstr($content,'page=')&&!strstr($content,'table=')&&!strstr($content,'title=')){$content=preg_replace("/<datalist\s+name=(\"|\'|)(\w+|)(\"|\'|)\s+id=(\"|\'|)(\w+|)(\"|\'|)\s+row=(\"|\'|)(\w+|)(\"|\'|)\s+field=(\"|\'|)(.*?)(\"|\'|)\s+manage=(\"|\'|)(.*?)(\"|\'|)\s+edit=(\"|\'|)(\w+|)(\"|\'|)(\s+|)>/eis","_datalist('\\2','\\5','\\8','\\11','\\14','\\17')",$content);}
	 if(strstr($content,'row=')&&strstr($content,'field=')&&strstr($content,'manage=')&&strstr($content,'list=')&&!strstr($content,'edit=')&&!strstr($content,'page=')&&!strstr($content,'table=')&&!strstr($content,'title=')){$content=preg_replace("/<datalist\s+name=(\"|\'|)(\w+|)(\"|\'|)\s+id=(\"|\'|)(\w+|)(\"|\'|)\s+row=(\"|\'|)(\w+|)(\"|\'|)\s+field=(\"|\'|)(.*?)(\"|\'|)\s+manage=(\"|\'|)(.*?)(\"|\'|)\s+list=(\"|\'|)(\w+|)(\"|\'|)(\s+|)>/eis","_datalist('\\2','\\5','\\8','\\11','\\14','false','true','false','','\\17')",$content);}
     if(strstr($content,'row=')&&strstr($content,'field=')&&strstr($content,'manage=')&&strstr($content,'table=')&&!strstr($content,'edit=')&&!strstr($content,'page=')&&!strstr($content,'list=')&&!strstr($content,'title=')){$content=preg_replace("/<datalist\s+name=(\"|\'|)(\w+|)(\"|\'|)\s+id=(\"|\'|)(\w+|)(\"|\'|)\s+row=(\"|\'|)(\w+|)(\"|\'|)\s+field=(\"|\'|)(.*?)(\"|\'|)\s+manage=(\"|\'|)(.*?)(\"|\'|)\s+table=(\"|\'|)(.*?|)(\"|\'|)(\s+|)>/eis","_datalist('\\2','\\5','\\8','\\11','\\14','false','true','false','\\17','table')",$content);}
	if(strstr($content,'row=')&&strstr($content,'field=')&&strstr($content,'manage=')&&strstr($content,'title=')&&!strstr($content,'edit=')&&!strstr($content,'page=')&&!strstr($content,'table=')&&!strstr($content,'list=')){$content=preg_replace("/<datalist\s+name=(\"|\'|)(\w+|)(\"|\'|)\s+id=(\"|\'|)(\w+|)(\"|\'|)\s+row=(\"|\'|)(\w+|)(\"|\'|)\s+field=(\"|\'|)(.*?)(\"|\'|)\s+manage=(\"|\'|)(.*?)(\"|\'|)\s+title=(\"|\'|)(\w+|)(\"|\'|)(\s+|)>/eis","_datalist('\\2','\\5','\\8','\\11','\\14','false','\\17','false','','table')",$content);}
	if(strstr($content,'row=')&&strstr($content,'field=')&&strstr($content,'manage=')&&strstr($content,'page=')&&!strstr($content,'edit=')&&!strstr($content,'title=')&&!strstr($content,'table=')&&!strstr($content,'list=')){$content=preg_replace("/<datalist\s+name=(\"|\'|)(\w+|)(\"|\'|)\s+id=(\"|\'|)(\w+|)(\"|\'|)\s+row=(\"|\'|)(\w+|)(\"|\'|)\s+field=(\"|\'|)(.*?)(\"|\'|)\s+manage=(\"|\'|)(.*?)(\"|\'|)\s+page=(\"|\'|)(\w+|)(\"|\'|)(\s+|)>/eis","_datalist('\\2','\\5','\\8','\\11','\\14','false','true','\\17','','table')",$content);}
	
	 if(strstr($content,'row=')&&strstr($content,'field=')&&strstr($content,'manage=')&&!strstr($content,'list=')&&!strstr($content,'page=')&&!strstr($content,'table=')&&!strstr($content,'title=')&&!strstr($content,'edit='))$content=preg_replace("/<datalist\s+name=(\"|\'|)(\w+|)(\"|\'|)\s+id=(\"|\'|)(\w+|)(\"|\'|)\s+row=(\"|\'|)(\w+|)(\"|\'|)\s+field=(\"|\'|)(.*?)(\"|\'|)\s+manage=(\"|\'|)(.*?)(\"|\'|)(\s+|)>/eis","_datalist('\\2','\\5','\\8','\\11','\\14')",$content);
	 if(strstr($content,'row=')&&strstr($content,'field=')&&!strstr($content,'list=')&&!strstr($content,'page=')&&!strstr($content,'table=')&&!strstr($content,'title=')&&!strstr($content,'edit=')&&!strstr($content,'manage=')) $content=preg_replace("/<datalist\s+name=(\"|\'|)(\w+|)(\"|\'|)\s+id=(\"|\'|)(\w+|)(\"|\'|)\s+row=(\"|\'|)(\w+|)(\"|\'|)\s+field=(\"|\'|)(.*?)(\"|\'|)(\s+|)>/eis","_datalist('\\2','\\5','\\8','\\11')",$content);
	 
	 if(preg_replace('/<datalist(.*?)>/eis','',$content)!=$content){
	 global $datafieldname;
	 if(strstr($content,'name='))preg_replace('/name=(\"|\'|)(\w+|)(\"|\'|)/eis','$name="\\2"',$content);
	 if(strstr($content,'id='))preg_replace('/id=(\"|\'|)(\w+|)(\"|\'|)/eis','$id="\\2"',$content);
	 if(strstr($content,'row='))preg_replace('/row=(\"|\'|)(\w+|)(\"|\'|)/eis','$row=\\2',$content);
	  if(strstr($content,'field=')){//preg_replace('/field=(\"|\')(.*?|)(\"|\')/eis','$field="\\2"',$content);
	  preg_replace('/field=(\"|\')(.*?|)(\"|\')/eis',"getfieldname('field','\\2')",$content);
	$field=$datafieldname['field'];
	
	 }
	
	 if(strstr($content,'manage=')){preg_replace('/manage=(\"|\')(.*?|)(\"|\')/eis',"getfieldname('manage','\\2')",$content);
	 $manage=$datafieldname['manage'];
	 }
	 if(strstr($content,'edit='))preg_replace('/edit=(\"|\'|)(\w+|)(\"|\'|)/eis','$edit="\\2"',$content);
	 if(strstr($content,'title='))preg_replace('/title=(\"|\'|)(\w+|)(\"|\'|)/eis','$title="\\2"',$content);
	 if(strstr($content,'page='))preg_replace('/page=(\"|\'|)(\w+|)(\"|\'|)/eis','$page="\\2"',$content);
	 if(strstr($content,'table='))preg_replace('/table=(\"|\')(.*?|)(\"|\')/eis','$table="\\2"',$content);
	 if(strstr($content,'list='))preg_replace('/list=(\"|\')(\w+|)(\"|\')/eis','$islist="\\2"',$content);
	$edit=isset($edit)?$edit:'';
	$title=isset($title)?$title:'';
	$page=isset($page)?$page:'';
	$table=isset($table)?$table:'';
	$list=isset($list)?$list:'';
	$name=isset($name)?$name:'';
	$id=isset($id)?$id:'';
	$row=isset($row)?$row:'';
	$field=isset($field)?$field:'';
	$manage=isset($manage)?$manage:'';
	$islist=isset($islist)?$islist:'';
	$table=isset($table)?$table:'';
	  $content=preg_replace('/<datalist(.*?)>/eis','_datalist($name,$id,$row,$field,$manage,$edit,$title,$page,$table,$islist)',$content);
	  $name='';$id='';$row='';$field='';$manage='';$edit='';$title='';$page='';$table='';$islist='';
	 }
     return $content;
	
  
}
function getfieldname($name,$str){
global $datafieldname;
$datafieldname[$name]=$str;
return $str;
}
function _datalist($name,$id,$row='',$field,$manage='',$edit='false',$title='true',$page='false',$table='',$islist='table'){
global $datalist;
   $fieldarr=explode(',',$field);
   $managearr=explode(',',$manage);
   
   $wname='';
   $str='<table '.$table.' class='.$name.' id='.$id.'>';
   $strli='<ul class='.$name.' id='.$id.'>';
   if($title=='true'){
   $str.='<tr class=title>';
   $strli.='<li class=title>';
   foreach($fieldarr as $key=>$kt){
   $vpos=strpos($kt,'|');
   $vname=substr($kt,0,$vpos);
   
   $tpos=strpos($kt,':');
   $wpos=strpos($kt,'%');
   if($wpos)$wname=substr($kt,$wpos+1);
    $wname=str_replace('=',':',$wname);
   if(!$tpos)$tpos=strlen($kt);
 
   $tname=substr($kt,$vpos+1,$tpos-$vpos-1);
    
   if(strstr($tname,'%')) $tname=substr($kt,$vpos+1,$wpos-$vpos-1);
   
   $str.='<td style="'.$wname.'">'.$tname.'</td>';
    $strli.='<span style="'.$wname.'">'.$tname.'</span>';
   $wname='';
   $vname='';
   $tname='';
   }
   if($manage){
    foreach($managearr as $key=>$kt){
   $vpos=strpos($kt,'|');
   $vname=substr($kt,0,$vpos);
   $tpos=strpos($kt,':');
   $wpos=strpos($kt,'%');
    if($wpos)$wname=substr($kt,$wpos+1);
	$wname=str_replace('=',':',$wname);
   if(!$tpos)$tpos=strlen($kt);
   $tname=substr($kt,$vpos+1,$tpos-$vpos-1);
  if(strstr($tname,'%')) $tname=substr($kt,$vpos+1,$wpos-$vpos-1);
   $str.='<td style="'.$wname.'">'.$tname.'</td>';
   $strli.='<span style="'.$wname.'">'.$tname.'</span>';
   $wname='';
   }
   }
   $str.='</tr>';
    $strli.='</li>';
   }
   $dataarr=$datalist[$name];
   $count=count($dataarr);
   
   if($row&&$row<count($dataarr)&&$row>0){
   if($page=='true'){
     $pagestr='<div class="page">';
	 $pa=ceil($count/$row);
	 $locpa=!empty($_GET['pa'])?$_GET['pa']:'';
	 if(!$locpa)$locpa=1;
	 
    $return=debug_backtrace();
    $funame=$return[4]['function'];
	$gstr='';
	if(!empty($_GET['key']))$gstr='/key/'.$_GET['key'];
	if(!empty($_POST['key']))$gstr='/key/'.$_POST['key'];
	
	if($locpa>$pa)$locpa=$pa;
	
	 $pagestr='<div class=page>共'.$pa.'页 当前'.$locpa.' 页 <a href='.__URL__.'/'.$funame.'/pa/1'.$gstr.'>首页</a> <a href='.__URL__.'/'.$funame.'/pa/'.($locpa-1).$gstr.'>上一页</a> <a href='.__URL__.'/'.$funame.'/pa/'.($locpa+1).$gstr.'>下一页</a> <a href='.__URL__.'/'.$funame.'/pa/'.$pa.$gstr.'>尾页</a>';
	 $pagestr.='</div>';
     }else{
	 $locpa=1;
	 } 
   unset($dataarr);
  
   $rowend=$row+($locpa-1)*$row;
   if($rowend>$count)$rowend=$count;
   for($i=($locpa-1)*$row;$i<$rowend;$i++){
  
   $dataarr[]=$datalist[$name][$i];
   }
   
   }
   foreach($dataarr as $key=>$k){
   $str.='<tr>';
    $strli.='<li>';
      foreach($fieldarr as $key=>$kt){
      $vpos=strpos($kt,'|');
      $vname=substr($kt,0,$vpos);
	  $tpos=strpos($kt,':');
	  $wpos=strpos($kt,'%');

	   if($wpos)$wname=substr($kt,$wpos+1);
	   $wname=str_replace('=',':',$wname);
	$jname='';
	 if($tpos)$jname=substr($kt,$tpos+1);
	  $jname=preg_replace('/[{][$](\w+)[}]/eis','$k[\'\\1\']',$jname);
	  if(strstr($jname,'%')) $jname=substr($kt,$tpos+1,$wpos-$tpos-1);
      $sname=isset($k[$vname])?$k[$vname]:'';
	  if(strstr($vname,'(')&&strstr($vname,')')){$sname=$vname;
	  
	  $sname=preg_replace('/[{][$](\w+)[}]/eis','$k[\'\\1\']',$sname);
	  
	  $sname=preg_replace('/(\w+)[(](.*?)[)]/eis','\\1(\\2)',$sname);
	   
	  }
	 
	 
	 
	 
	 
      $str.='<td style="'.$wname.'"><a href=# onclick="'.$jname.'">'.$sname.'</a></td>';
	  $strli.='<span style="'.$wname.'"><a href=# onclick="'.$jname.'">'.$sname.'</a></span>';
	   $wname='';
       $jname='';
	   $sname='';
	  }
	 if($manage){
       foreach($managearr as $key=>$kt){
      $vpos=strpos($kt,'|');
      $vname=substr($kt,0,$vpos);
	  $tpos=strpos($kt,':');
	   $wpos=strpos($kt,'%');
      if($wpos) $wname=substr($kt,$wpos+1);
	  $wname=str_replace('=',':',$wname);
      if(!$tpos)$tpos=strlen($kt);
      $tname=substr($kt,$vpos+1,$tpos-$vpos-1);
	   if(strstr($tname,'%')) $tname=substr($kt,$vpos+1,$wpos-$vpos-1);
	   

	  $vname=preg_replace('/[{][$](\w+)[}]/eis','$k[\'\\1\']',$vname);
	  if($tpos)$jname=substr($kt,$tpos+1);
	  	if(strstr($jname,'%')) $jname=substr($kt,$tpos+1,$wpos-$tpos-1);
	  $jname=preg_replace('/[{][$](\w+)[}]/eis','$k[\'\\1\']',$jname);
      $str.='<td style="'.$wname.'"><a href='.$vname.' onclick="'.$jname.'">'.$tname.'</a></td>';
	   $strli.='<span style="'.$wname.'"><a href='.$vname.' onclick="'.$jname.'">'.$tname.'</a></span>';
	   $wname='';
	   $jname='';
	   $tname='';
      }
   }
   $str.='</tr>';
   $strli.='</li>';
   }
   $strli.='</ul>';
   $str.='</table>';
   $pagestr=isset($pagestr)?$pagestr:'';
   $str.=$pagestr;
   $strli.=$pagestr;
    
	if($islist=='li')$str=$strli; 
return $str;
}
function dump($n){
   print_r($n);
}
function __autoload($class)   
{	
	$auto=array();
	$dirs=array();
	$custom=APP_PATH.'/custom';
	$dirs[]=$custom;
	$locdirs=array();
	if(!empty($_GET['k'])){
		$locdirs=explode('/',$_GET['k']);
		$dirs[]=$custom.'/'.$locdirs[0];
		$extdirs=readSubDir($custom.'/'.$locdirs[0]);
	}else{
		$extdirs=readSubDir($custom);
	}
	
	$dirs=array_merge($dirs,$extdirs);
	$dirs[]=KYPHP_PATH.'kyclass/kyphp_base';	
	foreach($dirs as $extdir){
			$file =$extdir.'/'.$class . '.php';
			if (is_file($file)) {   
				require_once($file);   
			}
	}
	
	
	KYPHP::autoload_APP($class,$locdirs);
	
}   
spl_autoload_register("__autoload");
require_once(KYPHP_PATH.'kyclass/kyphp_base/Action.php');
require_once(KYPHP_PATH.'kyclass/kyphp_base/Cache.php');
require_once(KYPHP_PATH.'kyclass/kyphp_base/Config.php');
require_once(KYPHP_PATH.'kyclass/kyphp_base/Cookie.php');
require_once(KYPHP_PATH.'kyclass/kyphp_base/DB.php');
require_once(KYPHP_PATH.'kyclass/kyphp_base/front.php');
require_once(KYPHP_PATH.'kyclass/kyphp_base/Image.php');
require_once(KYPHP_PATH.'kyclass/kyphp_base/Json.php');
require_once(KYPHP_PATH.'kyclass/kyphp_base/Language.php');
require_once(KYPHP_PATH.'kyclass/kyphp_base/Language.php');
require_once(KYPHP_PATH.'kyclass/kyphp_base/Log.php');
require_once(KYPHP_PATH.'kyclass/kyphp_base/Pagination.php');
require_once(KYPHP_PATH.'kyclass/kyphp_base/Request.php');
require_once(KYPHP_PATH.'kyclass/kyphp_base/Response.php');
require_once(KYPHP_PATH.'kyclass/kyphp_base/runtime.php');
require_once(KYPHP_PATH.'kyclass/kyphp_base/Session.php');
require_once(KYPHP_PATH.'kyclass/kyphp_base/templete.php');
require_once(KYPHP_PATH.'kyclass/kyphp_base/Url.php');
function readSubDir($path){
	$arr=array();
	 if(is_dir($path)){
		 $ext1=glob($path.'/*');
		 if($ext1){
			foreach($ext1 as $ext1dir){
				if(is_dir($ext1dir)){
					$arr[]=$ext1dir;
					$sub=readSubDir($ext1dir);
					$arr=array_merge($arr,$sub);
					}
			
			}
		 
		 
		 }
		
	 
	 
	 }

	return $arr;
}

function getfunname($fun){
$return=debug_backtrace();

    $file= $return[2]['function'];
	$clas= $return[2]['class'];
	
	if($fun=='2')return @$return[2]['object']->class;
	
	if($fun=='1')return $file;
	if($fun=='0')return $clas;
	if($fun=='')return $return;
}
function verify($cookname){
Header("Content-type: image/gif");
/*
* 初始化
*/
$border = 0; //是否要边框 1要:0不要
$how = 4; //验证码位数
$w = $how*15; //图片宽度
$h = 20; //图片高度
$fontsize = 5; //字体大小
$alpha = "abcdefghijkmnopqrstuvwxyz"; //验证码内容1:字母
$number = "023456789"; //验证码内容2:数字
$randcode = ""; //验证码字符串初始化
srand((double)microtime()*1000000); //初始化随机数种子

$im = ImageCreate($w, $h); //创建验证图片

/*
* 绘制基本框架
*/
$bgcolor = ImageColorAllocate($im, 255, 255, 255); //设置背景颜色
ImageFill($im, 0, 0, $bgcolor); //填充背景色
if($border)
{
    $black = ImageColorAllocate($im, 0, 0, 0); //设置边框颜色
    ImageRectangle($im, 0, 0, $w-1, $h-1, $black);//绘制边框
}

/*
* 逐位产生随机字符
*/
for($i=0; $i<$how; $i++)
{   
    $alpha_or_number = mt_rand(0, 1); //字母还是数字
    $str = $alpha_or_number ? $alpha : $number;
    $which = mt_rand(0, strlen($str)-1); //取哪个字符
    $code = substr($str, $which, 1); //取字符
    $j = !$i ? 4 : $j+15; //绘字符位置
    $color3 = ImageColorAllocate($im, mt_rand(0,100), mt_rand(0,100), mt_rand(0,100)); //字符随即颜色
    ImageChar($im, $fontsize, $j, 3, $code, $color3); //绘字符
    $randcode .= $code; //逐位加入验证码字符串
}

/*
* 添加干扰
*/
for($i=0; $i<5; $i++)//绘背景干扰线
{   
    $color1 = ImageColorAllocate($im, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255)); //干扰线颜色
    ImageArc($im, mt_rand(-5,$w), mt_rand(-5,$h), mt_rand(20,300), mt_rand(20,200), 55, 44, $color1); //干扰线
}   
for($i=0; $i<$how*40; $i++)//绘背景干扰点
{   
    $color2 = ImageColorAllocate($im, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255)); //干扰点颜色 
    ImageSetPixel($im, mt_rand(0,$w), mt_rand(0,$h), $color2); //干扰点
}

//把验证码字符串写入session

setcookie($cookname,$randcode);

/*绘图结束*/
Imagegif($im);
ImageDestroy($im);
/*绘图结束*/
}
function D($form,$db=null){
	global $KYPHP;
	
	if(!$db){
		$mysql=$KYPHP->db;
	}else{
		$mysql=$db;
	}
	
	$mysql->table=$form;
	$mysql->where='';
	$mysql->order='';
	$mysql->group='';
	$mysql->field='';
	$mysql->sql='';
	$mysql->limit='';	
	return $mysql;

}
function M($form,$db=null){
	global $KYPHP;
	if(!$db){
		$mysql=$KYPHP->db;
	}else{
		$mysql=$db;
	}

	$mysql->table=$form;
	$mysql->where='';
	$mysql->order='';
	$mysql->group='';
	$mysql->field='';	
	$mysql->sql='';
	$mysql->limit='';
	
	return $mysql;

}
function curl_file_get_contents($durl,$time=0.5){  

  $ch = curl_init();  

  curl_setopt($ch, CURLOPT_URL, $durl);  

  curl_setopt($ch, CURLOPT_TIMEOUT, $time);  

  curl_setopt($ch, CURLOPT_USERAGENT, _USERAGENT_);  

  curl_setopt($ch, CURLOPT_REFERER,_REFERER_);  

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  

  $r = curl_exec($ch);  

  curl_close($ch);  

  return $r;  

  } 
   function curl_get_url_status($url){
  $curl = curl_init(); 
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HEADER, 1); 
curl_setopt($curl,CURLOPT_NOBODY,true); 
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
$data = curl_exec($curl); 
$str= curl_getinfo($curl,CURLINFO_HTTP_CODE); 
curl_close($curl);
  
  return $str;
  
  }
function check_utf8($str) { 
    $len = strlen($str); 
    for($i = 0; $i < $len; $i++){ 
        $c = ord($str[$i]); 
        if ($c > 128) { 
            if (($c > 247)) return false; 
            elseif ($c > 239) $bytes = 4; 
            elseif ($c > 223) $bytes = 3; 
            elseif ($c > 191) $bytes = 2; 
            else return false; 
            if (($i + $bytes) > $len) return false; 
            while ($bytes > 1) { 
                $i++; 
                $b = ord($str[$i]); 
                if ($b < 128 || $b > 191) return false; 
                $bytes--; 
            } 
        } 
    } 
    return true; 
} // end of chec
function get_url_contents($url)
{
    //if (ini_get("allow_url_fopen") == "1")
      //  return file_get_contents($url);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_URL, $url);
    $result =  curl_exec($ch);
    curl_close($ch);

    return $result;
}

function is_utf8($liehuo_net){ 
if(preg_match("/^([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){1}/",$liehuo_net) == true || preg_match("/([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){1}$/",$liehuo_net) == true || preg_match("/([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){2,}/",$liehuo_net) == true) 
{ 
return true; 
} 
else 
{ 
return false; 
} 

}


?>