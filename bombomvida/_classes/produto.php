<?php 
	/**
	* @author francisco tarlisson <franciscotarlisson@gmail.com>
	* 
	*/
	class Produto
	{		
		/**		
		*@var array string, int
		*/
		private $produtos = array();

		/**
		*@var int 
		*/
		private $id;

		/**
		*@var int
		*/
		private $id_categ;

		/**
		*@var string
		*/
		private $nome;

		/**
		*@var string
		*/
		private $descricao;

		/**
		*@var decimal
		*/
		private $valor;

		/**
		*@var decimal
		*/
		private $peso;

		/**
		*@var string
		*/
		private $img;

		/**		
		*@var objeto mysqli
		*/
		private $mysqli;

		/**
		*recebe um @param objeto da classe mysqli
		*e atribui o objeto na @var $mysqli		
		*
		*@param objeto 
		*
		*@return void
		*/
		function __construct($novo_mysqli)
		{
			$this->mysqli = $novo_mysqli;

			$this->id = 0;
			$this->id_categ = 0;
			$this->nome = "";
			$this->descricao = "";
			$this->valor = 0;
			$this->peso = 0;
			$this->img = "";			
		}		

		public function get_id(){
			return $this->id;
		}

		public function set_id($val){
			$this->id = $val;
		}

		public function get_idCategoria(){
			return $this->id_categ;
		}

		public function set_idCategoria($val){
			$this->id_categ = $val;
		}

		public function get_nome(){
			return $this->nome;
		}

		public function set_nome($val){
			$this->nome = $val;
		}

		public function get_descricao(){
			return $this->descricao;
		}

		public function set_descricao($val){
			$this->descricao = $val;
		}

		public function get_valor(){
			return $this->valor;
		}

		public function set_valor($val){
			$this->valor = $val;
		}

		public function get_peso(){
			return $this->peso;
		}

		public function set_peso($val){
			$this->peso = $val;
		}

		public function get_img(){
			return $this->img;
		}

		public function set_img($val){
			$this->img = $val;
		}

		public function get_produtos(){
			return $this->produtos;
		}

		/**
		*Faz busca de produtos em destaque no banco,
		*depois o @var array $produtos é limpo para 
		*poder receber os produtos da consulta dentro
		*da estrutura while.
		*
		*@var string $sqlBusca
		*@var resource $resultado
		*@var array assoc $produto
		*@return $this->produtos
		*@return false
		*/
		function buscar_produtos_destaque()
		{
			//busca produtos no banco
			$sqlBusca = "SELECT * FROM produtos WHERE promocao = 'S';";
			$resultado = $this->mysqli->query($sqlBusca);

			//verifica se houve erro
			if(!$resultado){
				return false;
			}

			$this->produtos = array();

			//atribui resultado da consulta na propriedade
			while($produto = mysqli_fetch_assoc($resultado)){
				$this->produtos[] = $produto;
			}

			//limpa o resultado da memória 
			mysqli_free_result($resultado);

			return $this->produtos;
		}

		/**
		*Busca todos os produtos o seletivamente de acordo como a
		*@var $id_categoria e @var nome_prod estiver preenchidas 
		*
		*@param int $id_categoria
		*@param string $nome_prod
		*
		*@var string $sqlBusca 
		*@var resource $resultado
		*@var array assoc $produto
		*
		*@return false
		*@return $this->produtos
		*/
		public function buscar_produtos($nome_prod = "", $id_categoria = 0){
			$sqlBusca = "";

			if($id_categoria > 0){
				$sqlBusca = "SELECT * FROM produtos WHERE nome LIKE '%{$nome_prod}%' AND id_categoria = {$id_categoria};";
			}else{
				$sqlBusca = "SELECT * FROM produtos WHERE nome LIKE '%{$nome_prod}%';";
			}
			
			$resultado = $this->mysqli->query($sqlBusca);

			//verifica se houve erro
			if(!$resultado){
				return false;
			}

			$this->produtos = array();

			//atribui resultado da consulta na propriedade
			while($produto = mysqli_fetch_assoc($resultado)){
				$this->produtos[] = $produto;
			}

			//limpa o resultado da memória 
			mysqli_free_result($resultado);

			return $this->produtos;
		}

		/**
		*Busca as categorias de produtos existentes
		*
		*@var string $sqlBusca
		*@var resource $resultado
		*@var array assoc $categorias
		*
		*@return $categoria
		*@return false
		*/
		public function buscar_categorias(){
			//busca no banco
			$sqlBusca = "SELECT * FROM categoria_prod;";

			$resultado = $this->mysqli->query($sqlBusca);

			//verifica se houve erro
			if(!$resultado){
				return false;
			}

			$categorias = array();

			//prepara o array
			while($linha = mysqli_fetch_assoc($resultado)){
				$categorias[] = $linha;
			}

			return $categorias;
		}

		/**
		*Busca de produto seletiva por id e armazena na propriedade
		*$this->produtos usando uma estrutura while
		*
		*@var string $sqlBusca
		*@var resource $resultado
		*@return $this->produtos
		*@return false
		*/
		public function buscar_produto_id($id_produto, $id_categoria = 0, $nome_prod = ""){
			
			if($id_categoria > 0)
			{
				$sqlBusca = "SELECT p.id, p.nome, p.peso, p.valor, p.img FROM produtos as p INNER JOIN categoria_pro as c on p.id_categoria = c.id WHERE p.nome LIKE '%{$nome_prod}%' AND c.id = {$id_categoria}";
			}
			else
			{
				$sqlBusca = "SELECT * FROM produtos WHERE nome LIKE '%{$nome_prod}%'";				
			}


			//faz busca pelo produto no banco	
			$resultado = $this->mysqli->query($sqlBusca);

			//verifica se houve erro
			if(!$resultado){
				return false;
			}

			$this->produtos = array();

			//atribui resultado da consulta na propriedade
			while($produto = mysqli_fetch_assoc($resultado)){
				$this->produtos[] = $produto;
			}

			//limpa o resultado da memória 
			mysqli_free_result($resultado);
		
			return $this->produtos;
		}	

		/**
		*Gerador de codigo de compra único para cada compra do cliente,
		*Verificando o ultimo codigo do registro de compra e adiciona + 1
		*
		*@var string $sqlBusca
		*@var resource $resultado
		*@var array int $codigo
		*
		*@return $codigo
		*@return false
		*/
		public function gerar_numero_compra(){
			//Busca o ultimo codigo registrado
			$sqlBusca = "SELECT MAX(numero_compra) as cod FROM compras;";
			$resultado = $this->mysqli->query($sqlBusca);

			//verifica se houve erro
			if(!$resultado){
				return false;
			}

			$codigo = mysqli_fetch_array($resultado);

			//se a consulta for null atribui 1, se não incrementa +1
			if($codigo['cod'] == null){
				$codigo['cod'] = 1;				
			}else{
				++$codigo['cod'];
			}

			//limpa o resultado da memória 
			mysqli_free_result($resultado);

			return $codigo;
		}

		/**
		*Verifica se existe o mesmo produto no carrinho
		*caso positivo adiciona +1 na quantidade do produto
		*
		*@param array assoc $produto
		*
		*@var array assoc $_SESSION['carrinho']
		*
		*@return bool
		*/
		public function verificar_prod_carrinho($produto)
		{
			for($i=0;$i<=count($_SESSION['carrinho'])-1;++$i)
			{
				if($_SESSION['carrinho'][$i]['id'] == $produto['id'])
				{
					$_SESSION['carrinho'][$i]['quantidade'] = $_SESSION['carrinho'][$i]['quantidade'] + $produto['quantidade'];
					
					return true;
					break;
				}
			}

			return false;
		}

		/**
		*O produto que não for igual ao mesmo definido 
		*pelo $id_produto que sera removido 
		*é preservado em $temporario para não perder-lo 
		*na limpeza total do $_SESSION['carinho']
		*
		*@param int $id_produto
		*
		*@var array assoc $_SESSION['carrinho']
		*@var array assoc $temporario
		*
		*@return void
		*/
		public function retirar_prod_carrinho($id_produto)
		{	

			$temporario = array();

			for($i=0;$i<=count($_SESSION['carrinho'])-1;$i++)
			{				
				if($_SESSION['carrinho'][$i]['id'] != $id_produto)
				{
					$temporario[] = $_SESSION['carrinho'][$i];
				}				
			}

			unset($_SESSION['carrinho']);
			$_SESSION['carrinho'] = $temporario;
		}

	/**
	*Busca as compras feitas pelo cliente
	*
	*@var string $sqlBusca
	*@var resource $resultado
	*@var array assoc $compras
	*
	*@return $compras
	*@return false	
	*/
	public function buscar_compras($id_cliente, $data1 = "", $data2 = "")
	{
		//busca no banco
		$sqlBusca;

		if(strlen($data1) && strlen($data2))
		{
			$sqlBusca = "SELECT DISTINCT(data_compra) FROM compras WHERE id_cliente = {$id_cliente} AND data_compra BETWEEN '{$data1}' AND '{$data2}';";
		}
		else
		{
			$sqlBusca = "SELECT DISTINCT(data_compra) FROM compras WHERE id_cliente = {$id_cliente};";
		}

		$resultado = $this->mysqli->query($sqlBusca);

		//verifica se houve erro
		if(!$resultado){
			return false;
		}

		$compras = array();

		//prepara o array
		while ($comp = mysqli_fetch_assoc($resultado))
		{
			$compras[] = $comp;
		}

		//limpa consulta da memória
		mysqli_free_result($resultado);

		return $compras;
	}

	/**
	*busca a lista de produtos de uma determinada compra
	*com a data e o identicador do cliente
	*
	*@param int $id_cliente
	*@param date $data
	*
	*@var string $sqlBusca
	*@var resource $resultado
	*@var array assoc $compra
	*
	*@return $compra
	*@return false
	*/
	public function buscar_produtos_compra($id_cliente, $data)
	{
		$sqlBusca = "SELECT p.nome, p.peso, p.valor, c.quantidade, c.data_compra FROM compras AS c INNER JOIN produtos AS p ON p.id = c.id_produto WHERE c.data_compra = '{$data}' AND c.id_cliente = {$id_cliente};";
		$resultado = $this->mysqli->query($sqlBusca);

		if(!$resultado)
		{
			return false;
		}

		$compra = array();

		//prepara o array
		while ($comp = mysqli_fetch_assoc($resultado))
		{
			$compra[] = $comp;
		}

		//limpa consulta da memória
		mysqli_free_result($resultado);

		return $compra;
	}	

	/**
	*computa o total e retorna a soma da lista de compra
	*
	*@param array assoc $lista_produto
	*
	*@var int $total
	*
	*@return $total
	*/
	public function total_compra($compra)
	{
		$total = 0;

		foreach ($compra as $produto) {
			$total = $total + $produto['valor'] * $produto['quantidade'];
		}

		return $total;

	}
}
?>