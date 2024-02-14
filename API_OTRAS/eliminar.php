
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo cliente API REST con formulario</title>
</head>

<body>

    <?php
    /**
     * 
     * 
     */

    // Si se han enviado datos desde el formulario se recogen y se genera el JSON
    if (isset($_POST['enviar'])) {
       
      
      
        $params_json = json_encode($parametros);
       $dato= $_POST['nombre_jugador'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://localhost/DWes/prueba/articulo.php?art_nombre=".$dato);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        
        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params_json);
        $response = curl_exec($ch);
        curl_close($ch);
        echo $response;
        
    } else {
        echo "no se a eliminado"
        ?>

    <form id="form_prueba" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
       

        <label for="nombre_jugador">Nombre del Jugador:</label>
        <input type="text" id="nombre_jugador" name="nombre_jugador" value="" required><br><br>


        <input type="submit" value="enviar">
    </form>

    <?php
    }
    ?>
</body>

</html>