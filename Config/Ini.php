<?php

class Core_Config_Ini extends Core_Config_Abstract{
	
	protected $config;
	
	public function __construct( $config ){
		$this->config = $this->parseIniFile( $config );

	}

	protected function parseIniFile( $config ){
		$result = parse_ini_file( $config );
		return $result;
	}

	public function __get( $var ){
		return $this->config[ $var ];
	}


	public function get( $key ){
		return $this->config[ $key ];
	}

}

?>