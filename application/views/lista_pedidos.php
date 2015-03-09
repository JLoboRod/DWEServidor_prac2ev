<h1>Listado de pedidos</h1>
<table class="table">
	<thead>
		<tr>
			<th>Id</th>
			<th>Cliente Id</th>
			<th>Email</th>
			<th>Estado</th>
			<th>Nombre</th>
			<th>Apellidos</th>
			<th>Dni</th>
			<th>Direccion</th>
			<th>Cod Postal</th>
			<th>Provincia</th>
			<th>Fecha</th>
			<th>Cantidad</th>
			<th>Importe</th>
			
		</tr>


	</thead>
	<tbody>
		
		<?php foreach ($pedidos as $pedido) :?>
			<tr>
			<td><?=$pedido['id']?></td>
			<td><?=$pedido['cliente_id']?></td>
			<td><?=$pedido['email']?></td>
			<td><?=$pedido['estado']?></td>
			<td><?=$pedido['nombre']?></td>
			<td><?=$pedido['apellidos']?></td>
			<td><?=$pedido['dni']?></td>
			<td><?=$pedido['direccion']?></td>
			<td><?=$pedido['cod_postal']?></td>
			<td><?=$pedido['provincia']?></td>
			<td><?=$pedido['fecha_pedido']?></td>
			<td><?=$pedido['cantidad']?></td>
			<td><?=$pedido['importe']?></td>
			</tr>

		<?php endforeach;?>
		

	</tbody>
</table>