<?php
	include('../includeConstants.php');
	/**/
	$data['sucesso'] = true;
	$data['mensagem'] = "";

	if(Painel::logado() == false){
		die("Você não está logado!");
	}
	if(isset($_POST['acao']) && $_POST['acao'] == 'inserir'){
		$data = [];
		$data['tarefa'] = $_POST['tarefa'];
		$date = $_POST['data'];
		$sql = \MySql::conectar()->prepare("INSERT INTO `admin_agenda` VALUES (null,?,?)");
		$sql->execute(array($data['tarefa'],$date));
		die(json_encode($data));
	}else if(isset($_POST['acao']) && $_POST['acao'] == 'puxar'){
		$data = $_POST['data'];
		$sql = MySql::conectar()->prepare("SELECT * FROM `admin_agenda` WHERE data = '$data' ORDER BY id DESC");
		$sql->execute();
		$info = $sql->fetchAll();
		$box = "";
		foreach ($info as $key => $value) {
			/*
		<div class="box-tarefas-single">
			<h2><i class="fa fa-pencil"></i> <?php echo $value['tarefa']; ?></h2>
		</div>
		*/
			$box.='<div class="box-tarefas-single">';
			$box.='<h2><i class="fas fa-edit"></i> '.$value['tarefa'].'</h2>';
			$box.="</div>";
		}
		die($box);
	}
?>