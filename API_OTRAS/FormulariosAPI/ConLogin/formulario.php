
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
   
   //usuario
   $parametros = array(
    "username"=> urlencode('prueba'),
    "password"=> urlencode('prueba')
    );
    
    $params_json = json_encode($parametros);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost/DWes/apirestauths/apirestauth/auth.php");
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

   
    $array_datos = json_decode($response, true); 






   if (isset($_REQUEST['enviar'])) {
       
    
         //jugador
    
    
         $parametros = array(
            'player_name' => urlencode($_REQUEST['player_name']),
            'player_mins' => $_REQUEST['player_mins'],
            'player_pts' => $_REQUEST['player_pts'],
            'player_asist' => $_REQUEST['player_asist'],
            'player_reb' => $_REQUEST['player_reb'],
            'player_tap' => $_REQUEST['player_tap']
        );
        
        $params_json = json_encode($parametros);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://localhost/DWes/apirestauths/apirestauth/player.php");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        
        $headers = array(
        
        'Content-Type: application/Json; charset=UTF-8',
        'api-key:'.$array_datos["token"]
        );
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params_json);
        $response = curl_exec($ch);
        curl_close($ch);
        $array_resultado = json_decode($response, true);
        echo "<h2>Insertado el post con id = " . $array_resultado['id'] . "</h2>";
        echo "<p>Resultado obtenido<p>";
        print_r($array_resultado);


   
     
        
    } else {
       
        ?>

    <form id="form_prueba" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
       

    <label for="player_name">Nombre del Jugador:</label><br>
        <input type="text" id="player_name" name="player_name" required><br><br>

        <label for="player_mins">Minutos Jugados:</label><br>
        <input type="number" id="player_mins" name="player_mins" required><br><br>

        <label for="player_pts">Puntos Anotados:</label><br>
        <input type="number" id="player_pts" name="player_pts" required><br><br>

        <label for="player_asist">Asistencias:</label><br>
        <input type="number" id="player_asist" name="player_asist" required><br><br>

        <label for="player_reb">Rebotes:</label><br>
        <input type="number" id="player_reb" name="player_reb" required><br><br>

        <label for="player_tap">Tapones:</label><br>
        <input type="number" id="player_tap" name="player_tap" required><br><br>

        <input type="submit" name="enviar" value="enviar">
    </form>

    <?php
    }
    ?>
</body>

</html>