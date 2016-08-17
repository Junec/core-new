<?php

class Core_Controller_Abstract{
	
	protected $request;

	public function exec($action){
		if( method_exists($this, $action) ){
			$this->$action();
		}else{
			$controller = get_class($this);
			trigger_error("Action: \"{$controller}::{$action}()\" not found!", E_USER_ERROR);
		}
	}

	public function getView(){
		return Core_Loader::getInstance("Core_View_Simple");
	}

	public function getRequest(){
		return Core_Loader::getInstance("Core_Request_Abstract");
	}

}

?>