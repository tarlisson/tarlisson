<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>BOMBOM VIDA</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="../_css/bombomvida.css" />
	<link rel="stylesheet" type="text/css" href="../_css/normalize.css" />
	<script src="../_js/jquery-3.2.1.js"></script>
	<script src="../_js/bombomvida.js"></script>

</head>
<body>
<nav id="menu">
	<h1><img src="../_imagens/logo.gif" /></h1>
	<ul>
		<li><a href="home.php">Home</a></li>
		<li><a href="#">Produtos</a></li>
		<li>
		<?php if($cliente->get_id() > 0) : ?>
			<a href="#" class="logado"><?php echo $cliente->get_nome(); ?></a>
			<ul>
				<li><a href="carrinho.php">Meu carrinho</a></li>
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

<div class="clear-fix" id="container">
	<section id="lista_prod">
		<header class="cabecalho"><h1>Produtos</h1></header>
		<form method="POST">
			<label class="busca">
			O que você procura?
				<input type="search" name="nome_prod" />
			</label>
			<input type="submit" name="" value="Ok">
		</form>
		<?php if(count($produto->get_produtos()) > 0) : ?>
			<ul method="get">
			<?php foreach ($produto->get_produtos() as $produto) : ?>
				<li>
					<img src="<?php echo $produto['img']; ?>"/>
					<p><?php echo $produto['nome']; ?>, <?php echo $produto['peso']; ?>g</p>
				<p>preço: R$<?php echo $produto['valor']; ?></p>
				<?php if($cliente->get_id() > 0) : ?>					
					<form method="POST">					
						<input type="text" name="id" value="<?php echo $produto['id']; ?>" style="display: none;"/>
						<input type="text" name="nome" value="<?php echo $produto['nome']; ?>" style="display: none;"/>
						<input type="text" name="peso" value="<?php echo $produto['peso']; ?>" style="display: none;">
						<input type="text" name="valor" value="<?php echo $produto['valor']; ?>" style="display: none;"/>
						<input type="number" name="quantidade" value="1"/><a href=""><input type="submit" name="carrinho" value="+ Carrinho" /></a>
					</form>
				</li>			
				<?php endif; ?>
			<?php endforeach; ?>
			</ul>
		<?php else : ?>	
			<p class="erro">nada foi encontrado em <?php foreach ($categorias as $linha){ if($_GET['id_categ'] == $linha['id']){ echo $linha['nome']; break; }} ?>, com o nome de <?php echo $_POST['nome_prod']; ?>.
		<?php endif; ?>
	</section>

	<aside id="categorias">
		<h3 class="cabecalho">Categorias</h3>
		<?php if(isset($categorias) && count($categorias) > 0) : ?>
			<ul>
				<?php foreach ($categorias as $categoria) : ?>
					<li><a href="?id_categ=<?php echo $categoria['id']; ?>"><?php echo $categoria['nome']; ?></li>		
				<?php endforeach; ?>
					<li><a href="?id_categ=0">Todas</a></li>
			</ul>	
		<?php endif; ?>
	</aside>
</div>


	<div id="fundo_login"></div>
		<form id="janela_login" method="POST">
			<fieldset>
				<legend>LOGIN</legend>			
				<label>
				E-mail
				<input type="text" name="email"/>
				</label>
				<label>
				Senha
				<input type="password" name="senha"/>
				</label>
				<input class="btnLogar" type="submit" name="" value="Entrar"/>
			</fieldset>	
			<a href="cadastro.php">Não sou cadastrado</a>
			<a href="">Esqueci minha senha</a>
			<!--botão de fechar-->
			<div class="btnFechar_modal"></div>
		</form>

<footer id="rodape" class="clear-fix">
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