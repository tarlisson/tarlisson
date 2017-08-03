<!DOCTYPE html>
<html>
<head>
	<title>BOMBOM VIDA</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="../_css/bombomvida.css" />
	<link rel="stylesheet" type="text/css" href="../_css/cadastro.css"/>
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
				<li><a href="compras.php">Minhas compras</a></li>
				<li><a href="?sair=true" class="logoff">Sair</a></li>
			</ul>
		</li>
		<?php else : ?>
			<a id="logar" href="">Logar</a>
			</li>
		<?php endif; ?>
	</ul>
</nav>
<div id="container">
	<section>
		<form method="post" id="form_cadastro" class="clear-fix">
			<fieldset>
				<legend>Dados Pessoais</legend>
				<input type="text" name="id" value="<?php echo $cliente->get_id(); ?>" style="display: none;"/>
				<label>
					Nome:
					<?php if(!$exito && isset($msg_erros['nome'])) : ?>
						<span class="erro"><?php echo $msg_erros['nome']; ?></span>
					<?php endif; ?>
					<input type="text" name="nome" required="required" value="<?php echo $cliente->get_nome(); ?>" />
				</label>
				<label>
					Sobrenome:
					<?php if(!$exito && isset($msg_erros['sobrenome'])) : ?>
						<span class="erro"><?php echo $msg_erros['sobrenome']; ?></span>
					<?php endif; ?>				
					<input type="text" name="sobrenome" required="required" value="<?php echo $cliente->get_sobrenome(); ?>"/>
				</label>
				<label>
					Data de nascimento: 
					<?php if(!$exito && isset($msg_erros['data'])) : ?>
						<span class="erro"><?php echo $msg_erros['data']; ?></span>
					<?php endif; ?>
					<input type="text" name="data" required="required" value="<?php echo (strlen($cliente->get_dataNasc()) > 0) ? $helper->traduz_data_para_exibir($cliente->get_dataNasc()) : ""; ?>"/>
				</label>
				<label>
					CPF:
					<?php if(!$exito && isset($msg_erros['cpf'])) : ?>
						<span class="erro"><?php echo $msg_erros['cpf']; ?></span>
					<?php endif; ?>
					<input type="text" name="cpf" required="required" value="<?php echo $cliente->get_cpf(); ?>"/>				
				</label>
				<label>
					RG: 
					<?php if(!$exito && isset($msg_erros['rg'])) : ?>
						<span class="erro"><?php echo $msg_erros['rg']; ?></span>
					<?php endif; ?>
					<input type="text" name="rg" required="required" value="<?php echo $cliente->get_rg(); ?>"/>
				</label>
				<label>
					Telefone: 
					<?php if(!$exito && isset($msg_erros['telefone'])) : ?>
						<span class="erro"><?php echo $msg_erros['telefone']; ?></span>
					<?php endif; ?>
					<input type="text" name="telefone" required="required" value="<?php echo $cliente->get_telefone(); ?>"/>
				</label>			
				<label>
					Celular: 
					<?php if(!$exito && isset($msg_erros['telefone'])) : ?>
						<span class="erro"><?php echo $msg_erros['telefone']; ?></span>
					<?php endif; ?>
					<input type="text" name="celular" required="required" value="<?php echo $cliente->get_celular(); ?>"/>
				</label>
			</fieldset>
			<fieldset>
				<legend>Endereço</legend>
				<input type="text" name="id_endereco" value="<?php echo $cliente->get_idEndereco(); ?>" style="display: none;"/>
				<label>
					Rua/Avenida: 
					<?php if(!$exito && isset($msg_erros['rua'])) : ?>
						<span class="erro"><?php echo $msg_erros['rua']; ?></span>
					<?php endif; ?>
					<input type="text" name="rua" required="required" value="<?php echo $cliente->get_rua(); ?>"/>				
				</label>
				<label>
					Nº: 
					<?php if(!$exito && isset($msg_erros['numero'])) : ?>
						<span class="erro"><?php echo $msg_erros['numero']; ?></span>
					<?php endif; ?>
					<input type="text" name="numero" required="required" value="<?php echo $cliente->get_numero(); ?>"/>
				</label>
				<label>
					Bairro: 
					<?php if(!$exito && isset($msg_erros['bairro'])) : ?>
						<span class="erro"><?php echo $msg_erros['bairro']; ?></span>
					<?php endif; ?>
					<input type="text" name="bairro" required="required" value="<?php echo $cliente->get_bairro(); ?>"/>
				</label>
				<label>
					Cidade: 
					<?php if(!$exito && isset($msg_erros['cidade'])) : ?>
						<span class="erro"><?php echo $msg_erros['cidade']; ?></span>
					<?php endif; ?>
					<input type="text" name="cidade" required="required" value="<?php echo $cliente->get_cidade(); ?>"/>
				</label>
				<label>
					CEP: 
					<?php if(!$exito && isset($msg_erros['cep'])) : ?>
						<span class="erro"><?php echo $msg_erros['cep']; ?></span>
					<?php endif; ?>
					<input type="text" name="cep" required="required" value="<?php echo $cliente->get_cep(); ?>"/>
				</label>			
			</fieldset>
			<fieldset>
				<legend>Dados de login</legend>
				<label>
					E-mail: 
					<?php if(!$exito && isset($msg_erros['email'])) : ?>
						<span class="erro"><?php echo $msg_erros['email']; ?></span>
					<?php endif; ?>
					<input type="text" name="email" required="required" value="<?php echo $cliente->get_email(); ?>"/>
				</label>
				<label>
					Senha:
					<input type="password" name="senha" required="required"/>
				</label>
				<label>
					Confirme a senha: 
					<?php if(!$exito && isset($msg_erros['senha'])) : ?>
						<span class="erro"><?php echo $msg_erros['senha']; ?></span>
					<?php endif; ?>
					<input type="password" name="senhaRep" required="required"/>
				</label>
			</fieldset>
			<a href="home.php"><input class="alinhado_direita" type="button" name="" value="cancelar" /></a>
			<input class="alinhado_direita" type="submit" name="" value="<?php echo ($cliente->get_id() > 0)? "Atualizar" : "Cadastrar" ?>"/>
		</form>	
	</section>
</div>

<?php if ($exito) : ?>
	<div id="fundo_aviso"></div>
	<div class="caixa_aviso concluida" />
		<p>
			<?php echo ($cliente->get_id() > 0) ? "Cadastro atualizado!" : "Cadastro concluído!"; ?>
		</p>
		<a href="home.php">Ok</a>
	</div>
<?php endif; ?>

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