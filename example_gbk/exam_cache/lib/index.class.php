<?php
class indexAction extends publicAction {
   
   public function _initialize(){
  
   }
   public function index(){
     
	  $form=D("form");
	  
	  $dblist=$form->select();
	 
	  $this->volist("list",$dblist);
	  var_dump($this->cache->get('list'));
	  $this->cache->set('list',$dblist);
	  //var_dump($this->cache->get('list'));
	  
      $this->display();

   }
   public function change(){
  
   setcookie('default_tpl',$_GET['color']);
   $this->jump(__URL__);
   }
  
}
?>