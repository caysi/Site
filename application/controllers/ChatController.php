<?php

class ChatController extends CRUDController{
	protected $fields = array('user', 'text');
	
	public function read($params){
		if(empty($params['lastId'])){
			$result = $this->model->findAllOrderById();
			$action = 'render';
		}
		else{
			$result = $this->model->find('id>?', $params['lastId']);
			$action = 'json';
		}
		$this->variables['result'] = $result;
		
		$view = $this->viewObject($this->variables);
		$view->$action();
	}	// read
	public function create($params){
		$assocArray = $this->checkFields();
		$this->model->insert($assocArray);
	}	// create
}
