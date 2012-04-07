<?php

class PostsController extends CRUDController{
	protected $fields = array('Theme', 'Text', 'UserId');
	
	public function create($request){
		
		$assocArray = array();
		foreach($this->fields as $field){
			if(empty($request->$field)){
				throw new LibException('Не задано поле: '.$field);
			}
			else{
				$value = $request->$field;
				$assocArray[$field] = $value;
			}
		}
		$model->insert($assocArray);
	}
	
	public function update(){
		
	}
}
