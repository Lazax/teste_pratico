<?php
$meses = array('1'=>'Janeiro', '2'=>'Fevereiro', '3'=>'Março', '4'=>'Abril', '5'=>'Maio', '6'=>'Junho', '7'=>'Julho', '8'=>'Agosto', '9'=>'Setembro', '10'=>'Outubro', '11'=>'Novembro', '12'=>'Dezembro');

if((int)$info_calendario['mes'] + 1 > 12):
	$proximo_mes = 1;
	$proximo_ano = $info_calendario['ano'] + 1;
else:
	$proximo_mes = (int)$info_calendario['mes'] + 1;
	$proximo_ano = $info_calendario['ano'];
endif;

if((int)$info_calendario['mes'] - 1 < 1):
	$mes_anterior = 12;
	$ano_anterior = $info_calendario['ano'] - 1;
else:
	$mes_anterior = (int)$info_calendario['mes'] - 1;
	$ano_anterior = $info_calendario['ano'];
endif;
?>
<div class="agenda_top_bar">
	<label>Agenda de Atividades / Lista de Atividades</label>
</div>

<div class="container">
	<?php echo $this->Session->flash(); ?>
	
	<div class="row col-md-12">
		<div id='js-ajax_salvando' class="pull-left ajax_salvando">
			<img src="<?php echo Router::url('/', true);?>app/webroot/img/ajax-loader.gif" />
			<label></label>
		</div>
		<div id='js-ajax_retorno' class="pull-left ajax_salvando"><label></label></div>

		<?php echo $this->Html->link('nova atividade', array('controller'=>'atividades', 'action'=>'gerenciarAtividade'), array('class'=>'btn btn-primary pull-right')); ?>
	</div>

	<div class="row col-md-12">
		<a href="<?php echo Router::url('/', true).'atividades/index/'.$mes_anterior.'/'.$ano_anterior; ?>" class="pull-left">
			<h3><< <?php echo $meses[$mes_anterior]; ?></h3>
		</a>
		<a href="<?php echo Router::url('/', true).'atividades/index/'.$proximo_mes.'/'.$proximo_ano; ?>" class="pull-right">
			<h3><?php echo $meses[$proximo_mes]; ?> >></h3>
		</a>
	</div>

	<div class="row col-md-12" >
		<input id='js-mes' type='hidden' value='<?php echo $info_calendario['mes']; ?>' />
		<input id='js-ano' type='hidden' value='<?php echo $info_calendario['ano']; ?>' />

		<ul id='js-calendario' class="list-inline calendario">
			<?php 
			$qtd_dias = 1;

			while ($info_calendario['qtd_dias'] >= $qtd_dias): 
			?>
				<li id='<?php echo $qtd_dias; ?>'>
					<div class="container_atividades">
						<?php 
						if(isset($lista_atividades[$qtd_dias])): 
							foreach ($lista_atividades[$qtd_dias] as $key => $atividade):
						?>
							<div class="atividade" atividade-id="<?php echo $atividade['id']; ?>" >
								<?php echo substr($atividade['titulo'], 0, 7).'...'; ?>
								<span class="glyphicon glyphicon-trash pull-right excluir_atividade"></span>
								<a href="<?php echo Router::url('/', true)."atividades/gerenciarAtividade/".$atividade['id']; ?>">
								<span class="glyphicon glyphicon-pencil pull-right editar_atividade"></span>
								</a>
							</div>
						<?php 
							endforeach;
						endif; 
						?>
					</div>
					<div>
						<h2 class="calendario_dia"><?php echo $qtd_dias; ?></h2>
					</div>
				</li>
			<?php 
				++$qtd_dias;
			endwhile; 
			?>
		</ul>
	</div>
</div>