<?php
class indexAction extends publicAction {
   
   public function _initialize(){
  
   }
   public function index(){
       $form=D("form");//快速实例化表
	  
	  $dblist=$form->order('id desc')->select();//快速获得数据
	 
	  $this->volist("list",$dblist);	
	  
	  
      $this->display();

   }
   public function view(){
   $form=D("form");//快速实例化表
	  
	  $dblist=$form->where('id='.$_GET['id'])->find();//快速获得单条数据
	 
	  $this->lable("vo",$dblist);	
	  
	  
      $this->display();
   }
  
}
?>