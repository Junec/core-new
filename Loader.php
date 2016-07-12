<?php

class Core_Loader{

	static protected $instance;
	

	static public function autoload( $class ){
		$path = "";
		$classLen = strlen($class);

		if(substr($class, 0, 5) == 'Core_'){
			$path = CORE_PATH . "/" . str_replace("_", "/", substr($class, 5));

		}elseif(substr($class, $classLen - 10) == 'Controller'){
			$path = APP_PATH . "/controller/" . str_replace("_", "/", substr($class, 0, $classLen - 10));

		}elseif(substr($class, $classLen - 5) == 'Model'){
			$path = APP_PATH . "/controller/" . str_replace("_", "/", substr($class, 0, $classLen - 5));

		}elseif(substr($class, $classLen - 6) == 'Plugin'){
			$path = APP_PATH . "/controller/" . str_replace("_", "/", substr($class, 0, $classLen - 6));

		}else{
			$path = APP_PATH . "/library/" . str_replace("_", "/", $class);

		}

		$path .= ".php";
		include_once $path;
	}

	static public function getInstance( $class , $param = '' ){
        if( !isset(self::$instance[$class]) || self::$instance[$class] == '' ){
            self::$instance[$class] = new $class( $param );
        }
        return self::$instance[$class];
	}


}

?>