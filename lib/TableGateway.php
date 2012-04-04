<?php
//require_once('SQLSpecification.php');

class TableGateway{
	private $table;
	private $db;
	const ID_CONDITION = 'id=?';
	
	public function __construct($db, $table){
		$this->table = $table;
		$this->db = $db;
	}
	
	public function insert($array){
		return $this->sql()->insert($this->table, $array)->execute();
	}
	
	public function delete($condition){
		$array = func_get_args();
		array_shift($array);
		if(is_array($array[0])){
			$array = $array[0];
		}
		return $this->sql()->delete($this->table)->where($condition, $array)->execute();
	}
	public function deleteById($id){
		return $this->delete(self::ID_CONDITION, $id);
	}
	
	public function findAll(){
		return $this->sql()->select($this->table, func_get_args())->query();
	}
	public function findAllById(){
		return $this->sql()->select($this->table, func_get_args())->order('id')->query();
	}
	public function find($condition){
		$array = func_get_args();
		array_shift($array);
		if(is_array($array[0])){
			$array = $array[0];
		}
		return $this->sql()->select($this->table)->where($condition, $array)->query();
	}
	public function findById($id){
		return $this->find(self::ID_CONDITION, $id);
	}
	
	public function maxId(){
		return $this->sql()->select($this->table, 'MAX(id)')->query();
	}
	private function sql(){
		$sql = new SQLSpecification($this->db);
		return $sql;
	}
	
}
