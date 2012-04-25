<?php

abstract class Controller{

	protected $model;
	//protected $tableName;
	protected $request;
	//protected $pathView;
	protected $content = array();		// 
	protected $variables = array();
	protected $json;
	

	public function __construct($tf, $tableName, $request, $pathView){
		$this->model = $tf->$tableName;
		$this->variables['tableName'] = $tableName;
		$this->variables['pathView'] = $pathView;
		$this->request = $request;
	}
}
