<?php

class cmdAction extends Action {
 
  public function _initialize(){
   
   
   }
    public function index(){
   
    $from=D( $this->form);
	$fromarr=$from->order("id desc")->select();
    $this->datalist("form",$fromarr);
	
	$this->display();

   }
   
   public function add(){ 	
	   
      $this->display();

   }
    public function del(){
     $form=D( $this->form);
     $form->where('id='.$_GET[id])->delete();
     $this->jump(__URL__.'/index');
   }
    public function addok(){
      $form=D( $this->form);
	 /*
	  $form->field[title]=$_POST[title];
	  $form->field[content]=$_POST[content];
	  $form->field[f_date]=date('Y-m-d H:m:s');
	  $form->field[sortid]=$_POST[sortid];
	  $form->field[ischeck]=$_POST[ischeck];
	  $form->add();
	*/
	 
	  $form->addAll();
	  
      $this->error('添加成功！',__URL__.'/index');

   }
   public function editok(){
      $form=D(  $this->form);
	//sava方法对每个字段操作获取更新
	/*
	  $form->field[title]=$_POST[title];
	  $form->field[content]=$_POST[content];
	  $form->field[f_date]=date('Y-m-d H:m:s');
	  $form->field[sortid]=$_POST[sortid];
	  $form->field[ischeck]=$_POST[ischeck];
	  if(!$_POST[ischeck])$form->field[ischeck]=0;
	  $form->where('id='.$_POST[id])->save();
	  */
	//savaAll方法一次性智能填充表单，获取表单对应的更新
	
	  
	  $form->where('id='.$_POST['id'])->saveAll();
	
      $this->error('修改成功！',__URL__.'/index');

   }
    public function edit(){
	 
	  $from=D(  $this->form);
	  $fromarr=$from->where('id='.$_GET['id'])->find();

      $this->lable("form",$fromarr);
	  $this->display();
	}
  
}
?>