<?php
    $usuariosOnline = Painel::listarUsuariosOnline();

    $pegarVisitasTotais = MySql::conectar()->prepare("SELECT * FROM `admin_visits`");
    $pegarVisitasTotais->execute();
    $pegarVisitasTotais = $pegarVisitasTotais->rowCount();

    $pegarVisitasHoje = MySql::conectar()->prepare("SELECT * FROM `admin_visits` WHERE dia = ?");
    $pegarVisitasHoje->execute(array(date('Y-m-d')));
    $pegarVisitasHoje = $pegarVisitasHoje->rowCount();
?>

<div class="box-content w100">
    <h2>Painel de Controle - <?php echo NOME_EMPRESA ?></h2>
    <div class="box-metrics">
        <div class="metrics-single">
            <div class="metrics-wraper">
                <h2>Usuários online</h2>
                <p><?php echo count($usuariosOnline); ?></p>
            </div><!--metrics-wraper-->
        </div><!--metrics-single-->

        <div class="metrics-single">
            <div class="metrics-wraper">
                <h2>Total de visitas</h2>
                <p><?php echo $pegarVisitasTotais; ?></p>
            </div><!--metrics-wraper-->
        </div><!--metrics-single-->

        <div class="metrics-single">
            <div class="metrics-wraper">
                <h2>Visitas hoje</h2>
                <p><?php echo $pegarVisitasHoje; ?></p>
            </div><!--metrics-wraper-->
        </div><!--metrics-single-->
    </div><!--box-metrics-->
</div><!--box-content-->

<div class="box-content w100 left">
    <h2>Usuários online no site</h2>
    <div class="table-responsive">
        <div class="row">
            <div class="col">
                <span>IP</span>
            </div><!--col-->
            <div class="col">
                <span>Última ação</span>
            </div><!--col-->
            <div class="clear"></div>
        </div><!--row-->

        <?php
        foreach ($usuariosOnline as $key => $value){
        ?>

        <div class="row">
            <div class="col">
                <span><?php echo $value['ip'] ?></span>
            </div><!--col-->
            <div class="col">
                <span><?php echo date('d/m/Y H:i:s',strtotime($value['ultima_acao'])) ?></span>
            </div><!--col-->
            <div class="clear"></div>
        </div><!--row-->
        <?php } ?>
    </div><!--table-responsive-->
</div><!--box-content-->

<div class="box-content w100 right">
    <h2>Usuários do painel</h2>
    <div class="table-responsive">
        <div class="row">
        <div class="col">
				<span>Nome</span>
			</div><!--col-->
			<div class="col">
				<span>Cargo</span>
			</div><!--col-->
			<div class="clear"></div>
        </div><!--row-->
        
        <?php
            $usuariosPainel = MySql::conectar()->prepare("SELECT * FROM `admin_users`");
            $usuariosPainel->execute();
            $usuariosPainel = $usuariosPainel->fetchAll();
            foreach ($usuariosPainel as $key => $value){
        ?>

        <div class="row">
			<div class="col">
				<span><?php echo $value['nome'] ?></span>
			</div><!--col-->
			<div class="col">
				<span><?php echo pegaCargo($value['cargo']); ?></span>
			</div><!--col-->
			<div class="clear"></div>
		</div><!--row-->
		<?php } ?>
    </div><!--table-responsible-->
</div><!--box-content-->
<div class="clear"></div>