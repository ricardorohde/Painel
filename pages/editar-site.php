<?php 
	$site = Painel::select('site_config',false);
?>

<div class="box-content">
	<h2><i class="far fa-edit"></i> Editar Configurações do Site</h2>

	<form method="post" enctype="multipart/form-data">
		<?php
			if(isset($_POST['acao'])){
				if(Painel::update($_POST,true)){
					Painel::alert('sucesso','Site editado com sucesso.');
					$site = Painel::select('site_config',false);
				}else{
					Painel::alert('erro','Os campos não podem ser vazios.');
				}
			}
		?>

		<div class="form-group">
			<label>Título do site:</label>
			<input type="text" name="titulo" value="<?php echo $site['titulo'] ?>" />
		</div><!--form-group-->

		<div class="form-group">
			<label>Nome do autor do site:</label>
			<input type="text" name="nome_autor" value="<?php echo $site['nome_autor'] ?>" />
		</div><!--form-group-->

		<div class="form-group">
			<label>Descrição do autor do site:</label>
			<textarea name="descricao"><?php echo $site['descricao']; ?></textarea>
		</div><!--form-group-->

		<?php
			for($i = 1; $i <= 3; $i++){
		?>

		<div class="form-group">
			<label>Ícone <?php echo $i; ?>:</label>
			<input type="text" name="icone<?php echo $i; ?>" value="<?php echo $site['icone'.$i] ?>" />
		</div><!--form-group-->

		<div class="form-group">
			<label>Descrição do ícone <?php echo $i; ?>:</label>
			<textarea name="descricao<?php echo $i; ?>"><?php echo $site['descricao'.$i]; ?></textarea>
		</div><!--form-group-->
		<?php } ?>
		
		<div class="form-group">
			<input type="hidden" name="nome_tabela" value="site_config" />
			<input type="submit" name="acao" value="Atualizar">
		</div><!--form-group-->
	</form>
</div><!--box-content-->