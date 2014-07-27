
<div class="agenda_top_bar">
	<label>Agenda de Atividades / Lista de Atividades</label>
</div>

<div class="container">

	<div class="row col-md-12">
		<div id='js-ajax_salvando' class="pull-left ajax_salvando">
			<img src="<?php echo Router::url('/', true);?>app/webroot/img/ajax-loader.gif" />
			<label>Salvando...</label>
		</div>
		<div id='js-ajax_retorno' class="pull-left ajax_salvando"><label></label></div>

		<?php echo $this->Html->link('nova atividade', array('controller'=>'atividades', 'action'=>'gerenciarAtividade'), array('class'=>'btn btn-primary pull-right')); ?>
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
								<?php echo $atividade['titulo']; ?>
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