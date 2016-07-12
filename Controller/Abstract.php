<?php

class Core_Controller_Abstract{
	
	protected $request;
	protected $response;


	public function display($tpl = ''){

	}

	public function getView(){
		return Core_Loader::getInstance("Core_View_Simple", $this->getConfig()->get("application.directory"));
	}
}

?>