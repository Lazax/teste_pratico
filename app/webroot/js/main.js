jQuery(function() {
	jQuery( ".atividade" ).draggable({ 
		revert: "invalid",
		helper: "clone"
	});
	
	jQuery("#js-calendario li").droppable({
  		drop: function( event, ui ) {
			ajaxRemanejarAtividade(ui.draggable, event.target.id);
  		}
	});

	jQuery('#js-data').datepicker($.datepicker.regional[ "pt" ]);

	eventoExcluirAtividade();	
});

function eventoExcluirAtividade(){
	jQuery('.excluir_atividade').on('click', function(){
		if(confirm('Deseja excluir esta atividade?')){
			var $atividade = jQuery(this).parent();
			var atividade_id = $atividade.attr('atividade-id');

			jQuery.ajax({
				url: router_url+'atividades/ajaxExcluirAtividade/'+atividade_id,
				dataType: 'json',
				beforeSend: function(){
					jQuery('#js-ajax_salvando label').html('Excluindo...').parent().show();
					jQuery('#js-ajax_retorno').hide();
					$atividade.fadeOut();
				}
			}).done(function(data){
				var mensagem_retorno = null

				if(data == 'true'){
					mensagem_retorno = 'Atividade excluida com sucesso!';
				}else{
					mensagem_retorno = 'Ocorreu um erro. Tente novamente.';
				}
				jQuery('#js-ajax_salvando').hide();
				jQuery('#js-ajax_retorno').html('<label>'+mensagem_retorno+'</label>').show();
			});
		}
	});
}

function deletarAtividade($item, container_id){
	$item.fadeOut(function(){
		$item_clone = $(this);
		$item_clone.appendTo($('#'+container_id+" .container_atividades")).fadeIn();
	});
}

function ajaxRemanejarAtividade($item, container_id){
	var atividade_id = $item.attr('atividade-id');
	var dia = jQuery('#'+container_id).attr('id');
	var mes = jQuery('#js-mes').val();
	var ano = jQuery('#js-ano').val();
	var nova_data = ano+'-'+mes+'-'+dia;

	jQuery.ajax({
		url: router_url+'atividades/ajaxRemanejarAtividade/'+atividade_id+'/'+nova_data,		
		dataType: 'json',
		beforeSend: function(){
			jQuery('#js-ajax_salvando label').html('Salvando...').parent().show();
			jQuery('#js-ajax_retorno').hide();
		}
	}).done(function(data){
		var mensagem_retorno = null;

		if(data == 'true'){
			mensagem_retorno = 'Atividade remanejada com sucesso!';
		}else{
			mensagem_retorno = 'Ocorreu um erro. Tente novamente.';
		}
		jQuery('#js-ajax_salvando').hide();
		jQuery('#js-ajax_retorno').html('<label>'+mensagem_retorno+'</label>').show();
	});

	deletarAtividade($item, container_id);
}