
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
                                        </div>
                                        <!--
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                        -->
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Agregar al carrito</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>
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
