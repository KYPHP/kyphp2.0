<?php
class indexAction extends publicAction {
   
   public function _initialize(){
  
   }
   public function index(){
     
	  $form=D("form");
	  
	  $dblist=$form->select();
	 
	  $this->volist("list",$dblist);	
	  
	  
      $this->display();

   }
   public function change(){
  
   setcookie('default_tpl',$_GET['color']);
   $this->jump(__URL__);
   }
  
}
?>