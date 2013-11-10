<?php 
class ControllerHomeIndex extends Controller { 
	public function index() {
		$this->data['http']=__WEBURL__;
		$this->assign('sitename','blog example');//在字符串情况下$this->data,$this->lable,$this->assign等效
		$this->data['form_list']=array();
		$this->data['head_list']=array();
		$this->model('blog/data');
		$test=$this->M['blog/data']->test();
		$page=isset($this->request->get['page'])?$this->request->get['page']:1;
		$count=3;
		$data=array(
			'limit'=>($page-1)*$count.','.$count,	
		);
		$this->data['form_list']=$this->M['blog/data']->getFormList($data);
		$total=$this->M['blog/data']->getFormTotal();
		$pagination = new Pagination();
		$pagination->total = $total;
		$pagination->page = $page;				 
		$pagination->limit = $count;
		$pagination->text = "从 {start} 起到 {end} 页 总 {total}个 总 ({pages} 页)";
		$pagination->url = $this->url->link('home/index', '&page={page}');
		$this->data['pagination'] = $pagination->render();
		$this->language('blog/data');
		$sitename=$this->language->get('sitename');
		$this->lable('title',$sitename);
		$this->data['test']=$test;//在模板中$this->data的健值即为变量名
		$this->data['header']=$this->view('public/header');
		$this->data['footer']=$this->view('public/footer');
		$this->data['right']=$this->view('public/right');//调用右边的controller
		

		$this->display();	//可指定模板，模认为当前controll的名字+方法	
  	}
}
?>
