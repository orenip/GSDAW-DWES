
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
       
       echo $_POST['equipo_id'];
        $parametros = array(
        // 'equipo_id' => $_POST['equipo_id'],
        // 'nombre_jugador' => urlencode($_POST['nombre_jugador']),
        // 'fecha_nacimiento' => urlencode($_POST['fecha_nacimiento']),
        // 'estatura' => $_POST['estatura'],
        // 'posicion' => $_POST['posicion']
        'art_id' => $_POST['equipo_id'],
        'art_nombre' => urlencode($_POST['nombre_jugador']),
        'art_categoria' => $_POST['fecha_nacimiento'],
        'art_cantidad' => $_POST['estatura'],
        );
        
        $params_json = json_encode($parametros);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://localhost/DWes/prueba/jugadores.php");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        
        $headers = array(
        
        'Content-Type: application/Json; charset=UTF-8'
        
        );
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params_json);
        $response = curl_exec($ch);
      
        curl_close($ch);
        echo $response;
     
        
    } else {
        ?>

    <form id="form_prueba" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="equipo_id">ID de Equipo:</label>
        <input type="text" id="equipo_id" name="equipo_id" value="" required><br><br>

        <label for="nombre_jugador">Nombre del Jugador:</label>
        <input type="text" id="nombre_jugador" name="nombre_jugador" value="" required><br><br>

        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="" required><br><br>

        <label for="estatura">Estatura (en cm):</label>
        <input type="number" id="estatura" name="estatura" value="" required><br><br>

        <!-- <label for="posicion">Posición:</label>
        <select id="posicion" name="posicion" required>
            <option value="0" selected>Posición 0</option>
        </select><br><br> -->

        <input type="submit" value="enviar">
    </form>

    <?php
    }
    ?>
</body>

</html>