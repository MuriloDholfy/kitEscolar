$(function() {
	  $(function() {
        $('.lazy').lazy();
	});
		
	 statuscart();
	 showCart();
	 
	if (CheckBrowser()) {
		if (localStorage.getItem('carrinho'))
		{
			//showCart();
		}
		else
		{
			$(".cartBody").empty();
			$(".cartmobileBody").empty();
			
		}
		
	}
	else{
		mensagemErro('Ops...','Seu navegador não suporta localStorage, utilize navegador com suporte a localstorage.');
		
	}
	
	$(".shopping-cart").mouseenter(function() {
		let cart =JSON.parse(localStorage.getItem('carrinho'));
		
		if (cart!=null)
		{
			
			if (cart.length>0)
			{
				$('.totalitemcart').removeClass('box infinite fadeIn');
				$('.cart-popup-container').addClass('cartativo').removeClass('cartinativo');
			}
			else
			{
				$('.cart-popup-container').addClass('cartinativo').removeClass('cartativo');
			}
			
		}
		
	}).mouseleave(function() {
		$('.cart-popup-container').addClass('cartinativo').removeClass('cartativo');
	});
});

function CheckBrowser() {
	if ('localStorage' in window && window['localStorage'] !== null) {
		
		return true;
	} else {
			return false;
	}
}
function addToCart() {
	let idcart =	localStorage.getItem('cartid');
	let item = {
					"codigomodal"		:$('#codigomodal').val(),
					"nomemodal"			:$('#nomemodal').val(),
					"tamanhomodal"		:$('#tamanhomodal').val(),
					"tipomodal"			:$('#tipomodal').val(),
					"precomodal"		:$('#precomodal').val(),
					"codigocart"		:idcart,
					"quantidademodal"	:$('#quantidademodal').val(),
					"imagemodal"		:$('#imagemodal').val(),
					"urlmodal"			:$('#urlmodal').val(),
					"datainclusaomodal"	:$('#datainclusaomodal').val()
					}
	
	saveitem(item);
}
function saveitem(produto)
{
	$.ajax({ 
		type      :'POST', 
		data	  : produto,
		dataType  :'json',
		url       :urlbasev3+'cart/salvaritem',
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
				
				let response =JSON.parse(JSON.stringify(data.data));
				localStorage.setItem('cartid',response.id);
				saveCart(response.cart);
				showCart();
				
				
				$('.btnadicionar').html('<i class="fa fa-shopping-bag" aria-hidden="true"></i> ADICIONAR');
				$('.btnadicionar').removeClass('disabledbtn');
				
				$('.btnfinalizar').html('<i class="fa fa-shopping-bag" aria-hidden="true"></i> Finalizar compra');
				$('.btnfinalizar').removeClass('disabledbtn');
				
				$('.btnfinalizarmobile').html('<i class="fa fa-shopping-bag" aria-hidden="true"></i> Finalizar Compra');
				$('.btnfinalizarmobile').removeClass('disabledbtn');
				$('.totalitemcart').addClass('box infinite fadeIn');
				$(".box").toggleClass("animated");
				
				$('#quickly').modal('hide');
				if ($('#compre-junto').length>0)
				{
					$('html, body').animate({
						scrollTop: $('#compre-junto').offset().top - 130
					}, 500,function (){
						var x = document.getElementById("snackbar");
						x.className = "show";
						setTimeout(function() {
							x.className = x.className.replace("show", "");
						}, 5000);
					});
				}
				else
				{
					var x = document.getElementById("snackbar");
						x.className = "show";
						setTimeout(function() {
							x.className = x.className.replace("show", "");
						}, 5000);
				}
				
				
			}
		}).fail(function(jqXHR, textStatus, error) { 
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
function updateToCart(codigo,quantidade,datainclusao,tamanho,tipo) {
	let idcart =	localStorage.getItem('cartid');
	let item = {
					"codigomodal"		:codigo,
					"tamanhomodal"		:tamanho,
					"tipomodal"			:tipo,
					"codigocart"		:idcart,
					"quantidademodal"	:quantidade,
					"datainclusaomodal"	:datainclusao
					}
	
	saveitem(item);
	
}
function excluiritem(produto)
{
	$.ajax({ 
		type      :'POST', 
		data	  : produto,
		dataType:"json",
		url       :urlbase+'cart/deletaritemmobile',
		beforeSend: function( xhr ) {
			
			$('.btn-success').addClass('disabledbtn');
			$('.btn-success').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="vertical-align: middle"> </span>');
		},
		success   : function(data) 
			{
				let response =JSON.parse(JSON.stringify(data.data));
				
				
				localStorage.setItem('cartid',response.id);
				saveCart(response.cart);
				showCart();
				$('.btn-success').html('Adicionar');
				$('.btn-success').removeClass('disabledbtn');
				
			}
		}).fail(function(jqXHR, textStatus, error) { 
			$('.btn-success').html('Adicionar');
			$('.btn-success').removeClass('disabledbtn');
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
function deleteItem(index){
	let idcart =	localStorage.getItem('cartid');
	let item = {indice:index,codigocart:idcart};
	excluiritem(item);
	
	
}

function saveCart(cart) {
	
	if (cart.length>0) {
		localStorage.setItem('carrinho',JSON.stringify(cart));
	}
	else
	{
		localStorage.setItem('carrinho',JSON.stringify(cart));
	}
		
}
function showCart() {
	let cartstore =JSON.parse(localStorage.getItem('carrinho'));
	let valorcupom=localStorage.getItem('cupomvalor');
	let cart = typeof cartstore === 'string' ? JSON.parse(cartstore) : cartstore;
	let totalcupom=0;
	
	if (cart ==null) {
		$(".cartBody").empty();
		
		$('#campocupom').val('');
		
		localStorage.setItem('cupomid','');
		localStorage.setItem('cupomvalor',0);
		let totalcart=0;
		let totalitem='';
		$('.totalitemcart').html(totalitem);
		$('.subitemtotal').html("Subtotal (0 itens): ");
		$('.totalcart').html(totalcart.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
		
		$('.cart-popup-container').addClass('cartinativo').removeClass('cartativo');
		return;
	}
	
	$(".cartBody").empty();
	$(".cartmobileBody").empty();
	$(".exibecupom").empty();
	let htmlcupom="";
	
	if (cart.length>0)
	{
		
		if (valorcupom==null)
		{
			totalcupom =0;
		}
		else
		{
			totalcupom=valorcupom;
			if (totalcupom>0)
			{
				let valorstringcupom =parseFloat(totalcupom).toLocaleString("pt-BR", { style: "currency" , currency:"BRL"});
				htmlcupom ='<input type="text" class="form-control pl-1" value="Cupom aplicado: -'+valorstringcupom+'" aria-label="Inserir cupom" aria-describedby="basic-addon2">';
				htmlcupom +='<div class="input-group-append bt-edit">';
				htmlcupom +='<span onclick="deletecupom()" class="input-group-text cupom-apl" >x</span>';
				htmlcupom +='</div>';
				$(".exibecupom").html(htmlcupom);
			}
			else
			{
				$(".exibecupom").empty();
			}
			
		}
		let totalitem =0;
		let totalcart =0; 
		let subtotal  =0;
		let precoitem =0;
		let stringtamanho ='';
		let totaluniforme =0;
		let totalmaterial =0;
		let quantidadeuniforme =0;
		let quantidadematerial =0;
		
		let codigovalidacao;
		for (var i in cart) {
			
			
			var item = cart[i];
			totalitem	=totalitem+parseInt(item.qtd);
			
			if (precoitem=='undefined')
			{
				precoitem	=0;
			}
			else
			{
				precoitem	=item.preco*parseInt(item.qtd);
			}
			
			
			totalcart 	=totalcart+(precoitem);
			
			
			stringtamanho ='';
			if (item.tamanhonome!='')
			{
				stringtamanho=' tamanho: '+item.tamanhonome;
			}
			if (item.codigokit)
			{
				codigovalidacao =item.codigokit;
			}
			else
			{
				codigovalidacao =item.id;
			}
			
			if (item.codigokit!=item.id && item.codigokit!=undefined)
			{
				totalitem=totalitem-item.qtd;
				quantidadematerial=quantidadematerial-item.qtd;
				if (item.tamanhonome!='' && item.tamanhonome!=null)
				{
					stringtamanho=' Tipo: '+item.tamanhonome;
				}
				
			}
			else
			{
				var somaPrecos 	= 0;
				let flagcart	=false;
				cartstore.forEach(function(produto) {
					
					if (produto.codigokit === item.codigokit && produto.datainclusao===item.datainclusao && produto.preco) {
						somaPrecos += parseFloat(produto.preco)*parseInt(produto.qtd); // Converte 'preco' para float e soma
						flagcart =true;
					}
				});
				var rowhtmlcart ="<li>"
						+'<a onclick="deleteItem('+i+')"  class="remove">x</a>'
								+'<a href="'+item.urlproduto+'" class="pull-left">'
									+'<img src="'+item.imagem+'" alt="'+item.nome+stringtamanho+'">'
								+'</a>'
								+'<h4><a href="'+item.urlproduto+'">'+item.nome+stringtamanho+'</a></h4>'
								+'<div class="product-quantity">'
										+'<div class="quantity">'
										+'<span class="minus"  onclick="deletecart(this)">-</span>'
										+'<input type="text" value="'+item.qtd+'" size="5" data-codigo="'+item.id+'" data-datacart="'+item.datainclusao+'" data-tamanhocart="'+item.tamanho+'"  data-tipocart="'+item.tipo+'">'
										+'<span class="plus" onclick="add(this)">+</span>'
									+'</div>'
								+'</div>'
								+'<span class="price">'+somaPrecos.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"})+'</span>'
								+'</li>';
			
			
				$(".cartBody").append(rowhtmlcart);
			
				var romhtmlcartmobile ='<li>'
											+'<a href="'+item.urlproduto+'" class="pull-left">'
												+'<img src="'+item.imagem+'" alt="'+item.nome+stringtamanho+'">'
											+'</a>'
											+'<h4><a href="'+item.urlproduto+'">'+item.nome+stringtamanho+'</a></h4>'
											+'<div class="product-quantity">'
												+'<div class="quantity">'
													+'<span class="minus" onclick="deletecart(this)">-</span>'
													+'<input type="text" value="'+item.qtd+'" size="5" data-codigo="'+item.id+'" data-datacart="'+item.datainclusao+'" data-tamanhocart="'+item.tamanho+'"  data-tipocart="'+item.tipo+'">'
													+'<span class="plus" onclick="add(this)">+</span>'
												+'</div>'
											+'</div>'
											+'<span class="price">'+somaPrecos.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"})+'</span>'
											+'<a onclick="deleteItem(' + i + ')" class="remove">x</a>'
										+'</li>';
				$(".cartmobileBody").append(romhtmlcartmobile);
			}
			
			
			if (item.atributopagamento==='cartaouniforme')
			{
				totaluniforme		=totaluniforme+precoitem;
				quantidadeuniforme  =quantidadeuniforme+parseInt(item.qtd);
			}
			else
			{
				totalmaterial		=totalmaterial+precoitem;
				quantidadematerial =quantidadematerial+parseInt(item.qtd);
			}
			
			
		}
		subtotal  =totalcart;
		
		
		
		totalcart =totalcart-totalcupom;
		$('.totalitemcart').html(totalitem);
		$('.subitemtotaluniforme').html("Uniforme ("+quantidadeuniforme+" itens): ");
		$('.subtotalcartuniforme').html(totaluniforme.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
		$('.subtotalcartmaterial').html(totalmaterial.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
		$('.subitemtotalmaterial').html("Material ("+quantidadematerial+" itens): ");
		$('.subitemtotal').html("Total ("+totalitem+" itens): ");
		$('.subtotalcart').html(subtotal.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
		$('.totalcart').html(totalcart.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
		$('.cartmobile').removeAttr('data-toggle');
		$('.cartmobile').removeAttr('data-target');
		$('.cartmobile').attr('href','https://kitescolarsaopaulo.com.br/finalizarcompra');

	}
	else
	{
		
		$(".cartBody").empty();
		$(".cartmobileBody").empty();
		let totalcart=0;
		let subtotal=0;
		let totalitem='';
		localStorage.setItem('cupomid','');
		localStorage.setItem('cupomvalor',0);
		$('.totalitemcart').html(totalitem);
		$('.subitemtotal').html("Subtotal (0 itens): ");
		$('.totalcart').html(totalcart.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
		$('.subtotalcart').html(subtotal.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
		$('.cartmobile').removeAttr('data-toggle');
		$('.cartmobile').removeAttr('data-target');
		$('.cart-popup-container').addClass('cartinativo').removeClass('cartativo');
		return;
	}

	
}
function deletecart(objeto)
{
	var a 	= $(objeto).parent().find("input");
	var id 			=a.attr('data-codigo');
	var datacart 	=a.attr('data-datacart');
	var tamanhocart =a.attr('data-tamanhocart');
	
	var tipocart 	=a.attr('data-tipocart');
	var quantidade  =parseInt(a.val())-1;
	var totaldelete =quantidade < 1 ? 1 : quantidade;
	updateToCart(id,totaldelete,datacart,tamanhocart,tipocart);
	return b = totaldelete < 1 ? 1 : totaldelete, a.val(totaldelete), a.change(), !1
}
function add(objeto)
{
	var a 	= $(objeto).parent().find("input");
	var id 			=a.attr('data-codigo');
	var datacart 	=a.attr('data-datacart');
	var tamanhocart =a.attr('data-tamanhocart');
	
	var tipocart 	=a.attr('data-tipocart');
	var quantidade  =parseInt(a.val())+1;
	
	updateToCart(id,quantidade,datacart,tamanhocart,tipocart);
	
	return a.val(parseInt(a.val()) + 1), a.change(), !1
}
function updatetipo(objeto,e)
{
	e.preventDefault();
	$('.tipoproduto').removeClass('bg-prime-active').addClass('bg-prime');
	$(objeto).addClass('bg-prime-active').removeClass('bg-prime');
	let valtipo =$(objeto).attr('data-codigo');
	$('#tipomodal').val(valtipo);
}
function updatetamanho(objeto,e)
{
	e.preventDefault();
	
	$('.tamanhoproduto').removeClass('bg-prime-active').addClass('bg-prime');
	$(objeto).addClass('bg-prime-active').removeClass('bg-prime');
	let valtipo =$(objeto).attr('data-codigo');
	
	$('#tamanhomodal').val(valtipo);
	
}
