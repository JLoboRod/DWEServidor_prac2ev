<?php if(isset($mensaje) && $mensaje):?>  
<div class="alert alert-danger mensaje">
    <span class="glyphicon glyphicon-warning-sign"></span>
    <?=$mensaje?>
</div>
<?php endif;?>