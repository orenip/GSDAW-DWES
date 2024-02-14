
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

        
       
    
        $dato= $_POST['nombre'];
        $parametros = array();
        $params_json = json_encode($parametros);

       
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://localhost/DWes/Pianelo_Alonso_pablo_DWES06_Tarea/articulo.php?art_id=".$dato);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        
        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params_json);
        $response = curl_exec($ch);
        curl_close($ch);
        echo $response;
        
    } else {
      
        ?>

    <form id="form_prueba" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
       

        <label for="nombre">ID:</label>
        <input type="text" id="nombre" name="nombre" value="" required><br><br>


        <input type="submit"  name="enviar" value="enviar">
    </form>

    <?php
    }
    ?>
</body>

</html>