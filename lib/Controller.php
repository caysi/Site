<?php

abstract class Controller{

	protected $tf;
	protected $pathView;
	protected $content = array();
	protected $request;
	const DEFAULT_ACTION = 'findAllOrderById'; // index

	public function __construct($tf, $request, $pathView){
		$this->tf = $tf;
		$this->request = $request;
		$this->pathView = $pathView;
	}
	public function add(){
		
	}
	public function get(){
		if()
	}
	public function set(){
		
	}
	public function del(){
		
	}
	/*protected function getModel(){
		return $this->model;
	}

	protected function redirect($url){
		header('location:' . $url);
	}*/

}
