$(document).ready(function(){
	
	$('.videoyoutube').on('click',function(e){
		
		e.preventDefault();
		let urlvideo =$(this).attr('data-urlvideo');
		window.open(urlvideo,"Vídeo","width=800, height=600, directories=no, location=no, menubar=no,scrollbars=no, status=no, toolbar=no, resizable=no")
	});
	$('.tipoproduto').on('click',function(e){
		
		
	})
	$('#quickly').on('show.bs.modal', function (event) {
		
		$('#codigomodal').val('');
		$('#nomemodal').val('');
		$('#tamanhomodal').val('');
		$('#tamanhonomemodal').val('');
		$('#tipomodal').val('');
		$('#precomodal').val('');
		$('#quantidademodal').val('');
		$('#imagemodal').val('');
		$('#urlmodal').val('');
		$('#datainclusaomodal').val('');
		let button = $(event.relatedTarget);
		let id = button.data('whatever');
		let modal = $(this);
		modalaguarde('modalfallbackerro');
		modal.find('.product-information').hide();
		$.ajax({ 
			type      : 'GET', 
			url       : urlbase+'buscarprodutos/getproduto?codigo='+id,
			dataType  : 'json',
			beforeSend: function( xhr ) {
				$('#codigomodal').val('');
				$('#nomemodal').val('');
				$('#tamanhomodal').val('');
				$('#tamanhonomemodal').val('');
				$('#tipomodal').val('');
				$('#precomodal').val('');
				$('#quantidademodal').val('1');
				$('#imagemodal').val('');
				$('#urlmodal').val('');
				$('#datainclusaomodal').val('');
				modal.find('.starreviem').attr('data-star','5.0');
			},
			success   : function(data) 
				{
					modal.find('.modalfallbackerro').html('');
					modal.find('.modalfallbackerro').hide();
					
					if (data.erro)
					{
					    console.log('Acessou erros 200');
						modalerro('modalfallback','Este Produto está indisponível<br>neste momento!',data.msg)
					}
					else
					{
						let  start = Date.now();
						modal.find('.product-information').show();
						modal.find('.nomeproduto').text(data.data.produtonome);
						modal.find('.descricaochamada').text(data.data.descricaochamada);
						if (data.data.FgFreteGratis=='N')
						{
							$('.fretegratis').empty();
							$('.fretegratis').fadeOut().removeClass('content');
						}
						else
						{
							let htmlfrete ='<p class="mr-3 mt-4"><i class="fa fa-truck fa-2x" aria-hidden="true"></i></p>'
											+'<p class="mt-3">'
												+'<strong>Frete Grátis para toda a cidade de São Paulo.</strong>'
												+'<br>'
												+'<small class="font-p">Entrega em até 48 Horas para algumas regiões.</small>'
											+"</p>";
							$('.fretegratis').html(htmlfrete);
							$('.fretegratis').addClass('content').fadeIn();
						}
						modal.find('.starreviem').attr('data-star',data.data.starreviem);
						modal.find('.notareview').text(data.data.notareview);
						$('.notareview').attr('href',data.data.urlproduto);
						let valorchamada =parseFloat(data.data.valorchamada).toLocaleString("pt-BR", { style: "currency" , currency:"BRL"});
						let valorproduto =parseFloat(data.data.valorproduto).toLocaleString("pt-BR", { style: "currency" , currency:"BRL"});
						
						modal.find('.precopromo').text(valorchamada);
						modal.find('.precounitario').text(valorproduto);
						$('.guiamodal').attr('src',data.data.imagemguia);
						if (data.data.flagopcao)
						{
							$('.opcaoproduto').fadeIn();
							let rowopcao;
							if (data.data.tipoproduto.length>0)
							{
								$('.listaopcaoproduto').empty();
								$.each(data.data.tipoproduto, function (i, d) {
									rowopcao='<a class="bg-prime tipoproduto"  href="#" onclick="updatetipo(this,event)" data-codigo="'+d.id+'">'+d.nome+'</a>';
									$(".listaopcaoproduto").append(rowopcao);
												
								});
								
								
							}
						}
						else
						{
							$('.listaopcaoproduto').empty();
							$('.opcaoproduto').fadeOut();
						}
						
						if (data.data.flagtamanho)
						{
							$('.opcaotamanho').fadeIn();
							if (data.data.tamanhokit.length>0)
							{
								$('.listaopcaotamanho').empty();
								let rowtamanho;
								$.each(data.data.tamanhokit, function (i, d) {
									rowtamanho='<a href="#" onclick="updatetamanho(this,event)" data-codigo="'+d.id+'" class="bg-prime tamanhoproduto">'+d.nome+'</a>';
									$(".listaopcaotamanho").append(rowtamanho);
												
								});
								
								
							}
						}
						else
						{
							$('.listaopcaotamanho').empty();
							$('.opcaotamanho').fadeOut();
						}
						
						$('#codigomodal').val(data.data.id);	
						$('#nomemodal').val(data.data.produtonome);	
						$('#precomodal').val(data.data.valorproduto);	
						$('#imagemodal').val(data.data.produtonome);	
						$('#urlmodal').val(data.data.produtonome);	
						$('#datainclusaomodal').val(start);	
						
						if (data.data.midiaproduto.length>0)
						{
							
							$.each(data.data.midiaproduto, function (i, d) {
								if (i==0)
								{
									$('#imagemodal').val(d.imagemidia);	
								}
								if (d.urlmidia!="")
								{
									$('.image'+i).attr('src',d.imagemidia).attr('alt',d.nomearquivo).attr('data-urlvideo',d.urlmidia).addClass('videoyoutube');
								}
								else
								{
									$('.image'+i).attr('src',d.imagemidia).attr('alt',d.nomearquivo).attr('data-urlvideo','').removeClass('videoyoutube');;
								}
								
								$('.thumb'+i).attr('src',d.thumbmidia).attr('alt',d.nomearquivo);
											
							});
							
							
						}
					}
					
					
					
				}
			}).fail(function(jqXHR, textStatus, error) { 
				
				try{
					let response =JSON.parse(jqXHR.responseText);
					if (response.msg !== undefined)
					{
						modalerro('modalfallbackerro','Este Produto está indisponível neste momento!',response.msg)
					}
					else
					{
						modalerro('modalfallbackerro','Este Produto está indisponível neste momento!','Desculpe, ocorreu um erro inesperado, entre em contato com o suporte ou tente novamente mais tarde.');
						
					}
				}catch (e) {
					modalerro('modalfallbackerro','Este Produto está indisponível neste momento!','Desculpe, tente novamente mais tarde ou entre em contato com o suporte.');
					
					
				}
				
				
			}).always(function() {
				
				
			});
		
	});
});
function modalerro(elemntdiv,titulomensagem,mensagemerro){
	let htmlerro;
	htmlerro 	='<div class="pix">';
	htmlerro 	+='<img class="img-fluid mb-2" src="https://kitescolarsaopaulo.com.br/layout/img/concluido.webp" width="90" decoding="async" loading="lazy" alt="boleto">';
	htmlerro 	+='<h4 class="text-body my-3 textotitulofallback">';
	htmlerro 	+=titulomensagem;
	htmlerro 	+='</h4><p class="my-3 textotitulofallback">'+mensagemerro+'</p>';
	htmlerro 	+='<button  data-dismiss="modal" aria-label="Close" class="btn btn-success bg-success text-white my-3 mb-4" type="submit">Voltar para a Home</button></div>';
	
	$('.'+elemntdiv).html(htmlerro).fadeIn();
}
function modalaguarde(elemntdiv){
	let htmlaguardando;
	htmlaguardando 	='<div class="d-flex justify-content-center mt-4">';
	htmlaguardando 	+='<div class="spinner-grow spinner-grow-sm text-primary mr-2" role="status">';
	htmlaguardando 	+='<span class="sr-only">Loading...</span></div>';
	htmlaguardando 	+='<div class="spinner-grow spinner-grow-sm text-primary mr-2" role="status">';
	htmlaguardando 	+='<span class="sr-only">Loading...</span></div>';
	htmlaguardando 	+='<div class="spinner-grow spinner-grow-sm text-primary mr-2" role="status">';
	htmlaguardando 	+='<span class="sr-only">Loading...</span></div>';
	htmlaguardando 	+='</div>';
	htmlaguardando 	+='<p class="mt-4 text-center"><strong>Por favor, aguarde...</strong></p>';
	htmlaguardando 	+='<p class="mt-1 text-center">Estamos processando a sua solicitação.</p>';
	
	$('.'+elemntdiv).html(htmlaguardando).fadeIn();
}
