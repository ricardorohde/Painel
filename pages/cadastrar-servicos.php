<div class="box-content">
	<h2><i class="far fa-edit"></i> Adicionar Serviço</h2>

	<form method="post" enctype="multipart/form-data">
		<?php
			if(isset($_POST['acao'])){			
				if(Painel::insert($_POST)){
					Painel::alert('sucesso','Serviço cadastrado com sucesso.');
				}else{
					Painel::alert('erro','Os campos não podem ser vazios.');
				}			
			}
		?>

        <div class="form-group">
			<label>Descrição do serviço:</label>
			<textarea name="servico"></textarea>
		</div><!--form-group-->

		<div class="form-group">
			<input type="hidden" name="order_id" value="0">
			<input type="hidden" name="nome_tabela" value="site_servicos" />
			<input type="submit" name="acao" value="Cadastrar">
		</div><!--form-group-->
	</form>
</div><!--box-content-->
