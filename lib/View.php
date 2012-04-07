<?php

class View{
	public $tableName;
	public $pathView;
	
	public function __construct($tableName,$pathView){
		$this->tableName = $tableName;
		$this->pathView = $pathView;
	}
	function render ($result, $title){
		ob_start();
		$contentFile = ucfirst($this->tableName);
		$contentFile .= 'View.php';
		require_once $this->pathView.$contentFile;
		$content = ob_get_contents();
		ob_end_clean();
		require_once $this->pathView.'MainView.php';
	}
}
