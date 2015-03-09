<!-- CABECERA -->
<!-- Static navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= base_url() ?>">2DAWShop</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?=base_url()?>">Home</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Categorías <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <?php if(isset($categorias)):?>
                        <?php foreach($categorias as $categoria):?>
                            <li><a href="<?=urldecode(site_url('principal/mostrar_categoria/'.$categoria['nombre']))?>"><?=$categoria['nombre']?></a></li>
                        <?php endforeach;?>
                        <?php endif;?>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <div class="pull-right">
                    <form class="navbar-form" role="search" action="<?=base_url('index.php/principal/buscar_productos')?>" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Buscar..." name="busqueda">
                            <div class="input-group-btn" type="submit">
                                <button class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>        
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?=site_url('principal/mostrar_carrito')?>">
                    <span class="glyphicon glyphicon-shopping-cart"></span>
                    <span class="badge cod-envio pull-right"><?=$this->cart->total_items()?></span>
                </a>

            </li>
            <?php if(!$this->session->userdata('usuario')) :?>
                <li><a href="<?= base_url('index.php/clientes/acceder') ?>">Acceder</a></li>
                <li><a href="<?= base_url('index.php/clientes/registrar') ?>">Registro</a></li>
            <?php else :?>
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><strong><?=$this->session->userdata('usuario')?></strong><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="<?=base_url('index.php/clientes/editar')?>">Editar información</a></li>
                        
                        <li><a href="<?=base_url('index.php/clientes/dar_de_baja')?>">Darse de baja</a></li>
                        
                        <li><a href="#">Ver pedidos</a></li>
                        
                    
                    </ul>
                </li>

                <li>
                    <a href="<?= base_url('index.php/clientes/salir') ?>">
                        <i class="glyphicon glyphicon-log-out"></i>
                        Salir
                    </a>
                </li>
            <?php endif;?>

        </ul>
    </div><!--/.nav-collapse -->
</div><!--/.container -->
</nav>
