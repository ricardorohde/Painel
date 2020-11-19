<?php
	$id = $par[2];
	$sql = MySql::conectar()->prepare("SELECT * FROM `admin_empreendimentos` WHERE id = ?");
	$sql->execute(array($id));

	$infoEmpreend = $sql->fetch();

	if($infoEmpreend['nome'] == ''){
		header('Location: '.INCLUDE_PATH_PAINEL);
	}

?>
<div class="box-content">
	<h2><i class="fas fa-building"></i> Empreendimento: <?php echo $infoEmpreend['nome'] ?></h2>
	<div class="info-item">

		<div class="row1">
				<div class="card-title"> Imagem do empreendimento:</div>
				<img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $infoEmpreend['imagem'] ?>" />
		</div><!--row1-->

		<div class="row2">
				<div class="card-title"> Informações do Empreendimento:</div>
				<p> Nome do empreendimento: <?php echo $infoEmpreend['nome'] ?></p>
				<p> Tipo: <?php echo ucfirst($infoEmpreend['tipo']) ?></p>
		</div><!--row2-->
		<div class="clear"></div>	
	</div><!--info-item-->

	<div class="card-title"><i class="far fa-building"></i> Cadastrar Imóvel:</div>
	<form method="post" enctype="multipart/form-data">
	<?php
		if(isset($_POST['acao'])){
			$empreendId = $id;
			$nome = $_POST['nome'];
			$preco = $_POST['preco'];
			$area = $_POST['area'];

			$imagens = array();
			$amountFiles = count($_FILES['imagens']['name']);

			$sucesso = true;

			if($_FILES['imagens']['name'][0] != ''){

			for($i =0; $i < $amountFiles; $i++){
				$imagemAtual = ['type'=>$_FILES['imagens']['type'][$i],
				'size'=>$_FILES['imagens']['size'][$i]];
				if(Painel::imagemValida($imagemAtual) == false){
					$sucesso = false;
					Painel::alert('erro','Formato de imagem inválido.');
					break;
				}
			}

			}else{
				$sucesso = false;
				Painel::alert('erro','Selecione ao menos uma imagem.');
			}

			if($sucesso){
				//TODO: Cadastrar informacoes e imagens e realizar upload.
				for($i =0; $i < $amountFiles; $i++){
					$imagemAtual = ['tmp_name'=>$_FILES['imagens']['tmp_name'][$i],
						'name'=>$_FILES['imagens']['name'][$i]];
					$imagens[] = Painel::uploadFile($imagemAtual);
				}

				$sql = MySql::conectar()->prepare("INSERT INTO `admin_imoveis` VALUES (null,?,?,?,?,0)");
				$sql->execute(array($empreendId,$nome,$preco,$area));
				$lastId = MySql::conectar()->lastInsertId();
				foreach ($imagens as $key => $value) {
					MySql::conectar()->exec("INSERT INTO `admin.imagens_imoveis` VALUES (null,$lastId,'$value')");
				}
				Painel::alert('sucesso','Imóvel cadastrado com sucesso.');
			}
		}
	?>
		<div class="form-group">
			<label>Nome:</label>
			<input type="text" name="nome">
		</div><!--form-group-->

		<div class="form-group">
			<label>Área:</label>
			<input type="number" name="area" min="0" max="2000" step="100" value="0">
		</div><!--form-group-->

		<div class="form-group">
			<label>Preco:</label>
			<input type="text" name="preco">
		</div><!--form-group-->

		<div class="form-group">
			<label>Selecione Imagens:</label>
			<input type="file" multiple name="imagens[]">
		</div><!--form-group-->

		<div class="form-group">
			<input type="submit" name="acao" value="Cadastrar">
		</div><!--form-group-->
	</form>
	<div class="wraper-table">
	<table>
		<tr style="background: rgb(65, 65, 189); color: white;">
			<td>Nome</td>
			<td>Preço</td>
			<td>Área</td>
			<td></td>
		</tr>

		<?php
			$pegaImoveis = Painel::selectQuery('admin_imoveis','empreend_id=?',array($id));
			foreach($pegaImoveis as $key=>$value){
		?>
		<tr>
			<td><?php echo $value['nome']; ?></td>
			<td>R$<?php echo $value['preco']; ?></td>
			<td><?php echo $value['area']; ?>m²</td>
			<td><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-imovel?id=<?php echo $value['id']; ?>"><i class="fa fa-eye"></i> Visualizar</a></td>
		</tr>
		<?php } ?>
	</table>
	</div>
</div><!--box-content-->