<?php
	if(isset($_GET['excluir'])){
		$idExcluir = intval($_GET['excluir']);
		Painel::deletar('site_categorias',$idExcluir);
		$noticias = MySql::conectar()->prepare("SELECT * FROM `site_noticias` WHERE categoria_id = ?");
		$noticias->execute(array($idExcluir));
		$noticias = $noticias->fetchAll();
		foreach ($noticias as $key => $value) {
			$imgDelete = $value['capa'];
			Painel::deleteFile($imgDelete);
		}
		$noticias = MySql::conectar()->prepare("DELETE FROM `site_noticias` WHERE categoria_id = ?");
		$noticias->execute(array($idExcluir));
		Painel::redirect(INCLUDE_PATH_PAINEL.'gerenciar-categorias');
	}else if(isset($_GET['order']) && isset($_GET['id'])){
		Painel::orderItem('site_categorias',$_GET['order'],$_GET['id']);
	}

	$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	$porPagina = 4;	
	$categorias = Painel::selectAll('site_categorias',($paginaAtual - 1) * $porPagina,$porPagina);	
?>

<div class="box-content">
	<h2><i class="far fa-edit"></i> Categorias Cadastradas</h2>
	<div class="wraper-table">
	<table>
		<tr style="background-color: rgb(65, 65, 189); border-bottom: 2px solid rgb(51, 51, 124); color: white;">
			<td>Nome</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>

		<?php
			foreach ($categorias as $key => $value) {
        ?>
        
		<tr>
			<td><?php echo $value['nome']; ?></td>
			<td><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-categoria?id=<?php echo $value['id']; ?>"><i class="far fa-edit"></i> Editar</a></td>
			<td><a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-categorias?excluir=<?php echo $value['id']; ?>"><i class="far fa-trash-alt"></i> Excluir</a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-categorias?order=up&id=<?php echo $value['id'] ?>"><i class="fas fa-level-up-alt"></i></a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-categorias?order=down&id=<?php echo $value['id'] ?>"><i class="fas fa-level-down-alt"></i></a></td>
		</tr>

		<?php } ?>
	</table>
	</div><!--wrap-->

	<div class="paginacao">
		<?php
			$totalPaginas = ceil(count(Painel::selectAll('site_categorias')) / $porPagina);
			for($i = 1; $i <= $totalPaginas; $i++){
				if($i == $paginaAtual)
					echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'gerenciar-categorias?pagina='.$i.'">'.$i.'</a>';
				else
					echo '<a href="'.INCLUDE_PATH_PAINEL.'gerenciar-categorias?pagina='.$i.'">'.$i.'</a>';
			}
		?>
	</div><!--paginacao-->
</div><!--box-content-->