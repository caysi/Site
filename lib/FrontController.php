<?php

class FrontController{
	protected $tf;
	protected $pathTo;
	protected $default;
	
	public function __construct($tf, $pathTo, $default){
		$this->tf = $tf;
		$this->pathTo = $pathTo;
		$this->default = $default;
	}
	
	public function dispatch($request){
		if(!empty($request->controller)){
			$tableName = $request->controller;
		}
		else{
			$tableName = $this->default['controller'];
		}
		$contName = ucfirst($tableName);
		$contName .= 'Controller'; 					// const
		
		require_once($this->pathTo['controllers'].$contName.'.php');
		$controller = new $contName($this->tf, $tableName, $request, $this->pathTo['views']);
		
		if(!empty($request->action)){
			$action = $request->action;
		}
		else{
			$action = $this->default['action'];
		}
		$controller->$action($request->params);
	}
}
