<?php
	$id = (int)$_GET['id'];
	$sql = MySql::conectar()->prepare("SELECT * FROM `admin_estoque` WHERE id = ?");
	$sql->execute(array($id));
	if($sql->rowCount() == 0){
		Painel::alert('erro','O produto não existe.');
		die();
	}

	$infoProduto = $sql->fetch();

	$pegaImagens = MySql::conectar()->prepare("SELECT * FROM `admin.estoque_imagens` WHERE produto_id = $id");
	$pegaImagens->execute();
	$pegaImagens = $pegaImagens->fetchAll();

?>

<div class="box-content">
	<h2><i class="far fa-edit"></i> Editando Produto: <?php echo $id; ?></h2>
	<div class="card-title"><i class="fas fa-shopping-cart"></i> Informações do produto:</div>
	<?php
	if(isset($_GET['deletarImagem'])){
		$idImagem = $_GET['deletarImagem'];
		@unlink(BASE_DIR_PAINEL.'/uploads/'.$idImagem);
		MySql::conectar()->exec("DELETE FROM `admin.estoque_imagens` WHERE imagem = '$idImagem'");
		Painel::alert('sucesso','Imagem deletada.');
		$pegaImagens = MySql::conectar()->prepare("SELECT * FROM `admin.estoque_imagens` WHERE produto_id = $id");
		$pegaImagens->execute();
		$pegaImagens = $pegaImagens->fetchAll();
	}
	?>

	<form method="post" action="<?php echo INCLUDE_PATH_PAINEL ?>editar-produto?id=<?php echo $id; ?>" enctype="multipart/form-data">
	<?php
		if(isset($_POST['acao'])){
			$nome = $_POST['nome'];
			$descricao = $_POST['descricao'];
			$largura = $_POST['largura'];
			$altura = $_POST['altura'];
			$comprimento = $_POST['comprimento'];
			$peso = $_POST['peso'];
			$quantidade = $_POST['quantidade'];
			$preco = Painel::formatarMoedaBd($_POST['preco']);
			$imagens = [];
			$sucesso = true;
			$amountFiles = count($_FILES['imagem']['name']);
			if($_FILES['imagem']['name'][0] != ''){
				for($i =0; $i < $amountFiles; $i++){
					$imagemAtual = ['type'=>$_FILES['imagem']['type'][$i],
					'size'=>$_FILES['imagem']['size'][$i]];
					if(Painel::imagemValida($imagemAtual) == false){
						$sucesso = false;
						Painel::alert('erro','Imagem inválida.');
						break;
					}
				}
			}

			if($sucesso){
				if($_FILES['imagem']['name'][0] != ''){
					for($i =0; $i < $amountFiles; $i++){
						$imagemAtual = ['tmp_name'=>$_FILES['imagem']['tmp_name'][$i],
							'name'=>$_FILES['imagem']['name'][$i]];
						$imagens[] = Painel::uploadFile($imagemAtual);
					}

					foreach ($imagens as $key => $value) {
						MySql::conectar()->exec("INSERT INTO `admin.estoque_imagens` VALUES (null,$id,'$value')");
					}
				}

				$sql = MySql::conectar()->prepare("UPDATE `admin_estoque` SET nome = ?,descricao = ?, altura = ?,
				largura = ?, comprimento = ?, peso = ?, quantidade = ? WHERE id = $id");
				$sql->execute(array($nome,$descricao,$altura,$largura,$comprimento,$peso,$quantidade));

				Painel::alert('sucesso','Produto atualizado com sucesso.');
				$sql = MySql::conectar()->prepare("SELECT * FROM `admin_estoque` WHERE id = ?");
				$sql->execute(array($id));
				$infoProduto = $sql->fetch();
				$pegaImagens = MySql::conectar()->prepare("SELECT * FROM `admin.estoque_imagens` WHERE produto_id = $id");
				$pegaImagens->execute();
				$pegaImagens = $pegaImagens->fetchAll();
			}
		}
	?>
	<div class="form-group">
			<label>Nome do produto:</label>
			<input type="text" name="nome" value="<?php echo $infoProduto['nome']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<label>Descrição do produto:</label>
			<textarea name="descricao"><?php echo $infoProduto['descricao']; ?></textarea>
		</div><!--form-group-->

		<div class="form-group">
			<label>Largura do produto:</label>
			<input type="number" name="largura" min="0" max="900" step="any" value="<?php echo $infoProduto['largura']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<label>Altura do produto:</label>
			<input type="number" name="altura" min="0" max="900" step="any" value="<?php echo $infoProduto['altura']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<label>Comprimento do produto:</label>
			<input type="number" name="comprimento" min="0" max="900" step="any" value="<?php echo $infoProduto['comprimento']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<label>Peso do produto:</label>
			<input type="number" name="peso" min="0" max="900" step="any" value="<?php echo $infoProduto['peso']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<label>Quantidade atual do produto:</label>
			<input type="number" name="quantidade" min="0" max="900" step="1" value="<?php echo $infoProduto['quantidade']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<label>Preço:</label>
			<input type="text" name="preco">
		</div><!--form-group-->

		<div class="form-group">
			<label>Selecione as imagens:</label>
			<input multiple type="file" name="imagem[]">
		</div><!--form-group-->
		<input type="submit" name="acao" value="Atualizar">
	</form>
		<div class="card-title"><i class="far fa-image"></i> Imagens do produto:</div>
	<div class="boxes">
		<?php
			foreach ($pegaImagens as $key => $value){
		?>
		<div class="box-single-wraper">
			<div class="box-container">
			<div style="width: 100%;float: left;" class="box-imgs">
				<img class="img-square" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['imagem'] ?>" />
			</div><!--box-imgs-->
			<div class="clear"></div>
			<div style="text-align: center;" class="group-btn">
				<a class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-produto?id=<?php echo $id; ?>&deletarImagem=<?php echo $value['imagem'] ?>"><i class="far fa-trash-alt"></i> Excluir</a>
			</div><!--group-btn-->			
			</div>
		</div><!--box-single-wraper-->
		<?php } ?>
	</div><!--boxes-->
</div>