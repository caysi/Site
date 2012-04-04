<?php

header("Content-type:text/html;charset=utf-8");
error_reporting(E_ALL);
ini_set('display_errors','On');			// Вывод ошибок на экран
define("ROOT_PATH", __DIR__.'/');		// Корневая директроия

require_once(ROOT_PATH.'lib/MySQL.php');
require_once(ROOT_PATH.'lib/TableFactory.php');
require_once(ROOT_PATH.'lib/Request.php');
//require_once(ROOT_PATH.'lib/FrontController.php');
try{
	require_once 'config.php';
	
	$db = new MySql(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	$tf = new TableFactory($db, ROOT_PATH.'application/models/');
	
	$request = new Request($_REQUEST);
	
	$fc = new FrontController($tf, ROOT_PATH.'application/controllers/');
	$fc->dispatch($request);

}
catch (LibException $e) {
    echo $e->getMessage();
    exit;
}
