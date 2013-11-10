<?php
class userAction extends publicAction {
   
   public function _initialize(){
   
   $this->getform('user');
  
   }
   public function edit(){
   $this->display();
   }
   public function editok()
   {
   $form=D('user');
   $form->field['password']=key_hash($_POST['password']);
   $form->where("username='".$_POST['username']."'")->save();
   setcookie('username','');
   $this->error('修改成功！',__APP__.'/public');
   }
    
	
}
?>