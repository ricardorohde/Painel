<?php
	session_start();
	date_default_timezone_set('America/Sao_Paulo');
	require('vendor/autoload.php');
	$autoload = function($class){
		if($class == 'Email'){
			require_once('classes/phpmailer/PHPMailerAutoload.php');
		}
		include('classes/'.$class.'.php');
	};

	spl_autoload_register($autoload);

	define('INCLUDE_PATH','http://localhost/Backend/Painel/');
	define('INCLUDE_PATH_PAINEL',INCLUDE_PATH);

	define('BASE_DIR_PAINEL',__DIR__);
	//Conectar com banco de dados!
	define('HOST','localhost');
	define('USER','root');
	define('PASSWORD','');
	define('DATABASE','projetos_painel');

	//Constantes para o painel de controle
	define('NOME_EMPRESA','');
?>