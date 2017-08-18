<?php 
	require "environment.php";
	global $db;

	$config = array();
	if(ENVIRONMENT == "development"){
		define("BASE_URL", "http://localhost:8080/estrutura_mvc/");
		$config['dbname'] = "mvc";
		$config['host'] = 'localhost';
		$config['dbuser'] = 'root';
		$config['dbpass'] = '';
	}else{
		define("BASE_URL", "http://meusite.com.br/");
		$config['dbname'] = "mvc";
		$config['host'] = 'localhost';
		$config['dbuser'] = 'root';
		$config['dbpass'] = '';
	}

	try{
		$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
	}catch(PDOException $ex){
		echo "ERRO: ".$ex->getMessage();
	}
 ?>