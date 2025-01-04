$(document).ready(function(){
	$('#frm_contato').on('submit',function(e){
		
		e.preventDefault();
		$('.btncontato').addClass('disabledbtn');
		$('.btncontato').html('Aguarde <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="vertical-align: middle"> </span>');
				$.ajax({ 
				type      : 'POST', 
				url       : urlbase+'contato/salvar', 
				data      : $('#frm_contato').serialize(), 
				dataType  : 'json',
				beforeSend: function( xhr ) {
						
				},
				success   : function(data) 
					{
						$('#nomecontato').val('');
						$('#telefonecontato').val('');
						$('#emailcontato').val('');
						$('#mensagemcontato').val('');
						$('#termocontato').prop("checked", false);
						$('#contato').modal('hide');
						mensagemErro('Obrigado,',data.msg);
						$('.btncontato').removeClass('disabledbtn');
						$('.btncontato').html('Enviar →');
					}
				}).fail(function(jqXHR, textStatus, error) { 
					$('.btncontato').removeClass('disabledbtn');
					$('.btncontato').html('Enviar →');
					try{
						let response =JSON.parse(jqXHR.responseText);
						
						
						
						if (response.msg !== undefined)
						{
							mensagemErro('Erro',response.msg);
							
							
						}
						else
						{
							mensagemErro('Erro','Não foi possível enviar a sua solicitação.Entre em contato nos nossos canais de atendimento.');
							
							
						}
					}catch (e) {
						
						mensagemErro('Erro','Servidor indisponivel, entre em contato com o suporte ou tente novamente mais tarde.');
					}
					
				});
	});
	$('#frm_news').on('submit',function(e){
		
		e.preventDefault();
		$('.btnnews').addClass('disabledbtn');
		$('.btnnews').html('Aguarde <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="vertical-align: middle"> </span>');
				$.ajax({ 
				type      : 'POST', 
				url       : urlbase+'news/salvar', 
				data      : $('#frm_news').serialize(), 
				dataType  : 'json',
				beforeSend: function( xhr ) {
						
				},
				success   : function(data) 
					{
						mensagemErro('Obrigado,',data.msg);
						$('.btnnews').html('Enviado');
					}
				}).fail(function(jqXHR, textStatus, error) { 
					$('.btnnews').removeClass('disabledbtn');
					$('.btnnews').html('Enviar →');
					try{
						let response =JSON.parse(jqXHR.responseText);
						
						
						
						if (response.msg !== undefined)
						{
							mensagemErro('Erro',response.msg);
							
							
						}
						else
						{
							mensagemErro('Erro','Não foi possível cadastrar para receber novidades.Entre em contato nos nossos canais de atendimento.');
							
							
						}
					}catch (e) {
						
						mensagemErro('Erro','Servidor indisponivel, entre em contato com o suporte ou tente novamente mais tarde.');
					}
					
				});
	});
});
function abrirprodutos(urlredirect)
{
	window.location.href =urlredirect;
}
function statuscart()
{
	
	
	let idcart =	localStorage.getItem('cartid');
	
	if (idcart!=null)
	{
		
		var hours = 48; 
		var now = Date.now();
		var setupTime = localStorage.getItem('setupTime');
		
		if (setupTime == null) {
			 localStorage.setItem('setupTime', now);
		} else if (now - setupTime > hours*60*60*1000) {
			localStorage.clear()
			localStorage.setItem('setupTime', now);
			console.log('novo tempo');
			window.location.href ='https://kitescolarsaopaulo.com.br/';
			
		}
	}
}

