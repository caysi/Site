<?php
// Не переделан
class FrontController{
	private $tf;
	private $pathController;
	
	public function __construct($tf, $pathController){
		$this->tf = $tf;
		$this->pathController = $pathController;
	}
	
	public function dispatch($request){ ////////////////////////////////////
		if(!empty($request->_controller)){
			$contName = ucfirst($request->_controller);
		}
		else{
			
		}
		$contName .= 'Controller';
		
		require_once(CONTROLLERS.$contName.'.php');
		
		$controller = new $contName($this->tf, $this->_action,$this->_params);
		$controller->build();
	}
	
	
	else{
			$this->_controller = 'post';
			$this->_action = 'get';
		}
}
