
<form role="form" action="<?= base_url("index.php/clientes/registrar") ?>" method="post">
    <div class="form-group <?=(isset($clase_campo_form['usuario']))?$clase_campo_form['usuario']:''?>">
        <label class="control-label" for="usuario">Usuario</label>
        <input type="text" class="form-control" name="usuario" id="usuario" value="<?= set_value('usuario'); ?>" placeholder="Usuario">
        <span class="help-block"><?= form_error('usuario') ?></span>
    </div>

    <div class="form-group <?=(isset($clase_campo_form['password']))?$clase_campo_form['password']:''?>">
        <label class="control-label" for="password">Password</label>
        <input type="text" class="form-control" name="password" placeholder="Password"/>
        <span class="help-block"><?= form_error('password') ?></span>
    </div>
    <div class="form-group <?=(isset($clase_campo_form['email']))?$clase_campo_form['email']:''?>">
        <label class="control-label" for="email">Email</label>
        <input type="text" class="form-control" name="email" value="<?= set_value('email'); ?>" placeholder="Email"/>
        <span class="help-block"><?= form_error('email') ?></span>
    </div>
    <div class="form-group <?=(isset($clase_campo_form['nombre']))?$clase_campo_form['nombre']:''?>">
        <label class="control-label" for="nombre">Nombre</label>
        <input type="text" class="form-control" name="nombre" value="<?= set_value('nombre'); ?>" placeholder="Nombre"/>
        <span class="help-block"><?= form_error('nombre') ?></span>
    </div>
    <div class="form-group <?=(isset($clase_campo_form['apellidos']))?$clase_campo_form['apellidos']:''?>">
        <label class="control-label" for="apellidos">Apellidos</label>
        <input type="text" class="form-control" name="apellidos" value="<?= set_value('apellidos'); ?>" placeholder="Apellidos"/>
        <span class="help-block"><?= form_error('apellidos') ?></span>
    </div>
    <div class="form-group <?=(isset($clase_campo_form['dni']))?$clase_campo_form['dni']:''?>">
        <label class="control-label" for="dni">Dni</label>
        <input type="text" class="form-control" name="dni" value="<?= set_value('dni'); ?>" placeholder="Dni"/>
        <span class="help-block"><?= form_error('dni') ?></span>
    </div>
    <div class="form-group <?=(isset($clase_campo_form['direccion']))?$clase_campo_form['direccion']:''?>">
        <label class="control-label" for="direccion">Dirección</label>
        <input type="text" class="form-control" name="direccion" value="<?= set_value('direccion'); ?>" placeholder="Dirección"/>
        <span class="help-block"><?= form_error('direccion') ?></span>
    </div>
    <div class="form-group <?=(isset($clase_campo_form['cod_postal']))?$clase_campo_form['cod_postal']:''?>">
        <label class="control-label" for="cod_postal">Código Postal</label>
        <input type="text" class="form-control" name="cod_postal" value="<?= set_value('cod_postal'); ?>" placeholder="Código Postal"/>
        <span class="help-block"><?= form_error('cod_postal') ?></span>
    </div>
    <div class="form-group <?=(isset($clase_campo_form['provincia']))?$clase_campo_form['provincia']:''?>">
        <label class="control-label" for="provincia">Provincia</label>
        <?=form_dropdown('provincia', $provincias, set_value('provincia'));?>
        <span class="help-block"><?= form_error('provincia') ?></span>
    </div>
    <button type="submit" class="btn btn-default">Enviar</button>
</form>
<h2><?php if (isset($mensaje)) echo $mensaje; ?></h2>
<?= validation_errors(); ?>

