
$(document).ready(function(){
	$('.buscarcupom').on('click',function(e){
		e.preventDefault();
		let idcart =	localStorage.getItem('cartid');
		let item = {
					"codigocart"		:idcart,
					"cupomdesconto"		:$('#cupomdesconto').val()
					}
	
		savecupom(item);
	})
	$('.buscarcupommobile').on('click',function(e){
		e.preventDefault();
		let idcart =	localStorage.getItem('cartid');
		let item = {
					"codigocart"		:idcart,
					"cupomdesconto"		:$('#cupomdescontomobile').val()
					}
	
		savecupom(item);
	})
})
function savecupom(produto)
{
	$.ajax({ 
		type      :'POST', 
		data	  : produto,
		dataType:"json",
		url       :urlbase+'cupom/buscar',
		beforeSend: function( xhr ) {
			
			$('.btnadicionar').addClass('disabledbtn');
			$('.btnadicionar').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="vertical-align: middle"> </span>');
			
			$('.btnfinalizar').addClass('disabledbtn');
			$('.btnfinalizar').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="vertical-align: middle"> </span>');
			$('.btnfinalizarmobile').addClass('disabledbtn');
			$('.btnfinalizarmobile').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="vertical-align: middle"> </span>');
		},
		success   : function(data) 
			{
				
				
				$('.campocupom').val('').change();
				localStorage.setItem('cupomid',data.data.codigocupom);
				localStorage.setItem('cupomvalor',data.data.valocupom);
				showCart();
				$('.btnadicionar').html('<i class="fa fa-shopping-bag" aria-hidden="true"></i> ADICIONAR');
				$('.btnadicionar').removeClass('disabledbtn');
				
				$('.btnadicionar').html('<i class="fa fa-shopping-bag" aria-hidden="true"></i> ADICIONAR');
				$('.btnadicionar').removeClass('disabledbtn');
				
				$('.btnfinalizar').html('<i class="fa fa-shopping-bag" aria-hidden="true"></i> Finalizar compra');
				$('.btnfinalizar').removeClass('disabledbtn');
				
				$('.btnfinalizarmobile').html('<i class="fa fa-shopping-bag" aria-hidden="true"></i> Finalizar Compra');
				$('.btnfinalizarmobile').removeClass('disabledbtn');
				
			}
		}).fail(function(jqXHR, textStatus, error) { 
			$('.btnadicionar').html('<i class="fa fa-shopping-bag" aria-hidden="true"></i> ADICIONAR');
			$('.btnadicionar').removeClass('disabledbtn');
			
			$('.btnadicionar').html('<i class="fa fa-shopping-bag" aria-hidden="true"></i> ADICIONAR');
			$('.btnadicionar').removeClass('disabledbtn');
			
			$('.btnfinalizar').html('<i class="fa fa-shopping-bag" aria-hidden="true"></i> Finalizar compra');
			$('.btnfinalizar').removeClass('disabledbtn');
			
			$('.btnfinalizarmobile').html('<i class="fa fa-shopping-bag" aria-hidden="true"></i> Finalizar Compra');
			$('.btnfinalizarmobile').removeClass('disabledbtn');
			try{
				let response =JSON.parse(jqXHR.responseText);
				if (response.msg !== undefined)
				{
					mensagemErro('Erro',response.msg);
				}
				else
				{
					mensagemErro('Ops...','Não foi possível executar sua solicitação, etrne em contato em nossos canais de atendimento.');
				}
			}catch (e) {
					mensagemErro('Ops...','Erro ao executar sua solicitação, etrne em contato em nossos canais de atendimento.');
					
				}
			
			
		});
}
function deletecupom()
{
	let idcart =	localStorage.getItem('cartid');
	let cupom = {
					"codigocart"		:idcart,
				}
	$.ajax({ 
		type      	:'DELETE', 
		data	  	: cupom,
		contentType	:"application/json; charset=utf-8",
		dataType	:"json",
		url       	:urlbase+'cupom/deletarcupom',
		beforeSend: function( xhr ) {
			
			$('.btnadicionar').addClass('disabledbtn');
			$('.btnadicionar').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="vertical-align: middle"> </span>');
			
			$('.btnfinalizar').addClass('disabledbtn');
			$('.btnfinalizar').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="vertical-align: middle"> </span>');
			$('.btnfinalizarmobile').addClass('disabledbtn');
			$('.btnfinalizarmobile').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="vertical-align: middle"> </span>');
		},
		success   : function(data) 
			{
				
				
				localStorage.setItem('cupomid','');
				localStorage.setItem('cupomvalor',0);
				showCart();
				$('.btn-success').html('Adicionar');
				$('.btn-success').removeClass('disabledbtn');
				$('.btnfinalizar').html('<i class="fa fa-shopping-bag" aria-hidden="true"></i> Finalizar compra');
				$('.btnfinalizar').removeClass('disabledbtn');
				
				$('.btnfinalizarmobile').html('<i class="fa fa-shopping-bag" aria-hidden="true"></i> Finalizar Compra');
				$('.btnfinalizarmobile').removeClass('disabledbtn');
			}
		}).fail(function(jqXHR, textStatus, error) { 
			$('.btn-success').html('Adicionar');
			$('.btn-success').removeClass('disabledbtn');
			$('.btnfinalizar').html('<i class="fa fa-shopping-bag" aria-hidden="true"></i> Finalizar compra');
			$('.btnfinalizar').removeClass('disabledbtn');
			
			$('.btnfinalizarmobile').html('<i class="fa fa-shopping-bag" aria-hidden="true"></i> Finalizar Compra');
			$('.btnfinalizarmobile').removeClass('disabledbtn');
			try{
				let response =JSON.parse(jqXHR.responseText);
				if (response.msg !== undefined)
				{
				    mensagemErro('Erro',response.msg);
					alert(response.msg);
				}
				else
				{
					mensagemErro('Ops...','Não foi possível executar sua solicitação, etrne em contato em nossos canais de atendimento.');
					
					
				}
			}catch (e) {
					mensagemErro('Ops...','Erro ao executar sua solicitação, etrne em contato em nossos canais de atendimento.');
					
				}
			
			
		});
}
