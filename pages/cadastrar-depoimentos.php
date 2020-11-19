<div class="box-content">
    <h2><i class="far fa-edit"></i> Adicionar depoimentos</h2>

    <form method="post" enctype="multipart/form-data">
        <?php
            if(isset($_POST['acao'])){
                if(Painel::insert($_POST)){
                    Painel::alert('sucesso','Depoimento cadastrado com sucesso');
                }else{
                    Painel::alert('erro','O campo não pode ser vazio.');
                }
            }
        ?>

        <div class="form_group">
            <label>Nome da pessoa:</label>
            <input type="text" name="nome">
        </div><!--form-group-->

        <div class="form_group">
            <label>Depoimento:</label>
            <textarea name="depoimento"></textarea>
        </div><!--form-group-->

        <div class="form_group">
            <label>Data:</label>
            <input formato="data" type="text" name="data">
        </div><!--form-group-->

        <div class="form_group">
            <input type="hidden" name="order_id" value="0">
            <input type="hidden" name="nome_tabela" value="site_depoimentos">
            <input type="submit" name="acao" value="Cadastrar">
        </div><!--form-group-->
    </form>
</div><!--box-content-->