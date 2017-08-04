<ul>
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
				<input type="number" step="1" name="quantidade" value="1"/><a href="#"><input type="submit" name="carrinho" value="+ Carrinho" /></a>
			</form>
			</li>
		<?php endif; ?>
	<?php endforeach; ?>
</ul>