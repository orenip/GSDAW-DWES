<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabaja con BBDD</title>
</head>
<body>
    <?php
    try{
        $conexion = new mysqli('localhost', 'root', '', 'baloncesto');
        echo "<p>Se ha conectado a la BBDD</p>";

        $sql= "select * from zonas";
        $resultado= $conexion->query($sql);
        echo "<p>Filas devueltas: . $resultado->num_rows .</p>";

        //$zonas= $resultado->fetcha_all();

        /*foreach ($zonas as $key => $value){
            echo;
        }*/

    }catch(Exception $e){ 
        echo "<p>Error: ". $e->getMessage() . "</p>";
    }
    ?>
</body>
</html>