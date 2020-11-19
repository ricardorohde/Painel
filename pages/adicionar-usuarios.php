<?php
	verificaPermissaoPagina(2);
?>
<div class="box-content">
	<h2><i class="fas fa-user-plus"></i> Adicionar Usuário</h2>

	<form method="post" enctype="multipart/form-data">
		<?php
			if(isset($_POST['acao'])){
				$login = $_POST['login'];
				$nome = $_POST['nome'];
				$senha = $_POST['password'];
				$imagem = $_FILES['imagem'];
				$cargo = $_POST['cargo'];

				if($login == ''){
					Painel::alert('erro','Login não pode ser vazio.');
				}else if($nome == ''){
					Painel::alert('erro','Nome não pode ser vazio.');
				}else if($senha == ''){
					Painel::alert('erro','Senha não pode ser vazia.');
				}else if($cargo == ''){
					Painel::alert('erro','Selecione um cargo.');
				}else{
					if($cargo >= $_SESSION['cargo']){
						Painel::alert('erro','O cargo deve ser menor que o seu.');
					}else if(Usuario::userExists($login)){
						Painel::alert('erro','Login já existente.');
					}else{
						$usuario = new Usuario();
						$imagem = Painel::uploadFile($imagem);
						$usuario->cadastrarUsuario($login,$senha,$imagem,$nome,$cargo);
						Painel::alert('sucesso',''.$login.' cadastrado com sucesso.');
					}
				}				
			}
		?>

		<div class="form-group">
			<label>Login:</label>
			<input type="text" name="login">
		</div><!--form-group-->

		<div class="form-group">
			<label>Nome:</label>
			<input type="text" name="nome">
		</div><!--form-group-->
		<div class="form-group">
			<label>Senha:</label>
			<input type="password" name="password">
		</div><!--form-group-->

		<div class="form-group">
			<label>Cargo:</label>
			<select name="cargo">
				<?php
					foreach (Painel::$cargos as $key => $value) {
						if($key < $_SESSION['cargo']) echo '<option value="'.$key.'">'.$value.'</option>';
					}
				?>
			</select>
		</div><!--form-group-->

		<div class="form-group">
			<label>Imagem</label>
			<input type="file" name="imagem"/>
		</div><!--form-group-->

		<div class="form-group">
			<input type="submit" name="acao" value="Cadastrar">
		</div><!--form-group-->
	</form>
</div><!--box-content-->