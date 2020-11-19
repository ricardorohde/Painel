<?php
	$id = (int)$_GET['id'];
	$sql = MySql::conectar()->prepare("SELECT * FROM `admin_imoveis` WHERE id = ?");
	$sql->execute(array($id));
	if($sql->rowCount() == 0){
		Painel::alert('erro','O imóvel não existe.');
		die();
	}

	$infoProduto = $sql->fetch();
	$pegaImagens = MySql::conectar()->prepare("SELECT * FROM `admin.imagens_imoveis` WHERE imovel_id = $id");
	$pegaImagens->execute();
	$pegaImagens = $pegaImagens->fetchAll();
?>

<div class="box-content">
	<h2><i class="fas fa-edit"></i> Editando Imóvel: <?php echo $id; ?></h2>
	<div class="card-title"><i class="fas fa-city"></i> Informações do Imóvel:</div>
	<?php
	if(isset($_GET['deletarImagem'])){
		$idImagem = $_GET['deletarImagem'];
		@unlink(BASE_DIR_PAINEL.'/uploads/'.$idImagem);
		MySql::conectar()->exec("DELETE FROM `admin.imagens_imoveis` WHERE imagem = '$idImagem'");
		Painel::alert('sucesso','Imagem deletada.');
		$pegaImagens = MySql::conectar()->prepare("SELECT * FROM `admin.imagens_imoveis` WHERE imovel_id = $id");
		$pegaImagens->execute();
		$pegaImagens = $pegaImagens->fetchAll();
	}else if(isset($_GET['deletarImovel'])){
		foreach ($pegaImagens as $key => $value) {
			@unlink(BASE_DIR_PAINEL.'/uploads/'.$value['imagem']);
		}
		MySql::conectar()->exec("DELETE FROM `admin.imagens_imoveis` WHERE imovel_id= $id");
		MySql::conectar()->exec("DELETE FROM `admin_imoveis` WHERE id = $id");
		Painel::alertJS("Imóvel deletado.");
		Painel::redirect(INCLUDE_PATH_PAINEL.'listar-empreendimentos');
	}
	?>
	<form method="post" action="<?php echo INCLUDE_PATH_PAINEL ?>editar-produto?id=<?php echo $id; ?>" enctype="multipart/form-data">
	<div class="form-group">
			<label>Nome do Imóvel:</label>
			<input disabled="" type="text" name="nome" value="<?php echo $infoProduto['nome']; ?>">
    </div><!--form-group-->
    
	<div class="form-group">
			<label>Preço do Imóvel:</label>
			<input disabled="" type="text" name="nome" value="<?php echo $infoProduto['preco']; ?>">
    </div><!--form-group-->
    
		<div class="form-group">
			<label>Área:</label>
			<input disabled="" type="text" name="nome" value="<?php echo $infoProduto['area']; ?>">
    </div><!--form-group-->
    
		<a style="font-size: 17px;padding:4px 10px;" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-imovel?id=<?php echo $id; ?>&deletarImovel"><i class="far fa-trash-alt"></i> Excluir Imóvel</a>
	</form>
		<div class="card-title"><i class="far fa-building"></i> Imagens do produto:</div>
	<div class="boxes">
		<?php
			foreach ($pegaImagens as $key => $value){
		?>
		<div class="box-single-wraper">
			<div style="border: 1px solid #ccc;padding:8px 15px;background: #fff;">
			<div style="width: 100%;float: left;" class="box-imgs">
				<img class="img-square" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['imagem'] ?>" />
			</div><!--box-imgs-->
			<div class="clear"></div>
			<div style="text-align: center;" class="group-btn">
				<a class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-imovel?id=<?php echo $id; ?>&deletarImagem=<?php echo $value['imagem'] ?>"><i class="far fa-trash-alt"></i> Excluir</a>
			</div><!--group-btn-->
			
			</div>
		</div><!--box-single-wraper-->
		<?php } ?>
	</div><!--boxes-->
</div>