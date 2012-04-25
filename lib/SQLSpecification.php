<?php

class SQLSpecification{
	private $db;
	private $sql;
	private $tables = array();
	const PARAM_NEEDLE = '?';
	
	public function __construct(DbConnector $db){
		$this->db = $db;
	}
	
	public function select($table){	//('table','field1',field2,....) OR ('table',array('field1',field2,....))
		$array = func_get_args();
		if(empty($array[1])){
			$fields = '*';
		}
		else{
			$array = $this->clearArguments($array);
			$array = $this->wrapArray($array, FALSE);
			$fields = implode(',',$array);
		}
		$this->sql = "SELECT $fields FROM $table";
		$this->tables[1] = $table;
		return $this;
	}
	//('post',array('Theme'=>'Hello','Text'=>,'World\nGGGGGg','UserId'=>1))
	public function insert($table, $array){
		foreach($array as $key=>$val){
			$array[0][] = $this->wrap($key, FALSE);  //////////////////////
			$array[1][] = $this->wrap($val);
		}
		$array[0] = implode(',',$array[0]);
		$array[1] = implode(',',$array[1]);
		$this->sql = "INSERT INTO $table ($array[0]) VALUES($array[1])";
		return $this;
	}
	public function delete($table){
		$this->sql = "DELETE FROM $table";
		return $this;
	}
	public function update($table, $array){
		$set = array();
		foreach($array as $key=>$val){
			$set[] = $key.'='.$this->wrap($val);
		}
		$value = implode(',',$set);
		$this->sql = "UPDATE $table SET $value";
		return $this;
	}
	
	public function where($conditions){
		$array = $this->clearArguments(func_get_args());
		$this->sql .= ' WHERE '.$this->substitute($conditions, $array);
		return $this;
	}
	public function order($field, $desc = FALSE){
		$this->sql .= ' ORDER BY '.$field;
		if($desc){
			$this->sql .= ' DESC';
		}
		return $this;
	}
	public function join($table, $conditionsArray, $join = 'INNER'){  // conditions
		$this->tables[] = $table;
		$this->sql .= ' '.strtoupper($join).' JOIN '.$table.' ON ';
		$first = TRUE;
		$cnt=count($conditionsArray);
		
		for($i=0; $i<$cnt; $i++){
			if(!$first){
				$this->sql .= ' AND ';
			}
			$this->sql .= $this->tables[$conditionsArray[$i]].'.';
			$i++;
			$this->sql .= $conditionsArray[$i].'=';
			$i++;
			$this->sql .= $this->tables[$conditionsArray[$i]].'.';
			$i++;
			$this->sql .= $conditionsArray[$i];
			$first = FALSE;
		}
		return $this;
	}
	
	private function substitute($conditions, $params){
		$cnt = 0;
		while(($pos = strpos($conditions, self::PARAM_NEEDLE)) > -1){
			$c = substr($conditions, 0, $pos);
			$c .= $this->wrap($params[$cnt]);
			$cnt++;
			$conditions = $c.substr($conditions, ($pos + strlen(self::PARAM_NEEDLE)));
		}
		return $conditions;
	}
	private function clearArguments($array, $quantity = 1){
		$array = array_slice($array, $quantity);
		if(is_array($array[0])){
			$array = $array[0];
		}
		/*if($wrap){
			foreach($array as &$val){
				$val = $this->wrap($val, false);
			}
		}*/
		return $array;
	}
	private function wrapArray($array, $val = TRUE){
		foreach($array as &$data){
			$data = $this->wrap($data, $val);
		}
		return $array;
	}
	private function wrap($data, $val = TRUE){
		if(is_string($data)){
			$data = addslashes($data);
			if($val){
				$data = "'$data'";
			}
			else{
				if(strpos($data,' ')){
					$data = "`$data`";
				}
			}
		}
		if(is_bool($data)){
			$data = $data ? 'true' : 'false';
		}
		return $data;
	}
	
	public function execute(){
		return $this->db->execute($this->sql);
	}
	public function query(){
		return $this->db->query($this->sql);
	}
}
