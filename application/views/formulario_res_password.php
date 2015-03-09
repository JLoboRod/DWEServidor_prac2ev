<form role="form" action="<?=base_url("index.php/clientes/restore_pass")?>" method="post">
    <div class="form-group <?=(isset($clase_campo_form['email']))?$clase_campo_form['email']:''?>">
        <label class="control-label" for="email">Email</label>
        <input type="text" class="form-control" name="email" id="email" value="<?= set_value('email'); ?>" placeholder="Introduzca el email">
        <span class="help-block"><?= form_error('email') ?></span>
    </div>
    <button type="submit" class="btn btn-default">Enviar</button>
</form>