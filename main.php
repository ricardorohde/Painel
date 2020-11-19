<?php
    if(isset($_GET['logout'])){
        Painel::logout();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL ?>css/all.min.css">
	<link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL; ?>css/jquery-ui.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/stefangabos/Zebra_Datepicker/dist/css/default/zebra_datepicker.min.css">
	<link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL ?>css/style.css">
    <title>Painel de controle</title>
</head>

<body>
<base base="<?php echo INCLUDE_PATH_PAINEL; ?>" />
<div class="menu">
	<div class="menu-wraper">
	<div class="box-usuario">
		<?php
			if($_SESSION['img'] == ''){
		?>
			<div class="user-pic">
				<i class="fa fa-user"></i>
			</div><!--user-pic-->
		<?php }else{ ?>
			<div class="imagem-usuario">
				<img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $_SESSION['img']; ?>" />
			</div><!--user-pic-->
		<?php } ?>
		<div class="user-name">
			<p><?php echo $_SESSION['nome']; ?></p>
			<p><?php echo pegaCargo($_SESSION['cargo']); ?></p>
		</div><!--user-name-->
	</div><!--box-usuario-->
	
	<div class="items-menu">
		<h2>Cadastro</h2>
		<a <?php selecionadoMenu('cadastrar-depoimentos'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-depoimentos">Cadastrar Depoimentos</a>
		<a <?php selecionadoMenu('cadastrar-servicos'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-servicos">Cadastrar Serviços</a>
		<a <?php selecionadoMenu('cadastrar-slides'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-slides">Cadastrar Slides</a>
		<h2>Gestão</h2>
		<a <?php selecionadoMenu('listar-depoimentos'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-depoimentos">Listar Depoimentos</a>
		<a <?php selecionadoMenu('listar-servicos'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-servicos">Listar Serviços</a>
		<a <?php selecionadoMenu('listar-slides'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-slides">Listar Slides</a>
		<h2>Administração do painel</h2>
		<a <?php selecionadoMenu('editar-usuarios'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>editar-usuarios">Editar Usuário</a>
		<a <?php selecionadoMenu('adicionar-usuarios'); ?> <?php verificaPermissaoMenu(2); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>adicionar-usuarios">Adicionar Usuários</a>
		<h2>Configuração geral</h2>
		<a <?php selecionadoMenu('editar-site'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>editar-site">Editar Site</a>
		<h2>Gestão de notícias</h2>
		<a <?php selecionadoMenu('cadastrar-categorias'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-categorias">Cadastrar Categorias</a>
		<a <?php selecionadoMenu('gerenciar-categorias'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-categorias">Gerenciar Categorias</a>
		<a <?php selecionadoMenu('cadastrar-noticias'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-noticias">Cadastrar Notícias</a>
		<a <?php selecionadoMenu('gerenciar-noticias'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-noticias">Gerenciar Notícias</a>
		<h2>Gestão de clientes</h2>
		<a <?php selecionadoMenu('cadastrar-clientes'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-clientes">Cadastrar Clientes</a>
		<a <?php selecionadoMenu('gerenciar-clientes'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-clientes">Gerenciar Clientes</a>
		<h2>Controle Financeiro</h2>
		<a <?php selecionadoMenu('visualizar-pagamentos'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>visualizar-pagamentos">Visualizar Pagamentos</a>
		<h2>Controle Estoque</h2>
		<a <?php selecionadoMenu('cadastrar-produtos'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-produtos">Cadastrar Produtos</a>
		<a <?php selecionadoMenu('visualizar-produtos'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>visualizar-produtos">Visualizar Produtos</a>
		<h2>Gestão Imóveis</h2>
		<a <?php selecionadoMenu('cadastrar-empreendimento'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-empreendimento">Cadastrar Empreendimento</a>
		<a <?php selecionadoMenu('listar-empreendimentos'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-empreendimentos">Listar Empreendimentos</a>
	</div><!--items-menu-->
	</div><!--menu-wraper-->
</div><!--menu-->

<header>
	<div class="container">
		<div class="menu-btn">
			<i class="fa fa-bars"></i>			
		</div><!--menu-btn-->

		<div class="logout">
			<a <?php if(@$_GET['url'] == ''){ ?>  <?php } ?> href="<?php echo INCLUDE_PATH_PAINEL ?>"> <i class="fas fa-home"></i> <span>Página Inicial</span></a>
			<a <?php if(@$_GET['url'] == 'agenda'){ ?>  <?php } ?> href="<?php echo INCLUDE_PATH_PAINEL ?>agenda"> <i class="fas fa-calendar-alt"></i> <span>Agenda</span></a>
			<a <?php if(@$_GET['url'] == 'chat'){ ?>  <?php } ?> href="<?php echo INCLUDE_PATH_PAINEL ?>chat"> <i class="fas fa-comments"></i> <span>Chat</span></a>
			<a href="<?php echo INCLUDE_PATH_PAINEL ?>?logout"> <i class="fa fa-window-close"></i> <span>Sair</span></a>
		</div><!--logout-->
		<div class="clear"></div>
	</div>
</header>

<div class="content">
	<?php Painel::carregarPagina(); ?>
</div><!--content-->

<script src="<?php echo INCLUDE_PATH_PAINEL ?>js/jquery.js"></script>
<?php Painel::loadJS(array('jquery-ui.min.js'),'listar-empreendimentos'); ?>
<script src="https://cdn.jsdelivr.net/gh/stefangabos/Zebra_Datepicker/dist/zebra_datepicker.min.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL ?>js/jquery.maskMoney.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL ?>js/jquery.mask.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL ?>js/jquery.ajaxform.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL ?>js/constants.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL ?>js/main.js"></script>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>
  	tinymce.init({ 
	selector:'.tinymce',
	plugins: "image",
	height:300
});
</script>
<script src="<?php echo INCLUDE_PATH_PAINEL ?>js/helperMask.js"></script>
<?php Painel::loadJS(array('ajax.js'),'gerenciar-clientes'); ?>
<?php Painel::loadJS(array('ajax.js'),'cadastrar-clientes'); ?>
<?php Painel::loadJS(array('ajax.js'),'editar-clientes'); ?>
<?php Painel::loadJS(array('controleFinanceiro.js'),'editar-clientes'); ?>
<?php Painel::loadJS(array('empreendimentos.js'),'listar-empreendimentos'); ?>
<?php Painel::loadJS(array('chat.js'),'chat'); ?>
<?php Painel::loadJS(array('agenda.js'),'agenda'); ?>
</body>
</html>