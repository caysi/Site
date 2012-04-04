<?php

class PostController{
	private $_action;
	private $_params;
	private $_db;
	public function __construct($db, $action, $params = NULL){
		$this->_action = $action;
		$this->_params = $params;
		$this->_db = $db;
	}
	public function build(){
		require_once(ROOT_PATH.'lib/TableGateway.php');
		$tg = new TableGateway($this->_db, 'posts');
		
		require_once(MODELS.'PostModel.php');
		$mod = new PostModel($tg);
		$content = $mod->{$this->_action.'Post'}($this->_params);
		
		$title = 'Post';			//#################
		
		require_once(VIEWS.'Header.php');
		require_once(VIEWS.'Content.php');
		require_once(VIEWS.'AddPost.php');
		require_once(VIEWS.'Futer.php');
	}
	
}
?>
