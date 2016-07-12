<?php

interface Core_View_Interface{
	
	public function assign( $name, $value );

	public function display( $tpls );

	public function fetch( $template );

	public function setTplPath( $path );
}

?>