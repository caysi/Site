<?php

class Request {
	private $request;
	public $_controller;
	public $_action;
	public $_params;
	
	public function __construct($request){
		$this->request = $request;
		if(!empty($_REQUEST['r'])){
			$this->request = explode('/', trim($_REQUEST['r'],'/'));
			// Controller
			if(!empty($this->request[0])){
				$this->_controller = $this->request[0];
				// Action
				if(!empty($this->request[1])){
					$this->_action = $this->request[1];
					// Params
					if(!empty($this->request[2])){
						//$this->_params = array_slice($this->request, 2);
						for($i=2,$cnt=count($this->request);$i<$cnt;$i++){
							$key = $this->request[$i];
							$i++;
							$this->_params[$key] = $this->request[$i];
						}
					}
				}
			}
		}
		//else{
		//	$this->_controller = 'posts';	// перенисти
		//	$this->_action = 'get';			// перенисти
		//}
	}
}
