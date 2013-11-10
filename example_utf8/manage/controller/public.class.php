<?php

class publicAction extends Action {
 
  public function _initialize(){
   $this->form='user';
   
   }
   public function login(){
   $this->display();
   }
   public function index(){
   if(empty($_COOKIE['username']))$this->jump(__APP__.'index');
    
	
	$this->display();

   }
  
   public function verify(){
	   
      echo verify('ver');
	  //verify(验证的控件name名)
	  
	}
   public function logincheck(){  
    $user=D('user');
	if(!$_POST){
		$this->error('请您认真填写！','');
		return;
	}
	$userarr=$user->where("username='admin'")->order("id desc")->limit('0,10')->select();
	$userarr1=$user->where("username='".$_POST['username']."'")->find();
	
	 if($_POST['password']==''||$_POST['username']==''||$_POST['ver']==''){
	    $this->error('请您认真填写！','');
	 }
    
     if($_COOKIE['ver']!=$_POST['ver']){
        $this->error('验证码输入错误！','');
     }
	
	 if(key_hash($_POST['password'])==$userarr1['password']){
	     setcookie('username',$_POST['username']);
	    $this->error('登陆成功！',__APP__.'/index');
	 }else{
	    $this->error('密码错误！');
	 }
   }
	
	public function center(){
      $this->display();

   }
    public function head(){
     $this->lable('menu','管理中心');
      $this->display();

   }
    public function left(){
	global $conf;
	$username=isset($_COOKIE['username'])?$_COOKIE['username']:'';
      $this->lable('username',$username);
	  if($conf['super_user']==$username){
	     setcookie('key','0');
	     $this->lable('key','管理员');
	  }
      $this->display();

   }
    public function left2(){
	global $conf;
	$username=isset($_COOKIE['username'])?$_COOKIE['username']:'';
      $this->lable('username',$username);
	  if($conf['super_user']==$username){
	     
	     $this->lable('key','管理员');
	   }
      $this->display();

   }
	public function loginout(){
	 setcookie('username','0');
	 $this->error('退出成功！',__APP__.'/');
	}
}
?>