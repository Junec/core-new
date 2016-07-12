<?php

class Core_Application{
	
	protected $config;

	public function __construct( $config ){
		$this->config = $config;
	}

	public function getConfig(){
		return Core_Loader::getInstance("Core_Config_Ini", $this->config );
	}

	public function bootstrap(){

		return $this;
	}

	public function run(){
		include_once "Loader.php";
		spl_autoload_register(array('Core_Loader','autoload'));
		Core_Registry::set("config", $this->getConfig() );

		$view = Core_Loader::getInstance("Core_View_Simple", $this->getConfig()->get("application.directory"));
		$view->content = "this is content!";
		$view->display("index/index.phtml");


	}

}

?>