<?php
class aticleAction extends publicAction {
   
   public function _initialize(){
   //echo "111";
   }
   public function index(){
    $from=D('form');
	if(!empty($_POST['key']))$from->where("title like '%$_POST[key]%'");
	if(!empty($_GET['key']))$from->where("title like '%$_GET[key]%'");
	$fromarr=$from->order("id desc")->select();
    $this->datalist("aticle",$fromarr);
	$page="111";
	 $this->lable('page',$page); 
      $this->display();

   }
   public function view(){
   $form=D("form");//快速实例化表
	  
	  $dblist=$form->where('id='.$_GET['id'])->find();//快速获得单条数据
	 
	  $this->lable("vo",$dblist);	
	  
	  
      $this->display();
   }
   public function add(){
    $sort=D('sort');
	  $sortarr=$sort->select();
	
	    $this->volist("sort",$sortarr);
      $this->display();

   }
    public function del(){
     $form=D('form');
     $form->where('id='.$_GET['id'])->delete();
     $this->jump(__URL__.'/index');
   }
    public function addok(){
      $form=D('form');
	 /*
	  $form->field[title]=$_POST[title];
	  $form->field[content]=$_POST[content];
	  $form->field[f_date]=date('Y-m-d H:m:s');
	  $form->field[sortid]=$_POST[sortid];
	  $form->field[ischeck]=$_POST[ischeck];
	  $form->add();
	*/
	  $form->field['f_date']=date('Y-m-d H:m:s');
	  $form->addAll();
	  
      $this->error('添加成功！',__URL__.'/index');

   }
   public function editok(){
      $form=D('form');
	//sava方法对每个字段操作获取更新
	  $form->field['title']=$_POST['title'];
	  $form->field['content']=$_POST['content'];
	  $form->field['f_date']=date('Y-m-d H:m:s');
	  $form->field['sortid']=$_POST['sortid'];
	  $form->field['ischeck']=isset($_POST['ischeck'])?$_POST['ischeck']:0;
	 
	  $form->where('id='.$_POST['id'])->save();
	//savaAll方法一次性智能填充表单，获取表单对应的更新
	/*
	  if(!$_POST['ischeck'])$form->field['ischeck']=0;
	  $form->where('id='.$_POST[id])->saveAll();
	  */
      $this->error('修改成功！',__URL__.'/index');

   }
    public function edit(){
	  $sort=D('sort');
	  $sortarr=$sort->select();
	
	  $this->volist("sort",$sortarr);
	  $from=D('form');
	  $fromarr=$from->where('id='.$_GET['id'])->find();

      $this->lable("aticle",$fromarr);
	  $this->display();
	}
	
}
?>