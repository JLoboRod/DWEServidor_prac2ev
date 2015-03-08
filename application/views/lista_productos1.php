<div class="row">
  
<?php foreach($productos as $producto):?>
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img data-src="<?=$producto['imagen']?>" alt="">
      <div class="caption">
        <h3><?=$producto['nombre']?></h3>
        <p><?=$producto['descripcion']?></p>
        <p>
          <a href="#" class="btn btn-primary" role="button">Botón</a>
          <a href="#" class="btn btn-default" role="button">Botón</a>
        </p>
      </div>
    </div>
  <?php endforeach;?>
  </div>
</div>