<?php

class View{
	
	public function __construct($variables){
		foreach($variables as $key=>$val){
			$this->$key = $val;
		}
	}
	
	public function render(){
		ob_start();
		$contentFile = ucfirst($this->tableName);
		$contentFile .= 'View.php';
		
		require_once($this->pathView.$contentFile);
		$content = ob_get_contents();
		ob_end_clean();
		
		require_once($this->pathView.'MainView.php');
	}
	public function update(){
		ob_start();
		$contentFile = ucfirst($this->tableName);
		$contentFile .= 'FormView.php';
		require_once($this->pathView.$contentFile);
		$content = ob_get_contents();
		ob_end_clean();
		
		require_once($this->pathView.'MainView.php');
		
	}
	public function json(){
		echo json_encode($this->result);
	}
}
