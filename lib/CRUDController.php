<?php
require_once('Controller.php');

class CRUDController extends Controller{
	
	public function create($params){
		$assocArray = $this->checkField();
		$this->model->insert($assocArray);
		$this->location();
	}
	public function read($params){
		$title = ucfirst($this->tableName);
		
		if(empty($params)){
			$result = $this->model->findAllOrderById();
		}
		else{
			$args = $this->condition($params);
			$result = $this->model->find($args['condition'], $args['params']);
		}
		
		$view = new View($this->tableName, $this->pathView);
		$view->render($result, $title, $variables);
	}
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
				
			}
		}
		
	}
	public function delete($params){
		$args = $this->condition($params);
		$result = $this->model->delete($args['condition'], $args['params']);
		$this->location();
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
	protected function checkField(){
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
