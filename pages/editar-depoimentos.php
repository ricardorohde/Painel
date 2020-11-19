<?php 
	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$depoimento = Painel::select('site_depoimentos','id = ?',array($id));
	}else{
		Painel::alert('erro','Você precisa passar o parametro ID.');
		die();
	}
 ?>

<div class="box-content">
	<h2><i class="far fa-edit"></i> Editar Depoimentos</h2>

	<form method="post" enctype="multipart/form-data">
		<?php
			if(isset($_POST['acao'])){
				if(Painel::update($_POST)){
					Painel::alert('sucesso','Depoimento editado com sucesso.');
					$depoimento = Painel::select('site_depoimentos','id = ?',array($id));
				}else{
					Painel::alert('erro','Os campos não podem ser vazios.');
				}
			}
		?>

		<div class="form-group">
			<label>Nome da pessoa:</label>
			<input type="text" name="nome" value="<?php echo $depoimento['nome']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<label>Depoimento:</label>
			<textarea name="depoimento"><?php echo $depoimento['depoimento']; ?></textarea>
		</div><!--form-group-->

		<div class="form-group">
			<label>Data:</label>
			<input formato="data" type="text" name="data" value="<?php echo $depoimento['data']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type="hidden" name="nome_tabela" value="site_depoimentos" />
			<input type="submit" name="acao" value="Atualizar">
		</div><!--form-group-->
	</form>
</div><!--box-content-->