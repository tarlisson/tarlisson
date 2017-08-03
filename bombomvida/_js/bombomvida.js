$(document).ready(function () {
	//home
	$("#slide").cycle({
		fx: "fade",
		speed: 2000,
		timeout: 3000,		
	});
		
	$("#fundo_modal, .btnFechar_modal").on('click', function(){
		$("#fundo_login, #janela_login").hide();
	});

	$("#logar").on('click', function(){
		$("#fundo_login, #janela_login").show();
	});

	//cadastro
	$("#fundo_aviso").show();

	//carrinho
	$("#finalizar").on('click', function(){
		$("#fundo, #finalizar_comp").show();
	});	
});					