<?php	
	include "../_classes/banco.php";
	include "../_classes/cliente.php";
	include "../_classes/helpers.php";

	session_start();
			
	$exito = false;
	$msg_erros = array();
	$helper = new Helpers();
	$cliente = new Cliente($mysqli);		

	//caso o usuario sair do sistema, a session é zerada e redirecionado a home
	if(isset($_GET['sair'])){
		$_SESSION = array();
		header("Location: home.php");
		die();
	}
	
	//verifica se tem id na session(se esta logado) e recupera informações do cliente se positivo
	if(isset($_SESSION['id']) && $_SESSION['id'] > 0){		
		$cliente->buscar_cliente($_SESSION['id']);
	}

	//verifica se há campos preenchidos para cadastro ou login. Se o usuário estiver logado é atualização, caso contrário, é cadastro.
	if($helper->verifica_post($_POST)){	

		$erro = $cliente->atribuir_novos_dados($_POST, $helper);
		
		if(! $erro){

			if($cliente->get_id() > 0){
				$exito = $cliente->atualizar_cad_cliente();
			}else{
				$exito = $cliente->cadastrar_cliente();
				$cliente->buscar_id_cadastro_recente();
				$_SESSION['id'] = $cliente->get_id();
			}

		}else{
			$msg_erros = $erro;
		}						
	}

	include "_template/cadastro_temp.php";
?>