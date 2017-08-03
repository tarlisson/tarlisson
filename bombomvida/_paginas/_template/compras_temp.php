<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>BOMBOM VIDA</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="../_css/bombomvida.css" />
	<link rel="stylesheet" type="text/css" href="../_css/minhas_compras.css" />
	<link rel="stylesheet" type="text/css" href="../_css/normalize.css" />
	<script src="../_js/jquery-3.2.1.js"></script>	
	<script src="../_js/bombomvida.js"></script>
	
</head>
<body>
<nav id="menu">
	<h1><img src="../_imagens/logo.gif" /></h1>
	<ul>
		<li><a href="home.php">Home</a></li>
		<li><a href="produtos.php">Produtos</a></li>
		<li>
		<?php if($cliente->get_id() > 0) : ?>
			<a href="" class="logado"><?php echo $cliente->get_nome(); ?></a>
			<ul>
				<li><a href="carrinho.php">Meu carrinho</a></li>
				<li><a href="cadastro.php">Meu cadastro</a></li>
				<li><a href="#">Minhas compras</a></li>
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
	<section id="lista_compra">
		<form method="post">
			<fieldset>
				<legend>Datas</legend>
					<label>
						De:
						<?php if(strlen($mensagem) > 0) : ?>
							<span class="erro"><?php echo $mensagem; ?></span>
						<?php endif; ?>
						<input type="text" name="data1" />
					</label>
					<label>
						Até:
						<input type="text" name="data2" />
					</label>				
				<input type="submit" name="" value="Ok">
			</fieldset>
		</form>
		<?php if(count($compras) > 0) : ?>
			<ul>
			<?php foreach ($compras as $compra) : ?>
				<li>
					<a href="?data=<?php echo $compra['data_compra']; ?>"><?php echo $helper->traduz_data_para_exibir($compra['data_compra']); ?></a>
					<?php if(count($lista_compra) > 0 && $lista_compra[0]['data_compra'] == $compra['data_compra']) : ?>
						<ul>
							<?php foreach ($lista_compra as $lista) : ?>
								<li>
									<p><?php echo $lista['nome']; ?> <?php echo $lista['peso']; ?>g, R$<?php echo $lista['valor']; ?> quantidade: <?php echo $lista['quantidade']; ?></p>
								</li>
							<?php endforeach; ?>
								<li>
									<p>Total: R$<?php echo $total; ?></p>
								</li>
						</ul>
					<?php endif; ?>
				</li>	
			<?php endforeach; ?>
			</ul>	
		<?php else : ?>
			<h1>Você não tem nenhuma compra registrada!</h1>			
		<?php endif; ?>
	</section>
</div>

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