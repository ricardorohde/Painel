<div class="box-content">

	<h2><i class="fas fa-briefcase"></i> Cadastrar Empreendimento</h2>

	<form method="post" enctype="multipart/form-data">

		<?php
			if(isset($_POST['acao'])){
				$nome = $_POST['nome'];
				$tipo = $_POST['tipo'];
				$preco = $_POST['preco'];
				$imagem = $_FILES['imagem'];

				if($_FILES['imagem']['name'] == ''){
					Painel::alert('erro','Selecione ao menos uma imagem.');
				}else{
					//Imagem é válida?
					if(!(Painel::imagemValida($imagem))){
						Painel::alert('erro','Formato de imagem inválido.');
					}else{
						//Realizar cadastro e upload.
						$idImagem = Painel::uploadFile($imagem);
						$slug = Painel::generateSlug($nome);
						$sql = MySql::conectar()->prepare("INSERT INTO `admin_empreendimentos` VALUES (null,?,?,?,?,?,?)");
						$sql->execute(array($nome,$tipo,$preco,$idImagem,$slug,0));
						$lastId = MySql::conectar()->lastInsertId();
						MySql::conectar()->exec("UPDATE `admin_empreendimentos` SET order_id = $lastId WHERE id = $lastId");
						Painel::alert('sucesso','Empreendimento cadastrado com sucesso.');
					}
				}
			}
		?>
		
		<div class="form-group">
			<label>Nome:</label>
			<input required type="text" name="nome" />
		</div><!--form-group-->
		<div class="form-group">
			<label>Tipo:</label>
			<select name="tipo">
				<option value="residencial">Residencial</option>
				<option value="comercial">Comercial</option>
			</select>
		</div><!--form-group-->
		<div class="form-group">
			<label>Preço:</label>
			<input type="text" name="preco">
		</div><!--form-group-->
		<div class="form-group">
			<label>Imagem:</label>
			<input type="file" name="imagem">
		</div><!--form-group-->

		<div class="form-group">
			<input type="submit" name="acao" value="Cadastrar">
		</div><!--form-group-->
	</form>
</div><!--box-content-->