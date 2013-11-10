<?php 
class ControllerInfoView extends ControllerPublicPublic  { 
	public function index() {
	
		$this->model('blog/data');
		
		$info=$this->M['blog/data']->getInfo(isset($this->request->get['id'])?$this->request->get['id']:0);
		$this->data['info_title']=$info['title'];
		$this->data['content']=$info['content'];
		$this->data['header']=$this->view('public/header');
		$this->data['footer']=$this->view('public/footer');
		$this->data['right']=$this->view('public/right');//调用右边的controller
		$this->data['bloginfo']=$this->blog;//继承自自定义类blog
		$this->data['bloginfo2']=$this->custom('custom')->blog;//调用自定义类
		$this->display('info/view.html');	//可指定模板，模认为当前controll的名字+方法	
  	}
}
?>
