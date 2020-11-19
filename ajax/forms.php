<?php

	include('../includeConstants.php');
	$data['sucesso'] = true;
	$data['mensagem'] = "";

	if(Painel::logado() == false){
		die("Você não está logado.");
	}
	
	/*Nosso código começa aqui!*/
	if(isset($_POST['tipo_acao']) && $_POST['tipo_acao'] == 'cadastrar_cliente'){
	sleep(2);
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$tipo = $_POST['tipo_cliente'];
	$cpf = '';
	$cnpj = '';
	if($tipo == 'fisico'){
		$cpf = $_POST['cpf'];
	}else if($tipo == 'juridico'){
		$cnpj = $_POST['cnpj'];
	}
	if($nome == "" || $email == "" || $tipo == ""){
		$data['sucesso'] = false;
		$data['mensagem'] = "Os campos não podem ser vazios.";
	}

	if($data['sucesso']){
		$sql = MySql::conectar()->prepare("INSERT INTO `admin_clientes` VALUES (null,?,?,?,?)");
		$dadoFinal = ($cpf == '') ? $cnpj : $cpf;
		$sql->execute(array($nome,$email,$tipo,$dadoFinal));
		$data['mensagem'] = "Cliente cadastrado com sucesso.";
	}

	}else if(isset($_POST['tipo_acao']) && $_POST['tipo_acao'] == 'atualizar_cliente'){
		sleep(2);
		$id = $_POST['id'];
		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$tipo = $_POST['tipo_cliente'];
		$cpf = '';
		$cnpj = '';
		if($tipo == 'fisico'){
			$cpf = $_POST['cpf'];
		}else if($tipo == 'juridico'){
			$cnpj = $_POST['cnpj'];
		}

		if($nome == '' || $email == ''){
			$data['sucesso'] = false;
			$data['mensagem'] = "Os campos não podem ser vazios.";
		}

		if($data['sucesso']){
			$sql = MySql::conectar()->prepare("UPDATE `admin_clientes` SET nome=?,email=?,tipo=?,cpf_cnpj=?  WHERE id = $id");
			$dadoFinal = ($cpf == '') ? $cnpj : $cpf;
			$sql->execute(array($nome,$email,$tipo,$dadoFinal));
			$data['mensagem'] = "Cliente atualizado.";
		}

	}else if(isset($_POST['tipo_acao']) && $_POST['tipo_acao'] == 'deletar_cliente'){
		$id = $_POST['id'];
		MySql::conectar()->exec("DELETE FROM `admin_clientes` WHERE id = $id");
		MySql::conectar()->exec("DELETE FROM `admin_financeiro` WHERE cliente_id = $id");
	}else if(isset($_POST['tipo_acao']) && $_POST['tipo_acao'] == 'ordenar_empreendimentos'){
		$ids = $_POST['item'];
		$i = 1;
		foreach ($ids as $key => $value) {
			MySql::conectar()->exec("UPDATE `admin_empreendimentos` SET order_id = $i WHERE id = $value");
			$i++;
		}
	}
	die(json_encode($data));
?>