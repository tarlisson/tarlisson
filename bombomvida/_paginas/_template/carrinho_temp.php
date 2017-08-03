<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>BOMBOM VIDA</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="../_css/bombomvida.css" />
	<link rel="stylesheet" type="text/css" href="../_css/meu_carrinho.css"/>
	<link rel="stylesheet" type="text/css" href="../_css/normalize.css" />
	<script src="../_js/jquery-3.2.1.js"></script>	
	<script src="../_js/bombomvida.js"></script>

</head>
<body>
<!--menu de navegação-->
<nav id="menu">
	<h1><img src="../_imagens/logo.gif" /></h1>
	<ul>
		<li><a href="home.php">Home</a></li>
		<li><a href="produtos.php">Produtos</a></li>
		<li>
		<?php if($cliente->get_id() > 0) : ?>
			<a href="" class="logado"><?php echo $cliente->get_nome(); ?></a>
			<ul>
				<li><a href="#">Meu carrinho</a></li>
				<li><a href="cadastro.php">Meu cadastro</a></li>
				<li><a href="compras.php">Minhas compras</a></li>
				<li><a href="?sair=true" class="logoff">Sair</a></li>
			</ul>
		</li>
		<?php else : ?>
			<a id="logar" href="#">Logar</a>
			</li>
		<?php endif; ?>
	</ul>
</nav>

<div id="container">
<!--tabela de produtos adicionados no carrinho-->
	<section id="tabela_produto">
		<?php if(count($carrinho)>0) : ?>			
			<table>
				<tr>
					<th>Produto</th>
					<th>Valor(uni)</th>
					<th>Quantidade</th>
					<th>Remover</th>
				</tr>		
			<?php foreach ($carrinho as $produto) : ?>
				<tr>
					<td><?php echo $produto['nome'].", ".$produto['peso']."g"; ?></td>
					<td><?php echo "R$" . $produto['valor']; ?></td>
					<td><?php echo $produto['quantidade']; ?></td>
					<td><a href="?id_prod=<?php echo $produto['id']; ?>">Remover</a></td>
				</tr>
			<?php endforeach; ?>
			</table>
		<!--informativo de preço total, mais botoes para finalizar compra e limpar carrinho-->
			<div id="preco_tot">
				<p>Total: R$<?php echo $total; ?></p>
				<a href="#" id="finalizar" class="botao">Finalizar compra</a>
				<a href="?limpar=true" class="botao">Limpar</a>
			</div>
		<p>para exclusão de produtos, clique duas vezes em (remover) pausadamente.</p>
		<?php endif; ?>
		<!--aviso se o carrinho estiver vazio-->
		<?php if(isset($carrinho) && count($carrinho)==0) : ?>
			<div class="aviso">
				<h1>O seu carrinho esta vazio!</h1>
				<p>Se deseja adicionar produtos ao seu carrinho <a href="produtos.php">clique aqui</a>.</p>
			</div>
		<?php endif; ?>
	</section>
</div>

<!--janela informativa com detalhes para finalizar compra-->
	<div id="fundo"></div>		
	<div id="finalizar_comp">
		<h1>Atenção</h1>
		<p>No momento não autenticamos compra com cartão online. O pagamento será cobrado pelo entregador, que estará em posse com a maquininha pag-seguro.</p>
		<p>Por favor confira o seu cadastro se esta em ordem e acompanhe o seu pedido entrando em contato pelo email ou telefone.</p>
		<p>Deseja finalizar a compra?</p>
	<!--botoes para finalizar ou não a compra-->
		<a href="?finalizar=true" class="botao">Sim</a>
		<a href="produtos.php" class="botao">Não</a>
	</div>
	<!--deixei junto pois estranhamente não funcionou separado-->
	<script>
		$("#finalizar").on('click', function(){
				$("#fundo, #finalizar_comp").show();				
			});	
	</script>
<!--rodape-->
<footer id="rodape" class="clear-fix fim_pg">
	<!--AQUI O RODAPÉ-->	
	<figure>
		<img src="../_imagens/logo.gif">
	</figure>

	<ul>
		<li class="endereco iconeFooter">Endereço: </li>
		<li>Av. Deputado Cantidio Sampaio 4670, Jardim Ismenia</li>
	</ul>
	<ul>
		<li class="contato iconeFooter">Contato: </li>
		<li>(41)1111-111</li>
		<li>(41)91111-1111</li>
		<li>bombomvida@gmail.com</li>
	</ul>
	<ul>
		<li class="duvida iconeFooter">Dúvidas: </li>
		<li>Compra, entrega, outras...</li>
		<li>fale conosco pelo e-mail ou ligue.</li>
	</ul>			
</footer>

</body>
</html>