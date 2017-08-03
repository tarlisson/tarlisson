<?php

/**
* @author francisco tarlisson <franciscotarlisson@gmail.com>
*/
class Helpers
{
	
	public function verifica_post($valores){			

		if(isset($valores) && count($valores)>0){
			return true;
		}

		return false;
	}

	function traduz_data_para_banco($data){
		if ($data == ""){
			return "";
		}
		
		$dados = explode("/", $data);

		if(count($dados) != 3){
			return $data;
		}

		$dataMysql = "{$dados[2]}-{$dados[1]}-{$dados[0]}";

		return $dataMysql;
	}

	function traduz_data_para_exibir($data){
		if($data == "" OR $data == "0000-00-00"){
			return "";
		}

		$dados = explode("-", $data);

		if(count($dados) != 3){
			return $data;
		}

		$data_exibir = "{$dados[2]}/{$dados[1]}/{$dados[0]}";

		return $data_exibir;
	}

	function validar_data($data){
		$padrao = '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/';
		$resultado = preg_match($padrao, $data);

		if(!$resultado){
			return false;
		}

		$dados = explode('/', $data);

		$dia = $dados[0];
		$mes = $dados[1];
		$ano = $dados[2];

		$resultado = checkdate($mes, $dia, $ano);

		return $resultado;
	}

	function validar_cpf($cpf){
		$padrao = '/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}\-[0-9]{2}$/';
		$resultado = preg_match($padrao, $cpf);

		if($resultado == false){
			return false;
		}

		return true;
	}

	function validar_rg($rg){
		$padrao = '/^[0-9]{2}\.[0-9]{3}\.[0-9]{3}\-[0-9]{1}$/';
		$resultado = preg_match($padrao, $rg);

		if($resultado == false){
			return false;
		}

		return true;
	}

	function validar_telefone($telefone){
		$padrao = '/^\([0-9]{2}\)[0-9]{4,5}\-[0-9]{4}$/';
		$resultado = preg_match($padrao, $telefone);

		if($resultado == false){
			return false;
		}

		return true;
	}

	function validar_cep($cep){
		$padrao = '/^[0-9]{5}\-[0-9]{3}$/';
		$resultado = preg_match($padrao, $cep);

		if($resultado == false){
			return false;
		}

		return true;
	}

	function validar_senha($senha, $senha_confirma){		
		$resultado = (($senha == $senha_confirma)? true : false);

		if($resultado == false){
			return false;
		}

		return true;
	}

	function atribuir_indices($valores){
		$resultado = array();
		$indice = 0;
		foreach ($valores as $valor) {
			$resultado = $valor;
		}
	}
	
	function index_array($valores, $strg, $id)
	{
		for($i=0;$i<=count($valores)-1;$i++) 
		{
			if($valores[$i][$strg] == $id)
			{
				break;
				return $i;
			}
		}

		return false;
	}
}

?>