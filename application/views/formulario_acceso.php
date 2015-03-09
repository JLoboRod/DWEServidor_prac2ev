<form role="form" action="<?=base_url("index.php/clientes/acceder")?>" method="post">
    <div class="form-group <?=(isset($clase_campo_form['usuario']))?$clase_campo_form['usuario']:''?>">
        <label class="control-label" for="usuario">Usuario</label>
        <input type="text" class="form-control" name="usuario" id="usuario" value="<?= set_value('usuario'); ?>" placeholder="Introduzca el usuario">
        <span class="help-block"><?= form_error('usuario') ?></span>
    </div>
    <div class="form-group <?=(isset($clase_campo_form['password']))?$clase_campo_form['password']:''?>">
        <label class="control-label" for="password">Password</label>
        <input type="text" class="form-control" name="password" id="password" value="" placeholder="Introduzca el password">
        <span class="help-block"><?= form_error('password') ?></span>
    </div>
    <button type="submit" class="btn btn-default">Enviar</button>
    <a href="<?=site_url('clientes/restore_pass')?>">Restablecer password</a>
</form>