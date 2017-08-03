<?php	
	include "../_classes/banco.php";
	include "../_classes/produto.php";
	include "../_classes/cliente.php";
	include "../_classes/helpers.php";

	session_start();

	$lista_compra = array();
	$total = 0;
	$mensagem = "";
	$compras = array();
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

	//verifica se esta logado. Traz as compras feitas do cliente em datas(caso tenha alguma)
	if($cliente->get_id() > 0)
	{
		if(isset($_POST['data1']) && strlen($_POST['data1']) > 0)
		{
			$compras = array();
			$data1;
			$data2;
			$result1 = $helper->validar_data($_POST['data1']);
			$result2 = $helper->validar_data($_POST['data2']);

			if($result1 && $result2)
			{
				$data1 = $helper->traduz_data_para_banco($_POST['data1']);
				$data2 = $helper->traduz_data_para_banco($_POST['data2']);
				
				$compras = $produto->buscar_compras($cliente->get_id(), $data1, $data2);
			}

			if(!$result1 || !$result2)
			{
				$mensagem = "Data inválida! corrija no formato dia/mes/ano.";
			}					
		}
		else
		{
			$compras = array();
			$compras = $produto->buscar_compras($cliente->get_id());	
		}

		if(isset($_GET['data']))
		{
			$lista_compra = array();
			$lista_compra = $produto->buscar_produtos_compra($cliente->get_id(), $_GET['data']);
			$total = $produto->total_compra($lista_compra);
		}
	}

	//verifica se o cliente selecionou alguma data, caso sim, traz os produtos e o total da compra da determinada data
	
	include "_template/compras_temp.php";
?>