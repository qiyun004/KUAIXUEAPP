<?php
class IndexController extends Controller{
	public function __empty(){
		echo "__empty";
	}
	public function index(){
	
		/*$smarty = new Smarty();
		p($smarty);*/
		if(!$this->is_cached()){
			$this->assign('var',time());
		}
		
		$this->display();
	}
}
?>