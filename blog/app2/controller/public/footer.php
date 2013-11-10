<?php 
class ControllerPublicFooter  extends  Controller{ 
	public function index() {
		
		$this->render('public/footer.html');	//可指定模板，模认为当前controll的名字+方法	
  	}
}
?>
