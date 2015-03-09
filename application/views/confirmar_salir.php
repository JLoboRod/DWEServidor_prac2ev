<div class="col-sm-4 col-sm-offset-2">
<form role="form" action="<?=site_url('clientes/salir')?>" method="post">
    <p>Confirmación salir</p>
    <p><?=isset($mensaje)?$mensaje:''?></p>

    <input type="submit" name="si" class="btn btn-default" value="Sí"/>
    <input type="submit" name="no" class="btn btn-default" value="No"/>
</form>
</div>