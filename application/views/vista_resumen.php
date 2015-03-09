<h1>Resumen compra</h1>

<form action="<?=site_url('principal/procesar_compra')?>" method="post">
<div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="text-center"><strong>Detalle Pedido</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <td><strong>Nombre Producto</strong></td>
                                    
                                    <td class="text-center"><strong>Cantidad</strong></td>
                                    <td class="text-right"><strong>Precio</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                
								<?php foreach($productos as $producto):?>
                                <tr>
                                    <td><?=$producto['name']?></td>
                                    
                                    <td class="text-center"><?=$producto['qty']?></td>
                                    <td class="text-right"><?=$producto['price']?></td>
                                </tr>
                            	<?php endforeach;?>
                                <tr>
                                    <td></td>
                                   
                                    <td class="text-center"><strong>Total</strong></td>
                                    <td class="text-right"><?=$total?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="submit" class="btn btn-default pull-right" name="resumen_compra" value="Continuar"/>
</div>
</form>
