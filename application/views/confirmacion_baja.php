<div class="col-sm-4 col-sm-offset-2">
<form role="form" action="<?=site_url('clientes/dar_de_baja')?>" method="post">
    <p>Confirmación de baja</p>
    <p><?=$mensaje?></p>

    <input type="submit" name="si" class="btn btn-default" value="Sí"/>
    <input type="submit" name="no" class="btn btn-default" value="No"/>
</form>
</div>
