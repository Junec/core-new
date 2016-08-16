<?php

class Core_Router{
	protected $router_tag = 'router';
	protected $controller_tag = 'ctl';
	protected $action_tag = 'act';

	protected $router;
	protected $controller;
	protected $action;

	public function __construct(){
		$this->analysis();
	}

	public function analysis(){
		$routerInfo = array();
		$routers = Core_Registry::get("config")->router;
		$request = Core_Loader::getInstance("Core_Request_Abstract");
		$params = $request->gets();
		unset($params[ $this->router_tag ]);
		$pathInfo = $request->get( $this->router_tag );

        if( isset($routers[ $pathInfo ]) ){
        	/* 普通路由 */
            $routerInfo = $routers[ $pathInfo ];
        }else{
            /* 泛路由 */
            foreach($routers as $routerName => $routerValue){
                if( preg_match("/^\/\^?/", $routerName) ){
                    if( preg_match($routerName,$pathInfo) ){
                        foreach($routerValue as $rik=>$riv){
                            $routerValue[$rik] = preg_replace($routerName, $riv, $pathInfo);
                        }
                        if( isset($routerValue["params"]) && !empty($routerValue["params"]) ){
                        	$routerValueParams = $this->getParseStr($routerValue["params"]);
                        	foreach($routerValueParams as $rpk => $rpv){
                        		$routerValue[$rpk] = $rpv;
                        	}
                        	unset( $routerValue["params"] );
                        }
                        $routerInfo = array_merge($routerValue ,$params);
                        break;
                    }
                }
            }
        }

        if( $routerInfo ){
	        $this->router = $pathInfo;
	        $this->controller = $routerInfo[ $this->controller_tag ];
	        $this->action = $routerInfo[ $this->action_tag ];
	        foreach($routerInfo as $k => $v){
	        	$request->setGet($k,$v);
	        }
	    }
	}

	public function getController(){
		return $this->controller;
	}

	public function getAction(){
		return $this->action;
	}

	protected function getParseStr($paramsStr = ''){
        $result = array();
        parse_str($paramsStr,$result);
        if(is_array($result) && $result){
            foreach($result as $k=>$v){
                if($v == '') unset($result[$k]);
            }
        }
        return $result;
    }
}

?>