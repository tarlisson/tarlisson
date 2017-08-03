<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>BOMBOM VIDA</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="../_css/bombomvida.css" />
	<link rel="stylesheet" type="text/css" href="../_css/normalize.css" />
	<script src="../_js/jquery-3.2.1.js"></script>
	<script src="../_js/jquery.cycle.all.js"></script>
	<script src="../_js/bombomvida.js"></script>
		
</head>
<body>
	<!--menu de navegação da aplicação-->
	<nav id="menu">
		<!--Logo-->
		<h1><img src="../_imagens/logo.gif" /></h1>
		<!--Menu-->
		<ul>
			<li><a class="pag_atual" href="#">Home</a></li>
			<li><a href="produtos.php">Produtos</a></li>
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
<div id="container">
	<main>
		<!--slide-->
		<section id="slide_promo">

			<!--slide-->
			<div id="slide">
				<!--imagens do slide-->
				<figure class="slide_img">
		    		<img src="../_imagens/nestle_promo.jpg"/>
		    		<figcaption>PROMOÇÃO NESTLE! no valor de R$4,99. Visite a loja ou compre no site.</figcaption>
			    </figure>
				<figure class="slide_img">
					<img src="../_imagens/barras_lacta.jpg"/>
					<figcaption>Barras Lacta por APENAS R$4,99.</figcaption>
				</figure>			
			</div>		
		</section>
	</main>

	<section>
		<article id="detalhes_loja" class="clear-fix">
			<!--sobre a loja-->
			<header class="cabecalho">
				<h1>Conheça a loja</h1>	
			</header>
			<!--imagens da loja-->
			<figure id="img_desc_loja">
				<img src="../_imagens/loja.jpg" />
			</figure>
			<figure id="img_desc_loja">
				<img src="../_imagens/loja_2.jpg" />
			</figure>
			<figure id="img_desc_loja">
				<img src="../_imagens/loja_3.jpg" />
			</figure>

			<!--descriçõa sobre a loja-->
			<div id="desc_loja">			
				<h2>Somos a maior bombonieri da região!</h2>
				<p>Estamos localizada na <a href="#">Av. Deputado Cantidio Sampaio 4670, Jardim Ismenia.</a> A loja esta desde 2007, sempre melhorando o sistema de atendimento e trazendo mais produtos com qualidade para você que é nosso cliente. Trabalhamos com os maiores tipos de variedades de doces, salgadinhos, biscoitos, chocolates e outros. Confira as promoções e visite nossa loja ou <a href="cadastro.php">cadastre-se</a> e compre aqui no site. Você pode também comprar aqui e retirar na loja, estamos sempre a dispoção para atender melhor a sua vontade.</p>		
			</div>
		</article>

		<article id="lista_destaq">
			<header class="cabecalho">
				<h1>Produtos em destaque!</h1>
			</header>
		
			<!--lista de produtos em destaques-->
			<?php if(count($produto->get_produtos()) > 0) : ?>
				<?php include "_template/elementos/lista_produtos_destaque.php"; ?>
			<?php else : ?>
				<h3 class="notificacao">Não há produtos em destaque!</h3>
			<?php endif; ?>

		</article>
	</section>
</div>

<!--elemento com formulário para login-->
	<div id="fundo_login"></div>
	<div id="janela_login">
		<form method="POST">
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
			<a href="#">Esqueci minha senha</a>
			<!--botão de fechar-->
			<div class="btnFechar_modal"></div>
		</form>
	</div>

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