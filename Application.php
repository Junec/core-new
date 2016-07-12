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
		
		#$rs = $this->getConfig()->get("application.name");
		$rs = $this->getConfig();
		print_r( $rs );

	}

}

?>