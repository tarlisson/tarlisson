<?php	
	include "../_classes/banco.php";
	include "../_classes/produto.php";
	include "../_classes/cliente.php";
	include "../_classes/helpers.php";

	session_start();
				
	$cliente = new Cliente($mysqli);
	$produto = new Produto($mysqli);
	$helper = new Helpers();

	//caso o usuario sair do sistema, a session é zerada e redirecionado a home
	if(isset($_GET['sair']) && $_GET['sair']){
		$_SESSION = array();
		header("Location: home.php");
	}

	//verifica se tem campos preenchidos se for email e senha é login, caso contrário é adição de produtos no carrinho
	if($helper->verifica_post($_POST)){
	
		//login
		if(!isset($_SESSION['id']))
		{
			if(isset($_POST['email']) && isset($_POST['senha']))
			{
				$log = $cliente->logar($_POST);

				if($log){
					$_SESSION['id']	= $cliente->get_id();
				}									
			}
		}

		//adição de produtos no carrinho
		if(isset($_POST['id']) && isset($_POST['nome']))
		{
			$existe = false;

			if(isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0)
			{
				$existe = $produto->verificar_prod_carrinho($_POST);

			}

			if(!$existe)
			{
				$_SESSION['carrinho'][] = $_POST;
			}
		}		
	}
		
	//verifica se tem id na session(se esta logado) e recupera informações do cliente se positivo
	if(isset($_SESSION['id']) && $_SESSION['id'] > 0){
		$cliente->buscar_cliente($_SESSION['id']);
	}

	//traz produtos em promoçao
	$produto->buscar_produtos_destaque();

	include "_template/home_temp.php";
?>