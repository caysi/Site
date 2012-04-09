<?php

class View{
	public $tableName;
	public $pathView;
	
	public function __construct($tableName,$pathView){
		$this->tableName = $tableName;
		$this->pathView = $pathView;
	}
	function render ($result, $title, $variables = NULL){
		if($variables){
			foreach($variables as $key=>$val){
				$$key = $val;
			}
		}
		ob_start();
		$contentFile = ucfirst($this->tableName);
		$contentFile .= 'View.php';
		
		require_once $this->pathView.$contentFile;
		$content = ob_get_contents();
		ob_end_clean();
		
		require_once $this->pathView.'MainView.php';
	}
	public function update($result, $title){
		if(!empty($result)){
			foreach($result[0] as $key=>$val){
				$$key = $val;
			}
		}
		ob_start();
		$contentFile = ucfirst($this->tableName);
		$contentFile .= 'FormView.php';
		require_once $this->pathView.$contentFile;
		$content = ob_get_contents();
		ob_end_clean();
		
		require_once $this->pathView.'MainView.php';
	}
}
