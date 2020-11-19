<div class="box-content">
<?php
	if(isset($_GET['email'])){
		$parcela_id = (int)$_GET['parcela'];
		$cliente_id = (int)$_GET['email'];
		if(isset($_COOKIE['cliente_'.$cliente_id])){
			Painel::alert('erro','Você já enviou um e-mail cobrando desse cliente! Aguarde mais um pouco.');
		}else{
			$sql = MySql::conectar()->prepare("SELECT * FROM `admin_financeiro` WHERE id = $parcela_id");
			$sql->execute();
			$infoFinanceiro = $sql->fetch();
			$sql = MySql::conectar()->prepare("SELECT * FROM `admin_clientes` WHERE id = $cliente_id");
			$sql->execute();
			$infoCliente = $sql->fetch();
			$corpoEmail = "Olá $infoCliente[nome], você está com um saldo pendente de $infoFinanceiro[valor] com o vencimento para $infoFinanceiro[vencimento].	Entre em contato conosco para quitar sua parcela.";
			//$email = new Email('vps.dankicode.com','testes@dankicode.com','gui123456','Guilherme');
			$email->addAdress($infoCliente['email'],$infoCliente['nome']);
			$email->formatarEmail(array('assunto'=>'Cobrança','corpo'=>$corpoEmail));
			$email->enviarEmail();
			Painel::alert('sucesso','E-mail enviado com sucesso.');
			setcookie('cliente_'.$cliente_id,'true',time()+30,'/');
		}
	}
?>

	<?php
	if(isset($_GET['pago'])){
			$sql = MySql::conectar()->prepare("UPDATE `admin_financeiro` SET status = 1 WHERE id = ?");
			$sql->execute(array($_GET['pago']));
			Painel::alert('sucesso','Pagamento quitado com sucesso.');
	}
	?>

	<h2><i class="fas fa-tasks"></i> Pagamentos Pendentes</h2>
	<div class="gerar-pdf">
		<a target="_blank" href="<?php echo INCLUDE_PATH_PAINEL ?>gerar-pdf.php?pagamento=pendentes">Gerar PDF</a>
	</div>

	<div class="wraper-table">
	<table>
		<tr class="table-header">
			<td>Nome do pagamento</td>
			<td>Cliente</td>
			<td>Valor</td>
			<td>Vencimento</td>
			<td>Enviar e-mail</td>
			<td>Marcar como pago</td>
		</tr>

		<?php
			$sql = MySql::conectar()->prepare("SELECT * FROM `admin_financeiro` WHERE status = 0 ORDER BY vencimento ASC");
			$sql->execute();
			$pendentes = $sql->fetchAll();

			foreach ($pendentes as $key => $value) {
			$clienteNome = MySql::conectar()->prepare("SELECT `nome`,`id` FROM `admin_clientes` WHERE id = $value[cliente_id]");
			$clienteNome->execute();
			$info = $clienteNome->fetch();
			$clienteNome = $info['nome'];
			$idCliente = $info['id'];
			$style="";
			if(strtotime(date('Y-m-d')) >= strtotime($value['vencimento'])){
				$style = 'style="background-color:#ff7070;font-weight:bold;"';
			}
		?>
		<tr <?php echo $style; ?>>
			<td><?php echo $value['nome']; ?></td>
			<td><?php echo $clienteNome; ?></td>
			<td><?php echo $value['valor']; ?></td>
			<td><?php echo date('d/m/Y',strtotime($value['vencimento'])); ?></td>
			<td><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL ?>visualizar-pagamentos?email=<?php echo $info['id']; ?>&parcela=<?php echo $value['id'];  ?>"><i class="far fa-envelope"></i> E-mail</a></td>
			<td><a class="btn" href="<?php echo INCLUDE_PATH_PAINEL ?>visualizar-pagamentos?pago=<?php echo $value['id'] ?>"><i class="far fa-check-square"></i> Pago</a></td>
		</tr>
		<?php } ?>
	</table>
	</div>

	<h2><i class="fas fa-money-check-alt"></i> Pagamentos Concluidos</h2>
	<div class="gerar-pdf">
		<a href="<?php echo INCLUDE_PATH_PAINEL ?>gerar-pdf.php?pagamento=concluidos" target="_blank">Gerar PDF</a>
	</div>
	<div class="wraper-table">
	<table>
		<tr>
			<td>Nome do pagamento</td>
			<td>Cliente</td>
			<td>Valor</td>
			<td>Vencimento</td>
		</tr>

		<?php
			$sql = MySql::conectar()->prepare("SELECT * FROM `admin_financeiro` WHERE status = 1 ORDER BY vencimento ASC");
			$sql->execute();
			$pendentes = $sql->fetchAll();

			foreach ($pendentes as $key => $value) {
			$clienteNome = MySql::conectar()->prepare("SELECT `nome` FROM `admin_clientes` WHERE id = $value[cliente_id]");
			$clienteNome->execute();
			$clienteNome = $clienteNome->fetch()['nome'];
		?>
		<tr>
			<td><?php echo $value['nome']; ?></td>
			<td><?php echo $clienteNome; ?></td>
			<td><?php echo $value['valor']; ?></td>
			<td><?php echo date('d/m/Y',strtotime($value['vencimento'])); ?></td>
		</tr>
		<?php } ?>
	</table>
	</div>
</div><!--box-content-->