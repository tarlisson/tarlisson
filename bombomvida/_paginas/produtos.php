<?php 
	include "../_classes/banco.php";
	include "../_classes/produto.php";
	include "../_classes/cliente.php";
	include "../_classes/helpers.php";

	session_start();
			
	$categorias = array();
	$msg;
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
		if(isset($_POST['id']) && count($_POST['id']) > 0)
		{
			$existe = false;

			if(isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0)
			{
				$existe = $produto->verificar_prod_carrinho($_POST);
			}

			if($existe == false)
			{
				$_SESSION['carrinho'][] = $_POST;
			}
		}
	}

	//traz os produtos e as categorias do banco
	//faz busca detalhada dependendo da categoria e texto de busca
	if(isset($_GET['id_categ']))
	{
		$nome_prod = (isset($_POST['nome_prod']) ? $_POST['nome_prod'] : "");
		$msg = $produto->buscar_produtos($nome_prod, $_GET['id_categ']);	
	}
	else
	{
		$nome_prod = (isset($_POST['nome_prod']) ? $_POST['nome_prod'] : "");
		$msg = $produto->buscar_produtos($nome_prod);
	}
	
	$categorias = $produto->buscar_categorias();

	include "_template/produtos_temp.php";
?>