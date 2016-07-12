<?php

class Core_Config_Ini extends Core_Config_Abstract{

	protected $config;
	
	public function __construct( $config ){
		$this->config = $this->parseIniFile( $config );

	}

	protected function parseIniFile( $config ){
		$result = array();
		$configArray = parse_ini_file( $config );

		foreach($configArray as $key => $val){
			$ks = explode(".",$key);

			$kresult = array();
			foreach($ks as $ksval){
				$kresult[ $ksval ] = array();

			}
			$result[] = $kresult;
			print_r($kresult);
		}

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