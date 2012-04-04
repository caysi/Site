<?php

class TableFactory{
	private $db;
	private $pathModels;
	private $tables = array();
	
	public function __construct($db, $pathModels){
	
		$this->db = $db;
		$this->pathModels = $pathModels;
	}
    
	private function getTable($tableName){
		if(!array_key_exists($tableName, $this->tables)){
			$className = ucfirst($tableName).'Model';
			$classFile = $this->pathModels.$className.'.php';
			require_once($classFile);
			$this->tables[$tableName] = new $className($this->db, $tableName);
        }
        return $this->tables[$tableName];
    }
    
    public function __get($tableName){
        return $this->getTable($tableName);
    }
}
