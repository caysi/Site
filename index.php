<?php

header("Content-type:text/html;charset=utf-8");
error_reporting(E_ALL);
ini_set('display_errors','On');			// Вывод ошибок на экран
define("ROOT_PATH", dirname(__FILE__).'/');		// Корневая директроия
define("ROOT_URL", dirname(__FILE__).'/');		////////////////////////////////////////

define("DEFAULT_CONTROLLER", 'posts');
define("DEFAULT_ACTION", 'read');

$default = array('controller'=>'posts',
				'action'=>'read');
$pathTo = array('controllers'=>ROOT_PATH.'application/controllers/',
				'models'=>ROOT_PATH.'application/models/',
				'views'=>ROOT_PATH.'application/views/');

require_once(ROOT_PATH.'lib/MySQL.php');
require_once(ROOT_PATH.'lib/TableFactory.php');
require_once(ROOT_PATH.'lib/Request.php');
require_once(ROOT_PATH.'lib/FrontController.php');
require_once(ROOT_PATH.'lib/Controller.php');
require_once(ROOT_PATH.'lib/CRUDController.php');
require_once(ROOT_PATH.'lib/TableGateway.php');
require_once(ROOT_PATH.'lib/View.php');

try{
	require_once 'config.php';
	
	$db = new MySql(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	$tf = new TableFactory($db, $pathTo['models']);
	
	$request = new Request($_REQUEST);
	
	$fc = new FrontController($tf, $pathTo, $default);
	$fc->dispatch($request);

}
catch (LibException $e) {
    echo $e->getMessage();
    exit;
}
