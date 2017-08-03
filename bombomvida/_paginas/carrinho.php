<?php 
	include "../_classes/banco.php";
	include "../_classes/produto.php";
	include "../_classes/cliente.php";
	include "../_classes/helpers.php";

	session_start();
		
	$total = 0;
	$carrinho = array();
	$cliente = new Cliente($mysqli);
	$produto = new Produto($mysqli);
	$helper = new Helpers();

	//caso o usuario sair do sistema, a session é zerada e redirecionado a home
	if(isset($_GET['sair']) && $_GET['sair']){
		$_SESSION = array();
		header("Location: home.php");
		die();
	}

	//verifica se tem id na session(se esta logado) e recupera informações do cliente se positivo
	if(isset($_SESSION['id']) && $_SESSION['id'] > 0){
		$cliente->buscar_cliente($_SESSION['id']);
	}

	//verifica se o usuário quer finalizar a compra, caso sim, registra a compra no banco e limpa a session
	if(isset($_GET['finalizar']) && $_GET['finalizar']){
		$codigo = $produto->gerar_numero_compra();
		$resultado = $cliente->finalizar_compra($_SESSION['carrinho'], $codigo['cod']);

		unset($_SESSION['carrinho']);
		header("Location: home.php");
		die();
	}

	//verifica se o usuário quer limpar o carrinho, caso sim, session['carrinho'] é apagada
	if(isset($_GET['limpar']) && $_GET['limpar']){
		unset($_SESSION['carrinho']);
	}

	//verifica se existe produtos no carrinho, se sim, armazena no array $carrinho e contabiliza o total preservando na variavel $total
	if(isset($_SESSION['carrinho'])){
		
		$carrinho = $_SESSION['carrinho'];
				
		$total = $produto->total_compra($carrinho);
	}

	//verifica se tem id do produto para exclusão no carrinho, caso o usuário deseja e selecione o produto
	if(isset($_GET['id_prod']))
	{		
		$produto->retirar_prod_carrinho($_GET['id_prod']);
	}

	include "_template/carrinho_temp.php";
?>