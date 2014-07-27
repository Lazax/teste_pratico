<div class="agenda_top_bar">
	<label>Agenda de Atividades / Cadastro</label>
</div>

<div class="container">

	<div class="row col-md-12">
		<h1 class="titulo_pagina">Cadastro de Atividades</h1>
	</div>

	<div class="row col-md-12" >
		<?php echo $this->Form->create('Atividade', array('method'=>'post')); ?>
			<?php echo isset($atividade_id) ? $this->Form->input('id', array('type'=>'hidden')) : ''; ?>

			<div class="form-group">
			    <?php echo $this->Form->input('titulo', array('class'=>'form-control', 'placeholder'=>'informe o nome da atividade')); ?>
			</div>
		  	<div class="form-group">
		    	<?php echo $this->Form->input('data', array('type'=>'text', 'id'=>'js-data', 'class'=>'form-control', 'placeholder'=>'informe a data da atividade')); ?>
		 	</div>
		  	<div class="form-group">
		    	<?php echo $this->Form->input('descricao', array('type'=>'textarea', 'rows'=>'3', 'class'=>'form-control', 'placeholder'=>'informe a data da atividade')); ?>
		  	</div>
		<?php echo $this->Form->end(array('label'=>'Cadastrar', 'class'=>'btn btn-default')); ?>
	</div>

</div>