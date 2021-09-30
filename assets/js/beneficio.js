$(function(){
	var input_datavencimento = $('input#data_vencimento');

	carregarDatePicker();
	if(input_datavencimento.length > 0) {
		$("#data_vencimento").datepicker();
		$("#valor").maskMoney({symbol:'R$ ', showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
	} else {
		$('#menu_busca').find('input[type="text"]').eq(2).maskMoney({symbol:'R$ ', showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
		$('#menu_busca').find('input[type="text"]').eq(3).datepicker();
	}

	$('button.inserir_beneficio').click(function(){
		window.location.href="?controller=beneficio&method=inserir";
	});

	$('.conteudo_interno .beneficio').find('input[type="button"][value="SALVAR"]').click(function(){
		if(validabeneficio()){
			alert('beneficio salva com sucesso!!!');
			window.location.href="?controller=beneficio&method=index";
		}
    });

    /** botao excluir */
	$('button.beneficio_excluir').on('click', function(){
		var confirmar = confirm('Deseja mesmo excluir o Benefício selecionado?');

		if(confirmar){
			var id_beneficio=$(this).parent('td').parent('tr').children('td:first').children('input').val().trim();
			$.ajax({
				type:"POST",
				data:{id:id_beneficio},
				url:'?controller=beneficio&method=excluir',
				cache:'false',
				dataType:'json',
				beforeSend: function(){
					texto_retorno='<strong>Excluindo Benefício. Aguarde...</strong><br /><img src="assets/img/loader.gif" alt="Carregando" style="width:15%;" />';
					exibirAlertaCampo("#modal_valida_beneficio", '', texto_retorno);
				},
				complete:function(msg){
					if(msg.responseText=="excluiu"){
						setTimeout(function(){window.location.href="?controller=beneficio&method=index";}, 1000);
					}else{
						alert('Erro ao excluir a Benefício!!!');
					}
				}
			});
		}
	});

	/** botao editar */
	$('button.beneficio_editar').on('click', function(){
		var id_beneficio=$(this).parent('td').parent('tr').children('td:first').children('input').val().trim();
		window.location.href="?controller=beneficio&method=editar&identifier="+id_beneficio;
    });

    /** buscar/filtrar */
	$('button.buscar_beneficio').click(function(){
		var titulo=$('#menu_busca').find('input[type="text"]').eq(0).val().trim();
		var usuario=$('#menu_busca').find('input[type="text"]').eq(1).val().trim();
		var valor=$('#menu_busca').find('input[type="text"]').eq(2).val().trim();
		var data_vencimento=$('#menu_busca').find('input[type="text"]').eq(3).val().trim();
		if(usuario!=""||titulo!=""||valor!=""||data_vencimento!=""){
			window.location.href="?controller=beneficio&method=index&filtro_1="+usuario+"&filtro_2="+titulo+"&filtro_3="+valor+"&filtro_4="+data_vencimento;
		}else{
			window.location.href="?controller=beneficio&method=index";
		}
	});
});

function validabeneficio(){
	var valido=false;
	var texto_retorno="É preciso preencher o campo ";
	var titulo = $('.conteudo_interno .beneficio').find('input[name="titulo"]');
	var usuario_id = $('div.beneficio').find('select[name="usuario_id"]');
	var codigo = $('.conteudo_interno .beneficio').find('input[name="codigo"]');
	var operadora = $('div.beneficio').find('input[name="operadora"]');
	var tipo = $('div.beneficio').find('input[name="tipo"]');
	var valor = $('div.beneficio').find('input[name="valor"]');
	var data_vencimento = $('div.beneficio').find('input[name="data_vencimento"]');

	var beneficio_id=$('.conteudo_interno .beneficio').find('input[name="beneficio_id"]').val().trim();

	if(titulo.val().trim()==""){
		texto_retorno+="<strong>TÍTULO</strong>";
		exibirAlertaCampo("#modal_valida_beneficio", titulo, texto_retorno);
		valido=false;
	}else if(usuario_id.val().trim()==""){
		texto_retorno+="<strong>SELECIONE O USUÁRIO</strong>";
		exibirAlertaCampo("#modal_valida_beneficio", usuario_id, texto_retorno);
		valido=false;
	}else if(codigo.val().trim()==""){
		texto_retorno+="<strong>CÓDIGO</strong>";
		exibirAlertaCampo("#modal_valida_beneficio", codigo, texto_retorno);
		valido=false;
	}else if(operadora.val().trim()==""){
		texto_retorno+="<strong>OPERADORA</strong>";
		exibirAlertaCampo("#modal_valida_beneficio", operadora, texto_retorno);
		valido=false;
	}else if(tipo.val().trim()==""){
		texto_retorno+="<strong>TIPO</strong>";
		exibirAlertaCampo("#modal_valida_beneficio", tipo, texto_retorno);
		valido=false;
	}else if(valor.val().trim()==""){
		texto_retorno+="<strong>VALOR</strong>";
		exibirAlertaCampo("#modal_valida_beneficio", valor, texto_retorno);
		valido=false;
	}else if(data_vencimento.val().trim()==""){
		texto_retorno+="<strong>DATA DO VENCIMENTO</strong>";
		exibirAlertaCampo("#modal_valida_beneficio", data_vencimento, texto_retorno);
		valido=false;
	}else{
		var confirmar = confirm('Deseja mesmo inserir/atualizar a Benefício?');

		if(confirmar) {
			$.ajax({
				type:"POST",
				data:{
					beneficio_id:beneficio_id,
					titulo:titulo.val().trim(),
					usuario_id:usuario_id.val().trim(),
					codigo:codigo.val().trim(),
					operadora:operadora.val().trim(),
					tipo:tipo.val().trim(),
					valor:valor.val().trim(),
					data_vencimento:data_vencimento.val().trim()
				},
				url:'?controller=beneficio&method=salvar',
				cache:'false',
				dataType:'json',
				beforeSend: function(){
					texto_retorno="<strong>Salvando Dados da Benefício. Aguarde...</strong><br /><img src=\"assets/img/loader.gif\" alt=\"Carregando\" style=\"width:15%;\" />";
					exibirAlertaCampo("#modal_valida_beneficio", "", texto_retorno);
				},
				complete:function(msg){
					if(msg.responseText=="salvou"){
						valido=true;
					}else{
						valido=false;
					}

					if(valido){
						setTimeout(function(){window.location.href="?controller=beneficio&method=index";}, 1000);
					} else {
						alert('Erro ao salvar os Dados da Benefício!!!');
					}
				}
			});
		}
	}

	return valido;
}

function carregarDatePicker() {
	/* Brazilian initialisation for the jQuery UI date picker plugin. */
	/* Written by Leonildo Costa Silva (leocsilva@gmail.com). */
	(function( factory ) {
		if ( typeof define === "function" && define.amd ) {
			// AMD. Register as an anonymous module.
			define([ "../datepicker" ], factory );
		} else {
			// Browser globals
			factory( jQuery.datepicker );
		}
	}(function(datepicker) {
		datepicker.regional['pt-BR'] = {
			closeText: 'Fechar',
			prevText: 'Anterior',
			nextText: 'Próximo',
			currentText: 'Hoje',
			monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
			monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
			dayNames: ['Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado'],
			dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb'],
			dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb'],
			weekHeader: 'Sm',
			dateFormat: 'dd/mm/yy',
			firstDay: 0,
			isRTL: false,
			showMonthAfterYear: false,
			yearSuffix: '',
			selectYear: true,
			changeYear: true,
			yearRange: "1921:2021"
		};
		datepicker.setDefaults(datepicker.regional['pt-BR']);
		return datepicker.regional['pt-BR'];
	}));

	$("#data_nascimento").datepicker();
}