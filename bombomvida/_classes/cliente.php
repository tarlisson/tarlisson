<?php
/**
* @author francisco tarlisson <franciscotarlisson@gmail.com>
*/
class Cliente{
	/**
	*armazenará dados do cliente
	*
	*@var array string, int
	*/
	private $cliente = array();
	/**
	*@var int
	*/
	private $id;
	/**
	*@var int
	*/
	private $id_endereco;
	/**
	*@var string
	*/
	private $nome;
	/**
	*@var string
	*/
	private $sobrenome;
	/**
	*@var string
	*/
	private $data_nasc;
	/**
	*@var string
	*/
	private $cpf;
	/**
	*@var string
	*/
	private $rg;
	/**
	*@var string
	*/
	private $telefone;
	/**
	*@var string
	*/
	private $celular;
	/**
	*@var string
	*/
	private $email;
	/**
	*@var string
	*/
	private $senha;
	/**
	*@var string
	*/
	private $rua;
	/**
	*@var int
	*/
	private $numero;
	/**
	*@var string
	*/
	private $bairro;
	/**
	*@var string
	*/
	private $cidade;
	/**
	*@var string
	*/
	private $cep;

	/**
	faz conexão e consulta com o banco.
	*só se tornará objeto quando a classe for
	*instanciada e executar o metodo construtor
	*
	*@var objeto mysqli
	*/
	private $mysqli;

	/**
	*Cria um novo objeto da mysqli
	*
	*@param objeto mysqli
	*@return void
	*/
	function __construct($novo_mysqli)
	{
		$this->mysqli = $novo_mysqli;
		$this->id = 0;
		$this->id_endereco = 0;
		$this->nome = "";
		$this->sobrenome = "";
		$this->data_nasc = "";
		$this->cpf = "";
		$this->rg = "";
		$this->email = "";
		$this->senha = "";
		$this->telefone = "";
		$this->celular = "";
		$this->rua = "";
		$this->bairro = "";
		$this->numero = "";
		$this->cidade = "";
		$this->cep = "";
	}	

	public function get_id(){
		return $this->id;
	}
	public function set_id($val){
		$this->id = $val;
	}

	public function get_idEndereco(){
		return $this->id_endereco;
	}
	public function set_idEndereco($val){
		$this->id_endereco = $val;
	}

	public function get_nome(){
		return $this->nome;
	}
	public function set_nome($val){
		$this->nome = $val;
	}

	public function get_sobrenome(){
		return $this->sobrenome;
	}
	public function set_sobrenome($val){
		$this->sobrenome = $val;
	}

	public function get_dataNasc(){
		return $this->data_nasc;
	}
	public function set_dataNasc($val){
		$this->data_nasc = $val;
	}

	public function get_cpf(){
		return $this->cpf;
	}
	public function set_cpf($val){
		$this->cpf = $val;
	}

	public function get_rg(){
		return $this->rg;
	}
	public function set_rg($val){
		$this->rg = $val;
	}

	public function get_email(){
		return $this->email;
	}
	public function set_email($val){
		$this->email = $val;
	}

	public function set_senha($val){
		$this->senha = $val;
	}

	public function get_telefone(){
		return $this->telefone;
	}
	public function set_telefone($val){
		$this->telefone = $val;
	}

	public function get_celular(){
		return $this->celular;
	}
	public function set_celular($val){
		$this->celular = $val;
	}

	public function get_rua(){
		return $this->rua;
	}
	public function set_rua($val){
		$this->rua = $val;
	}

	public function get_numero(){
		return $this->numero;
	}
	public function set_numero($val){
		$this->numero = $val;
	}

	public function get_bairro(){
		return $this->bairro;
	}
	public function set_bairro($val){
		$this->bairro = $val;
	}

	public function get_cidade(){
		return $this->cidade;
	}
	public function set_cidade($val){
		$this->cidade = $val;
	}

	public function get_cep(){
		return $this->cep;
	}
	public function set_cep($val){
		$this->cep = $val;
	}

	/**
	*Registra um novo cliente no banco de dados
	*
	*@var string $sqlGravar
	*@var string $sqlBusca
	*@var resource $resultado
	*@return bool
	*/
	public function cadastrar_cliente(){				

		//cadastra o endereco do cliente
		$sqlGravar = "INSERT INTO endereco VALUES (DEFAULT, '{$this->rua}', '{$this->numero}', '{$this->bairro}', '{$this->cidade}', '{$this->cep}');";

		$resultado = $this->mysqli->query($sqlGravar);

		//verifica se há erro
		if(!$resultado){			
			return false;
		}
		
		//recupera o id recem cadastrado do endereco do cliente
		$sqlBusca = "SELECT last_insert_id(id) as id from endereco order by id desc limit 1";

		$resultado = $this->mysqli->query($sqlBusca);

		//verifica se há erro
		if(!$resultado){
			return false;
		}

		$id_endereco = mysqli_fetch_array($resultado);

		//cadastra o cliente juntamente com o id do endereco recuperado
		$sqlGravar = "INSERT INTO cliente VALUES (DEFAULT, '{$id_endereco['id']}', '{$this->nome}', '{$this->data_nasc}', '{$this->cpf}', '{$this->rg}', '{$this->telefone}', '{$this->celular}', '{$this->email}', '{$this->senha}', '{$this->sobrenome}');";

		$resultado = $this->mysqli->query($sqlGravar);	

		//verifica se há erro
		if(!$resultado)	{
			return false;
		}

		//Busca o registro recente para 
		$sqlBusca = "SELECT *, last_insert_id(id) as id FROM cliente ORDER BY id DESC LIMIT 1;";
		
		$resultado = $this->mysqli->query($sqlBusca);

		//verifia se há erro
		if(!$resultado){
			return false;
		}

		//limpa o resultado da memória 
		mysqli_free_result($resultado);

		return true;
	}

	/**
	*Seleciona um cadastro recente de cliente no banco de dados
	*e retorna um id
	*
	*@var string $sqlBusca
	*@var resource $resultado
	*@var array assoc $cliente
	*@return bool
	*/
	public function buscar_id_cadastro_recente(){
		//Recupera o ultimo id cadastrado
		$sqlBusca = "SELECT *, last_insert_id(id) as id FROM cliente ORDER BY id DESC LIMIT 1;";
		
		$resultado = $this->mysqli->query($sqlBusca);

		//verifica se há erro
		if(!$resultado){
			return false;
		}

		while($cliente = mysqli_fetch_assoc($resultado)){
			$this->id = $cliente['id'];			
			$this->nome = $cliente['nome'];
			$this->data_nasc = $cliente['data_nasc'];
			$this->cpf = $cliente['cpf'];
			$this->rg = $cliente['rg'];
			$this->telefone = $cliente['telefone'];
			$this->celular = $cliente['celular'];
			$this->email = $cliente['email'];			
		}

		//limpa o resultado da memória 
		mysqli_free_result($resultado);

		return true;
	}

	/**
	*Busca registro de um cliente no banco de dados e se o @param 
	*$endereco for definido como true, a busca retorna 
	*cliente e endereco
	*
	*@param array int $id
	*@param bool $endereco
	*@var string $sqlBusca
	*@var resource $resultado
	*@var array assoc $cliente
	*@return bool
	*/
	public function buscar_cliente($id){
		//Traz dados do cliente no banco
		$sqlBusca ="SELECT cliente.id, cliente.nome, cliente.data_nasc, cliente.cpf, cliente.rg, cliente.telefone, cliente.celular, cliente.email, cliente.sobrenome, cliente.id_endereco, endereco.rua, endereco.numero, endereco.bairro, endereco.cidade, endereco.cep FROM cliente INNER JOIN endereco ON cliente.id_endereco = endereco.id WHERE cliente.id = {$id};";
		

		$resultado = $this->mysqli->query($sqlBusca);

		//verifica se há erro
		if(!$resultado){
			return false;
		}		

		while($cliente = mysqli_fetch_assoc($resultado)){
			$this->id = $cliente['id'];
			$this->id_endereco = $cliente['id_endereco'];
			$this->nome = $cliente['nome'];
			$this->sobrenome = $cliente['sobrenome'];
			$this->data_nasc = $cliente['data_nasc'];
			$this->cpf = $cliente['cpf'];
			$this->rg = $cliente['rg'];
			$this->telefone = $cliente['telefone'];
			$this->celular = $cliente['celular'];
			$this->email = $cliente['email'];
			$this->rua = $cliente['rua'];
			$this->numero = $cliente['numero'];
			$this->bairro = $cliente['bairro'];
			$this->cidade = $cliente['cidade'];
			$this->cep = $cliente['cep'];
		}

		//limpa o resultado da memória 
		mysqli_free_result($resultado);

		return true;
	}

	/**
	*Atualiza registro do cliente e endereco
	*
	*@var string $sqlUpdate
	*@var bool $resultado
	*@return bool
	*/
	public function atualizar_cad_cliente(){
		//atualiza registro do cliente
		$sqlUpdate = "UPDATE cliente SET nome = '{$this->nome}', data_nasc = '{$this->data_nasc}', cpf = '{$this->cpf}', rg = '{$this->rg}', telefone = '{$this->telefone}', celular = '{$this->celular}', email = '{$this->email}', senha = '{$this->senha}', sobrenome = '{$this->sobrenome}' WHERE id = {$this->id}";

		$resultado = $this->mysqli->query($sqlUpdate);

		//verifica se houve erro
		if(!$resultado){
			return false;
		}

		//atualiza registro de endereco do cliente
		$sqlUpdate = "UPDATE endereco SET rua = '{$this->rua}', numero = '{$this->numero}', bairro = '{$this->bairro}', cidade = '{$this->cidade}', cep = '{$this->cep}' WHERE id = '{$this->id_endereco}'";

		$resultado = $this->mysqli->query($sqlUpdate);

		//verifica se houve erro
		if(!$resultado){
			return false;
		}

		return true;
	}

	/**
	*Inicia uma busca no banco por email e senha para login
	*e retorna id e nome do usuario
	*
	*@var string $sqlBusca
	*@var resource $resultado
	*@var array assoc $log
	*@return bool
	*/
	public function logar($cliente){		

		//verifica email e senha do cliente para retorna nome e id
		$sqlBusca = "SELECT id, nome FROM cliente WHERE email = '{$cliente['email']}' AND senha = '{$cliente['senha']}'";
		$resultado = $this->mysqli->query($sqlBusca);

		//verifica se houve erro
		if(!$resultado){
			return false;
		}

		$log = mysqli_fetch_array($resultado);

		$this->id = $log['id'];
		$this->nome = $log['nome'];

		//limpa o resultado da memória 
		mysqli_free_result($resultado);

		return true;
	}

	/**
	*Recebe novos dados para atribuir nas propriedades e 
	*tratar as informações se estão de acordo com formato
	*para o banco.
	*Se houver erro de formatação que seja inadequado para
	*cadastro, a função retorna um array com as mensagens de erros
	*informativas para o usuario.
	*
	*@param array assoc $novos_dados
	*@var boolean $tem_erro
	*@var array assoc $msg_erros
	*
	*@return false
	*@return $msg_erros
	*/
	public function atribuir_novos_dados($novos_dados, $novo_helper){

		$tem_erro = false;
		$msg_erros = array();
		$helper = $novo_helper;

		if(isset($novos_dados['id']) && $novos_dados['id']>0){
			$this->set_id($novos_dados['id']);
		}

		if(isset($novos_dados['id_endereco']) && $novos_dados['id_endereco']>0)
		{
			$this->set_idEndereco($novos_dados['id_endereco']);
		}		

		if (isset($novos_dados['nome']) && strlen($novos_dados['nome']) > 0)
		{
			$this->set_nome($novos_dados['nome']);
		}else{
			$tem_erro = true;
			$msg_erros['nome'] = 'O nome é obrigatório!';
		}

		if (isset($novos_dados['sobrenome']) && strlen($novos_dados['sobrenome']) > 0)
		{
			$this->set_sobrenome($novos_dados['sobrenome']);
		}else{
			$tem_erro = true;
			$msg_erros['sobrenome'] = 'O sobrenome é obrigatório!';
		}

		if(isset($novos_dados['data']) && strlen($novos_dados['data']) > 0){
			if($helper->validar_data($novos_dados['data'])){
				$this->set_dataNasc($helper->traduz_data_para_banco($novos_dados['data']));
			}
			else{
				$tem_erro = true;
				$msg_erros['data'] = 'Digite uma data válida e do tipo dd/mm/aaa.';
			}					
		}

		if (isset($novos_dados['cpf']) && strlen($novos_dados['cpf']) > 0)
		{
			if($helper->validar_cpf($novos_dados['cpf'])){
				$this->set_cpf($novos_dados['cpf']);
			}
			else{
				$tem_erro = true;
				$msg_erros['cpf'] = 'cpf inválido! coloque (.) e (-)';
			}
		}
		if (isset($novos_dados['rg']) && strlen($novos_dados['rg']) > 0)
		{
			if($helper->validar_rg($novos_dados['rg'])){
				$this->set_rg($novos_dados['rg']);
			}
			else{
				$tem_erro = true;
				$msg_erros['rg'] = 'rg inválido! coloque (.) e (-)';
			}
		}

		if (isset($novos_dados['telefone']) && strlen($novos_dados['telefone']) > 0)
		{
			if($helper->validar_telefone($novos_dados['telefone'])){
				$this->set_telefone($novos_dados['telefone']);
			}
			else{
				$tem_erro = true;
				$msg_erros['telefone'] = 'telefone inválido!  coloque o DDD';
			}
		}

		if (isset($novos_dados['celular']) && strlen($novos_dados['celular']) > 0)
		{
			if($helper->validar_telefone($novos_dados['celular'])){
				$this->set_celular($novos_dados['celular']);
			}
			else{
				$tem_erro = true;
				$msg_erros['celular'] = 'celular inválido! coloque DDD';
			}
		}

		if (isset($novos_dados['rua']) && strlen($novos_dados['rua']) > 0)
		{			
			$this->set_rua($novos_dados['rua']);
		}
		else{
			$tem_erro = true;
			$msg_erros['rua'] = 'digite o endereco.';
		}

		if (isset($novos_dados['numero']) && strlen($novos_dados['numero']) > 0)
		{			
			$this->set_numero($novos_dados['numero']);	
		}else{
			$tem_erro = true;
			$msg_erros['numero'] = 'preencha este campo.';
		}

		if (isset($novos_dados['bairro']) && strlen($novos_dados['bairro']) > 0)
		{			
			$this->set_bairro($novos_dados['bairro']);		
		}else{
			$tem_erro = true;
			$msg_erros['bairro'] = 'preencha este campo.';
		}

		if (isset($novos_dados['cidade']) && strlen($novos_dados['cidade']) > 0)
		{			
			$this->set_cidade($novos_dados['cidade']);		
		}else{
			$tem_erro = true;
			$msg_erros['cidade'] = 'preencha este campo';
		}

		if (isset($novos_dados['cep']) && strlen($novos_dados['cep']) > 0)
		{			
			if($helper->validar_cep($novos_dados['cep'])){
				$this->set_cep($novos_dados['cep']);		
			}	
			else{
				$tem_erro = true;
				$msg_erros['cep'] = 'cep inválido';
			}
		}

		if (isset($novos_dados['senha']) && strlen($novos_dados['senha']) > 0)
		{			
			if($helper->validar_senha($novos_dados['senha'], $novos_dados['senhaRep'])){
				$this->set_senha($novos_dados['senha']);
			}	
			else{
				$tem_erro = true;
				$msg_erros['senha'] = 'a senha não esta igual.';
			}
		}

		if (isset($novos_dados['email']) && strlen($novos_dados['email']) > 0){			
			$this->set_email($novos_dados['email']);		
		}	
		else{
			$tem_erro = true;
			$msg_erros['email'] = 'preencha este campo.';
		}

		if(!$tem_erro){
			return false;
		}

		return $msg_erros;
	}

	/**
	*Coleta data e hora do sistema e finaliza a 
	*compra do cliente gravando no banco de dados
	*
	*@param array assoc $carrinho
	*@param array assoc $cliente
	*@param int $codigo_compra
	*@var date $data
	*@var hour $hora
	*
	*@return bool
	*/
	public function finalizar_compra($carrinho, $codigo_compra){
		//coleta data e hora
		$data = date("Y-m-d");
		$hora = date("H:i:s");

		echo $data . $hora;
		//registra compra do cliente
		foreach ($carrinho as $produto) {
			$sqlGravar = "INSERT INTO compras VALUES (DEFAULT, {$this->get_id()}, {$produto['id']}, {$codigo_compra}, '{$data}', '{$hora}', {$produto['quantidade']})";
			$resultado = $this->mysqli->query($sqlGravar);
				
			if (!$resultado) {				
				return false;
				break;
			}
		}
		return true;
	}				
}

?>