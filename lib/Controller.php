<?php

abstract class Controller{

	protected $model;
	protected $tableName;
	protected $request;
	protected $pathView;
	protected $content = array();
	

	public function __construct($tf, $tableName, $request, $pathView){
		$this->model = $tf->$tableName;
		$this->tableName = $tableName;
		$this->request = $request;
		$this->pathView = $pathView;
	}
}
