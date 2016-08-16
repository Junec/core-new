<?php

class Core_Application{
	
	protected $config;

	public function __construct( $config ){
		$this->config = $config;
	}

	public function getConfig(){
		return Core_Loader::getInstance("Core_Config", $this->config );
	}

	public function init(){
		include_once "Loader.php";
		spl_autoload_register(array('Core_Loader','autoload'));
		Core_Registry::set("config", $this->getConfig() );
	}

	public function run(){
		$this->init();
		Core_Loader::getInstance("Core_Dispatcher")->dispatch();
	}
}

?>