<?php
	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$slide = Painel::select('site_slides','id = ?',array($id));
	}else{
		Painel::alert('erro','Você precisa passar o parametro ID.');
		die();
	}
?>

<div class="box-content">
	<h2><i class="far fa-edit"></i> Editar Slide</h2>

	<form method="post" enctype="multipart/form-data">

		<?php
			if(isset($_POST['acao'])){				
				$nome = $_POST['nome'];
				$imagem = $_FILES['imagem'];
				$imagem_atual = $_POST['imagem_atual'];
				
				if($imagem['name'] != ''){
					if(Painel::imagemValida($imagem)){
						Painel::deleteFile($imagem_atual);
						$imagem = Painel::uploadFile($imagem);
						$arr = ['nome'=>$nome,'slide'=>$imagem,'id'=>$id,'nome_tabela'=>'site_slides'];
						Painel::update($arr);
						$slide = Painel::select('site_slides','id = ?',array($id));
						Painel::alert('sucesso','Slide e imagem editados com sucesso.');
					}else{
						Painel::alert('erro','Formato de imagem inválido');
					}
				}else{
					$imagem = $imagem_atual;
					$arr = ['nome'=>$nome,'slide'=>$imagem,'id'=>$id,'nome_tabela'=>'site_slides'];
					Painel::update($arr);
					$slide = Painel::select('site_slides','id = ?',array($id));
					Painel::alert('sucesso','Slide editado com sucesso.');
				}
			}
		?>

		<div class="form-group">
			<label>Nome:</label>
			<input type="text" name="nome" required value="<?php echo $slide['nome']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<label>Imagem -</label>
			<input type="file" name="imagem"/>
			<input type="hidden" name="imagem_atual" value="<?php echo $slide['slide']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<input type="submit" name="acao" value="Atualizar">
		</div><!--form-group-->
	</form>
</div><!--box-content-->