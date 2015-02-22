<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Test View</title>
</head>
<body>
    <span>Estás en la vista de prueba.</span>
    <pre>
        <?php
        (isset($provincia))? print_r($provincia): print_r('');
        ?>
    </pre>
    
    <?php
        
        if(isset($provincias)){
            foreach ($provincias as $clave => $valor) {
                echo "<p>".$valor['nombre']."</p>";
            }
        }  
    ?>
    
    <?php
        if(isset($clientes)){
            foreach ($clientes as $clave => $valor) {
                echo "<p>".$valor['nombre']."</p>";
            }
        }
    ?>
</body>
</html>