<div class="box-content">
	<h2><i class="fas fa-user-tag"></i> Clientes Cadastrados</h2>
	<div class="busca">
		<h4><i class="fas fa-search"></i> Realizar uma busca</h4>
		<form method="post">
			<input placeholder="Procure por: nome, email, cpf ou cnpj" type="text" name="busca">
			<input type="submit" name="acao" value="Buscar">
		</form>
	</div><!--busca-->
	
	<div class="boxes">
	<?php
		$query = "";
		if(isset($_POST['acao'])){
			$busca = $_POST['busca'];
			$query = " WHERE nome LIKE '%$busca%' OR email LIKE '%$busca%' OR cpf_cnpj LIKE '%$busca%'";
		}
		$clientes = MySql::conectar()->prepare("SELECT * FROM `admin_clientes` $query");
		$clientes->execute();
		$clientes = $clientes->fetchAll();
		if(isset($_POST['acao'])){
			echo '<div style="width:100%;" class="busca-result"><p>Foram encontrados <b>'.count($clientes).'</b> resultado(s)</p></div>';
		}
		foreach($clientes as $value){
	?>
		<div class="box-single-wraper">
			<div class="box-single">
				<div class="body-box">
					<p><b> Nome do cliente:</b> <?php echo $value['nome']; ?></p>
					<p><b> E-mail:</b> <?php echo $value['email']; ?></p>
					<p><b> Tipo:</b> <?php echo ucfirst($value['tipo']); ?></p>
					<p><b> <?php
						if($value['tipo'] == 'fisico')
							echo 'CPF: ';
						else
							echo 'CNPJ: ';
					 ?></b> <?php echo $value['cpf_cnpj']; ?></p>
					<div class="group-btn">
						<a class="btn delete" item_id="<?php echo $value['id']; ?>" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-clientes?excluir=<?php echo $value['id']; ?>"><i class="far fa-trash-alt"></i> Excluir</a>
						<a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-clientes?id=<?php echo $value['id']; ?>"><i class="fas fa-user-edit"></i> Editar</a>
					</div><!--group-btn-->
				</div><!--body-box-->
			</div><!--box-single-->
		</div><!--box-single-wraper-->
		<?php } ?>
		<div class="clear"></div>
	</div><!--boxes-->
</div><!--box-content-->