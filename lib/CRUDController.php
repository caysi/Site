<?php
require_once('Controller.php');

class CRUDController extends Controller{
	
	public function create($request){
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
		$this->model->insert($assocArray);
		header('Location: '.ROOT_URL);
	}
	public function read($params){			// dublication
		$title = ucfirst($this->tableName);
		if(empty($params)){
			$result = $this->model->findAllOrderById();
		}
		else{
			if(count($params) == 1 && !empty($params['id'])){
				$result = $this->model->findById($params['id']);
			}
			else{
				$first = TRUE;
				$condition = '';
				foreach($params as $field=>$val){
					if(!$first){
						$condition .= ' AND ';
					}
					$condition .= $field.'=?';
					$params[] = $val;
					$first = FALSE;
				}
				$result = $this->model->find($condition, $params);
			}
		}
		
		$view = new View($this->tableName, $this->pathView);
		$view->render($result, $title);
	}
	public function update($params){
		
	}
	public function delete($params){		// dublication
		if(empty($params)){
			throw new LibException('Не заданы параметры удаления');
		}
		else{
			if(count($params) == 1 && !empty($params['id'])){
				$result = $this->model->deleteById($params['id']);
			}
			else{
				$first = TRUE;
				$condition = '';
				foreach($params as $field=>$val){
					if(!$first){
						$condition .= ' AND ';
					}
					$condition .= $field.'=?';
					$params[] = $val;
					$first = FALSE;
				}
				$result = $this->model->delete($condition, $params);
			}
			header('Location: '.ROOT_URL);
		}
	}
}
