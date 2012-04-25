<?php
require_once('Controller.php');

class CRUDController extends Controller{
	
	public function read($params){
		$this->variables['title'] = ucfirst($this->variables['tableName']);
		if(empty($params)){
			$result = $this->model->findAllOrderById();
		}
		else{
			$args = $this->condition($params);
			$result = $this->model->find($args['condition'], $args['params']);
		}
		$this->variables['result'] = $result;
		
		$view = $this->viewObject($this->variables);
		$view->render();
	}	// read
	public function update($params){
		if(empty($params)){
			throw new LibException('Не заданы параметры изменения');
		}
		else{
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				foreach($this->fields as $field){
					if($this->request->$field){
						$value = $this->request->$field;
						$assocArray[$field] = $value;
					}
					else{
						throw new LibException('Не задано поле: '.$field);
					}
				}
				$args = $this->condition($params);
				$result = $this->model->update($assocArray, $args['condition'], $args['params']);
				$this->location();
			}
			else{
				$args = $this->condition($params);
				$result = $this->model->find($args['condition'], $args['params']);
				$result[0]['postAction'] = $this->request->r;
				$this->variables['title'] = 'UpdateForm';
				$this->variables['result'] = $result[0];
				$view = $this->viewObject($this->variables);
				$view->update();
			}
		}
		
	}	// update
	public function create($params){
		$assocArray = $this->checkFields();
		$this->model->insert($assocArray);
		$this->location();
	}	// create
	public function delete($params){
		$args = $this->condition($params);
		$result = $this->model->delete($args['condition'], $args['params']);
		$this->location();
	}	// delete
	
	protected function viewObject($variables){
		$view = new View($variables);
		return $view;
	}
	protected function jsonOrHtml(){
		
	}
	
	protected function condition($params){
		$args['condition'] = '';
		$first = TRUE;
		foreach($params as $field=>$val){
			if(!$first){
				$args['condition'] .= ' AND ';
			}
			$args['condition'] .= $field.'=?';
			$args['params'][] = $val;
			$first = FALSE;
		}
		return $args;
	}
	protected function location(){
		header('Location: '.ROOT_URL);
	}
	protected function checkFields(){
		$assocArray = array();
		foreach($this->fields as $field){
			if($this->request->$field){
				$value = $this->request->$field;
				$assocArray[$field] = $value;
			}
			else{
				throw new LibException('Не задано поле: '.$field);
			}
		}
		return $assocArray;
	}
}
