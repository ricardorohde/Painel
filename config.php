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

    //conectar com o banco de dados
    define('HOST','localhost');
    define('USER','root');
    define('PASSWORD','');
    define('DATABASE','projetos_painel');

    //constantes para o painel de controle
    define('NOME_EMPRESA','');

    //funções do painel
    function pegaCargo($indice){
		return Painel::$cargos[$indice];
	}

	function selecionadoMenu($par){
		/*<i class="fa fa-angle-double-right" aria-hidden="true"></i>*/
		$url = explode('/',@$_GET['url'])[0];
		if($url == $par){
			echo 'class="menu-active"';
		}
	}

	function verificaPermissaoMenu($permissao){
		if($_SESSION['cargo'] >= $permissao){
			return;
		}else{
			echo 'style="display:none;"';
		}
	}

	function verificaPermissaoPagina($permissao){
		if($_SESSION['cargo'] >= $permissao){
			return;
		}else{
			include('painel/pages/permissao_negada.php');
			die();
		}
	}

	function recoverPost($post){
		if(isset($_POST[$post])){
			echo $_POST[$post];
		}
	}
?>