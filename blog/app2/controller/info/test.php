<?php 
class ControllerInfoTest extends Controller { 
	public function index() {
		$this->data['http']=__WEBURL__;
		$this->assign('sitename','blog example');//在字符串情况下$this->data,$this->lable,$this->assign等效
		$this->data['list']=array();
		$this->data['head_list']=array();
		$this->model('blog/data');
		$test=$this->M['blog/data']->test();
		
		$this->language('blog/data');
		$sitename=$this->language->get('sitename');
		$this->lable('title',$sitename);
		$this->data['test']=$test;//在模板中$this->data的健值即为变量名
		$this->data['header']=$this->view('public/header');
		$this->data['footer']=$this->view('public/footer');
		$this->data['right']=$this->view('public/right');//调用右边的controller

		$this->display('info/test/info.html');	//可指定模板，模认为当前controll的名字+方法	
  	}
	public function view(){
	
		echo "test";
	}
}
?>
