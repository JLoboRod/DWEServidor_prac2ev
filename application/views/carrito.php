	
	<h2>Carrito</h2>
	<form action="" method="post">
		<table class="table table-striped">

			<tr>
				<th>row id</th>
				<th>Nombre</th>
				<th>Precio</th>
				<th>Cantidad</th>
			</tr>

			<?php foreach($articulos as $item) :?>
				<tr>
					<td><?=$item['rowid']?></td>
					<td><?=$item['name']?></td>
					<td><?=$item['price']?></td>
					<td><input class="cantidad" type="number" min="0" max="<?=$item['stock']?>" name="<?=$item['rowid']?>" value="<?=$item['qty']?>"/></td>
				</tr>
			<?php endforeach;?>

			<tr id="total">
				<td><strong>Total:</strong></td>
				<td colspan="1"><?=$total?> euros.</td>
				<td colspan="3"><a class="danger" href="<?=site_url('principal/vaciar_carrito')?>">Vaciar carrito</a></td>
			</tr>
		</table>
		<div class="pull-right">
			<button class="btn btn-default" type="submit">Actualizar</button>
			<a href="<?=site_url('principal/procesar_compra')?>" class="btn btn-default" type="button">Completar compra</a>
		</div>
	</form>

