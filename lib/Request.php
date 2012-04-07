<?php

class Request {
	public $controller;
	public $action;
	public $params;
	
	public function __construct($request){
		$splits = (array_key_exists('r', $request)) ? explode('/', trim($request['r'],'/')) : FALSE;
		if($splits){
			// Controller
			if(!empty($splits[0])){
				$this->controller = $splits[0];
				// Action
				if(!empty($splits[1])){
					$this->action = $splits[1];
					// Params
					if(!empty($splits[2])){
						//$this->_params = array_slice($this->request, 2);
						for($i=2,$cnt=count($splits);$i<$cnt;$i++){
							$key = $splits[$i];
							$i++;
							$this->params[$key] = $splits[$i];
						}
					}
				}
			}
		}
	}
	
	public function __get($requestKey){
		if(array_key_exists($requestKey, $this->request)){
			$param = $this->request[$requestKey];
		}
		else{
			$param = FALSE;
		}
		return $param;
	}
}
