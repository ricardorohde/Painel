<div class="box-content">
    <h2><i class="far fa-edit"></i> Cadastrar categoria</h2>

    <form method="post" enctype="multipart/form-data">
        <?php
            if(isset($_POST['acao'])){
                $nome = $_POST['nome'];
                if($nome == ''){
                    Painel::alert('erro','Nome não pode ser vazio');
                }else{
                    $verificar = MySql::conectar()->prepare("SELECT * FROM `site_categorias` WHERE nome = ?");
                    $verificar->execute(array($_POST['nome']));
                    if($verificar->rowCount() == 0){
                        $slug = Painel::generateSlug($nome);
                        $arr = ['nome'=>$nome,'slug'=>$slug,'order_id'=>'0','nome_tabela'=>'site_categorias'];
                        Painel::insert($arr);
                        Painel::alert('sucesso','Cadastro realizado com sucesso.');
                    }else{
                        Painel::alert('erro', 'Nome da categoria já existe.');
                    }
                }
            }
        ?>

        <div class="form-group">
            <label>Nome da categoria:</label>
            <input type="text" name="nome">
        </div><!--form-group-->

        <div class="form-group">
            <input type="submit" name="acao" value="Cadastrar">
        </div><!--form-group-->

    </form>
</div><!--box-content-->