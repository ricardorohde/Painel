<?php 
	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$servico = Painel::select('site_servicos','id = ?',array($id));
	}else{
		Painel::alert('erro','Você precisa passar o parametro ID.');
		die();
	}
 ?>

<div class="box-content">
	<h2><i class="far fa-edit"></i> Editar Serviços</h2>

	<form method="post" enctype="multipart/form-data">
		<?php
			if(isset($_POST['acao'])){
				if(Painel::update($_POST)){
					Painel::alert('sucesso','Serviço editado com sucesso.');
					$servico = Painel::select('site_servicos','id = ?',array($id));
				}else{
					Painel::alert('erro','Os campos não podem ser vazios.');
				}
			}
		?>

		<div class="form-group">
			<label>Servico:</label>
			<textarea name="servico"><?php echo $servico['servico']; ?></textarea>
		</div><!--form-group-->

		<div class="form-group">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type="hidden" name="nome_tabela" value="site_servicos" />
			<input type="submit" name="acao" value="Atualizar!">
		</div><!--form-group-->
	</form>
</div><!--box-content-->