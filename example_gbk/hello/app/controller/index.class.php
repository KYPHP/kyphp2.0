<?php
class indexAction extends Action {
	public function index(){
	
	echo "hello";
	echo $this->config->get('title');
	
	}
}
?>