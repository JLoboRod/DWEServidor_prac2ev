<div class="row">
        <div id="carousel-example" class="carousel slide hidden-xs" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="row">
                        <!--PRODUCTO-->
                        <div class="col-sm-6 block-center">
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
                                        
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!--PRODUCTO-->
                    </div>
                </div>
            </div>
        </div>
    </div>

