<?php
	if(isset($_GET['pendentes']) == false){
?>

<div class="box-content">
	<h2><i class="fas fa-boxes"></i> Produtos no estoque</h2>
	<div class="busca">
		<h4><i class="fa fa-search"></i> Realizar uma busca</h4>
		<form method="post">
			<input style="font-size: 15px;" placeholder="Procure pelo nome do produto" type="text" name="busca">
			<input type="submit" name="acao" value="Buscar">
		</form>
	</div><!--busca-->
	<?php

		if(isset($_GET['deletar'])){
			//queremos deletar algum produto.
			$id = (int)$_GET['deletar'];
			$imagens = MySql::conectar()->prepare("SELECT * FROM `admin.estoque_imagens` WHERE produto_id = $id");
			$imagens->execute();
			$imagens = $imagens->fetchAll();
			foreach ($imagens as $key => $value) {
				@unlink(BASE_DIR_PAINEL.'/uploads/'.$value['imagem']);
			}
			MySql::conectar()->exec("DELETE FROM `admin.estoque_imagens` WHERE produto_id = $id");
			MySql::conectar()->exec("DELETE FROM `admin_estoque` WHERE id = $id");
			Painel::alert('sucesso',"Produto removido do estoque.");
		}

		if(isset($_POST['atualizar'])){
			$quantidade = $_POST['quantidade'];
			$produto_id = $_POST['produto_id'];
			if($quantidade < 0){
				Painel::alert('erro','Você não pode atualizar a quantidade para menor que 0.');
			}else{
				MySql::conectar()->exec("UPDATE `admin_estoque` SET quantidade = $quantidade WHERE id = $produto_id");
				Painel::alert('sucesso','Produto com ID: <b>'.$_POST['produto_id'].' atualizado.</b>');
			}
		}

		$sql = MySql::conectar()->prepare("SELECT * FROM `admin_estoque` WHERE quantidade = 0");
		$sql->execute();
		if($sql->rowCount() > 0){
		Painel::alert('atencao','Você está com produtos em falta! Clique <a href="'.INCLUDE_PATH_PAINEL.'visualizar-produtos?pendentes">aqui</a> para visualiza-los!');
		}

	?>
	<div class="boxes">
		<?php
			$query = "";
			if(isset($_POST['acao']) && $_POST['acao'] == 'Buscar'){
				$nome = $_POST['busca'];
				$query = "WHERE (nome LIKE '%$nome%' OR descricao LIKE '%$nome%')";
			}
			if($query == ''){
				$query2 = "WHERE quantidade > 0";
			}else{
				$query2 = " AND quantidade > 0";
			}
			$sql = MySql::conectar()->prepare("SELECT * FROM `admin_estoque` $query $query2");

			$sql->execute();
			$produtos = $sql->fetchAll();
			if($query != ''){
				echo '<div style="width:100%;" class="busca-result"><p>Foram encontrados <b>'.count($produtos).'</b> resultado(s)</p></div>';
			}
			foreach ($produtos as $key => $value) {
			$imagemSingle = MySql::conectar()->prepare("SELECT * FROM `admin.estoque_imagens` WHERE produto_id = $value[id] LIMIT 1");
			$imagemSingle->execute();
			$imagemSingle = $imagemSingle->fetch()['imagem'];
		?>
		<div class="box-single-wraper">
			<div class="box-container">
			<div style="width: 100%;float: left;" class="box-imgs">
				<?php
					if($imagemSingle == ''){

				?>
					<h1><i class="fa fas-edit"></i></h1>

				<?php }else{ ?>
					<img class="img-square" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $imagemSingle ?>" />
				<?php } ?>
			</div><!--box-imgs-->
			<div style="width: 100%;float: left;border: 0;" class="box-single">
				<div class="body-box">
					<p><b> Nome do produto:</b> <?php echo $value['nome'] ?></p>
					<p><b> Descrição:</b> <?php echo $value['descricao'] ?></p>
					<p><b> Largura:</b> <?php echo $value['largura'] ?> cm</p>
					<p><b> Altura:</b> <?php echo $value['altura'] ?> cm</p>
					<p><b> Comprimento:</b> <?php echo $value['comprimento'] ?> cm</p>
					<p><b> Peso:</b> <?php echo $value['peso'] ?> kg</p>
					<p><b> Preço:</b> R$<?php echo Painel::convertMoney($value['preco']); ?></p>
					<div style="padding:8px 0;border-bottom: 1px solid #ccc;" class="group-btn">
						<form method="post" style="margin: 0;">
							<label>Quantidade atual:</label>
							<input type="number" name="quantidade" min="0" max="900" step="1" value="<?php echo $value['quantidade'] ?>">
							<input type="hidden" name="produto_id" value="<?php echo $value['id']; ?>">
							<input style="background: #0091ea;" type="submit" name="atualizar" value="Atualizar">
						</form>
					</div><!--group-btn-->
					<div class="group-btn">
						<a class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL ?>visualizar-produtos?deletar=<?php echo $value['id']; ?>"><i class="far fa-trash-alt"></i> Excluir</a>
						<a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-produto?id=<?php echo $value['id'] ?>"><i class="fas fa-edit"></i> Editar</a>
					</div><!--group-btn-->
				</div><!--body-box-->
			</div><!--box-single-->
			<div class="clear"></div>
			</div>
		</div><!--box-single-wraper-->
		<?php } ?>
	</div><!--boxes-->
</div><!--box-content-->

<?php }else{ ?>
<div class="box-content">
	<h2><i class="fas fa-box-open"></i> <a style="text-decoration: none; color: rgb(65, 65, 189);" href="<?php echo INCLUDE_PATH_PAINEL ?>visualizar-produtos">Produtos no estoque</a> » Produtos em falta</h2>
	<?php
		if(isset($_POST['atualizar'])){
			$quantidade = $_POST['quantidade'];
			$produto_id = $_POST['produto_id'];
			if($quantidade <= 0){
				Painel::alert('erro','Você não pode atualizar a quantidade para igual ou menor a 0!');
			}else{
				MySql::conectar()->exec("UPDATE `admin_estoque` SET quantidade = $quantidade WHERE id = $produto_id");
				Painel::alert('sucesso','Quantidade do produto com ID: <b>'.$_POST['produto_id'].' atualizada.</b>');
			}
		}
		echo '<br />';
		$sql = MySql::conectar()->prepare("SELECT * FROM `admin_estoque` WHERE quantidade = 0");
		$sql->execute();
		$produtos = $sql->fetchAll();
		if(count($produtos) > 0)
			Painel::alert('atencao','Todos os produtos listados abaixo estão em falta no seu estoque!');
		else
			Painel::alert('sucesso','Não há produtos em falta.');
	?>

	<div class="boxes">
		<?php
			foreach ($produtos as $key => $value) {
			$imagemSingle = MySql::conectar()->prepare("SELECT * FROM `admin.estoque_imagens` WHERE produto_id = $value[id] LIMIT 1");
			$imagemSingle->execute();
			$imagemSingle = $imagemSingle->fetch()['imagem'];
		?>
		<div class="box-single-wraper">
			<div class="box-container">
			<div style="width: 100%;float: left;" class="box-imgs">
				<?php
					if($imagemSingle == ''){
				?>
					<h1><i class="fa fas-edit"></i></h1>

				<?php }else{ ?>
					<img class="img-square" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $imagemSingle ?>" />
				<?php } ?>
			</div><!--box-imgs-->
			<div style="width: 70%;float: left;border: 0;" class="box-single">
				<div class="body-box">
					<p><b> Nome do produto:</b> <?php echo $value['nome'] ?></p>
					<p><b> Descrição:</b> <?php echo $value['descricao'] ?></p>
					<p><b> Largura:</b> <?php echo $value['largura'] ?>cm</p>
					<p><b> Altura:</b> <?php echo $value['altura'] ?>cm</p>
					<p><b> Comprimento:</b> <?php echo $value['comprimento'] ?>cm</p>
					<p><b> Peso:</b> <?php echo $value['peso'] ?></p>
					<p><b> Preço:</b> R$<?php echo Painel::convertMoney($value['preco']); ?></p>
					<div style="padding:8px 0;border-bottom: 1px solid #ccc;" class="group-btn">
						<form method="post" style="margin: 0;">
							<label>Quantidade atual:</label>
							<input type="number" name="quantidade" min="0" max="900" step="1" value="<?php echo $value['quantidade'] ?>">
							<input type="hidden" name="produto_id" value="<?php echo $value['id']; ?>">
							<input style="background: #0091ea;" type="submit" name="atualizar" value="Atualizar">
						</form>
					</div><!--group-btn-->
					<div class="group-btn">
						<a class="btn delete" item_id="<?php echo $value['id'] ?>" href="<?php echo INCLUDE_PATH_PAINEL ?>"><i class="far fa-trash-alt"></i> Excluir</a>
						<a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-produto?id=<?php echo $value['id'] ?>"><i class="fas fa-edit"></i> Editar</a>
					</div><!--group-btn-->
				</div><!--body-box-->
			</div><!--box-single-->
			<div class="clear"></div>
			</div>
		</div><!--box-single-wraper-->
		<?php } ?>		
	</div><!--boxes-->
</div>
<?php } ?>