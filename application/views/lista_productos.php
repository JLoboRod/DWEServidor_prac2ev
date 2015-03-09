
<div class="row">
  <div id="carousel-example" class="carousel slide hidden-xs" data-ride="carousel">
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <div class="row">
          <!--PRODUCTOS-->
          <?php foreach($productos as $producto):?>
            <div class="col-sm-4">
              <div class="col-item">
                <div class="photo">
                  <img src="<?=$producto['imagen']?>" class="img-responsive" alt="a" />
                </div>
                <div class="info">
                  <div class="row">
                    <div class="price col-md-12">
                      <h5 class="game-title">
                        <strong><?=$producto['nombre']?></strong>
                      </h5>
                      <h5>
                        <?=$producto['categoria']?>
                      </h5>
                      <h5 class="price-text-color">
                        <?=$producto['precio_venta']?>€</h5>
                        <h5 class="desc-text-color">
                          <?=(isset($producto['descuento']))?'-'.$producto['descuento'].'%' : 'Sin descuento'?></h5>
                        <h5 class="desc-text-color">
                          <?=($producto['stock'])?'En stock: '.$producto['stock'] : 'Sin stock'?></h5>
                        </div>

                      </div>
                      <div class="separator clear-left">
                        <form action="<?=site_url('principal/agregar_producto/'.$producto['id'])?>" method="post">
                          <input type="hidden" name="id_producto" value="<?=$producto['id']?>"/>
                          <input type="hidden" name="descuento" value="<?=$producto['descuento']?>"/>
                          <input type="hidden" name="url" value="<?= current_url() ?>" />
                          <p>
                            <div class="form-group <?=(isset($clase_campo_form['usuario']))?$clase_campo_form['usuario']:''?>">
                              <input type="number" class="form-control" name="cantidad" id="cantidad" min="1" value="1">
                              <span class="help-block"><?= form_error('cantidad') ?></span>
                            </div>

                          </p>
                          <p><button type="submit" class="hidden-sm"><i class="fa fa-shopping-cart"></i>Agregar al carrito</button></p>
                        </form>
                      </div>
                      <div class="clearfix">
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach;?>
              <!--PRODUCTOS-->
            </div>
          </div>
        </div>
      </div>
    </div>
