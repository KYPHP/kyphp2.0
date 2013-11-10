<?php

class testModel extends Model {
   
  
   public function form(){
       $form=D("form");//快速实例化表
	  
	  $dblist=$form->order('id desc')->select();//快速获得数据
	 
	  return $dblist;

   }
   public function view(){
       $form=D("form");//快速实例化表
	  
	  $dblist=$form->where('id='.$_GET[id])->find();//快速获得单条数据
	 
	  return $dblist;

   }
   public function sortdata(){
    $form=D("sort");//快速实例化表
	  
	  $dblist=$form->select();//快速获得单条数据
	 
	  return $dblist;
   }
  
  
}
?>