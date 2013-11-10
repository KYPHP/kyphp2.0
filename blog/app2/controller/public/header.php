<?php 
class ControllerPublicHeader  extends  Controller{ 
	public function index() {
		$this->data['http']=__WEBURL__;
		$this->assign('sitename','blog example');//在字符串情况下$this->data,$this->lable,$this->assign等效		
		$this->language('blog/data');
		$this->data['test']='this is head var test';
		$sitename=$this->language->get('sitename');
		$this->lable('title',$sitename);		
		$this->data['sitetitle']='BLOG -KYPHP';
		$this->render('public/header.html');	//可指定模板，模认为当前controll的名字+方法	
  	}
}
?>
