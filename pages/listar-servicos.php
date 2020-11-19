<?php
	if(isset($_GET['excluir'])){
		$idExcluir = intval($_GET['excluir']);
		Painel::deletar('site_servicos',$idExcluir);
		Painel::redirect(INCLUDE_PATH_PAINEL.'listar-servicos');
	}else if(isset($_GET['order']) && isset($_GET['id'])){
		Painel::orderItem('tb_site.servicos',$_GET['order'],$_GET['id']);
	}

	$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	$porPagina = 4;
	
	$servicos = Painel::selectAll('site_servicos',($paginaAtual - 1) * $porPagina,$porPagina);
	
?>
<div class="box-content">
	<h2><i class="far fa-list-alt"></i> Serviços Cadastrados</h2>
	<div class="wraper-table">
	<table>
		<tr>
			<td>Serviço</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>

		<?php
			foreach ($servicos as $key => $value) {
        ?>
        
		<tr>
			<td><?php echo $value['servico']; ?></td>
			<td><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-servico?id=<?php echo $value['id']; ?>"><i class="far fa-edit"></i> Editar</a></td>
			<td><a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-servicos?excluir=<?php echo $value['id']; ?>"><i class="far fa-trash-alt"></i> Excluir</a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-servicos?order=up&id=<?php echo $value['id'] ?>"><i class="fas fa-level-up-alt"></i></a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-servicos?order=down&id=<?php echo $value['id'] ?>"><i class="fas fa-level-down-alt"></i></a></td>
		</tr>
		<?php } ?>
	</table>
	</div>

	<div class="paginacao">
		<?php
			$totalPaginas = ceil(count(Painel::selectAll('site_servicos')) / $porPagina);
			for($i = 1; $i <= $totalPaginas; $i++){
				if($i == $paginaAtual)
					echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'listar-servicos?pagina='.$i.'">'.$i.'</a>';
				else
					echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-servicos?pagina='.$i.'">'.$i.'</a>';
			}
		?>
	</div><!--paginacao-->
</div><!--box-content-->