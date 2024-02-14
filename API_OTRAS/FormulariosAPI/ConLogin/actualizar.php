
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
   // echo $_POST['categoria_id'];
   
   
 //usuario
   $parametros = array(
    "username"=> urlencode('prueba'),
    "password"=> urlencode('prueba')
    );
    
    $params_json = json_encode($parametros);
    
    $ch1 = curl_init();
    curl_setopt($ch1, CURLOPT_URL, "http://localhost/DWes/apirestauths/apirestauth/auth.php");
    curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch1, CURLOPT_POST, true);
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
    
    
    $headers = array(
    
    'Content-Type: application/Json; charset=UTF-8'
    
    );
    
    curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);  
    curl_setopt($ch1, CURLOPT_POSTFIELDS, $params_json);
    $response = curl_exec($ch1);
    curl_close($ch1);

    $array_datos = json_decode($response, true); 



//sacar jugador
   $curl3 = curl_init();
   curl_setopt($curl3,CURLOPT_URL,"http://localhost/DWes/apirestauths/apirestauth/player.php?id=1");
   curl_setopt($curl3, CURLOPT_SSL_VERIFYPEER, false);
   curl_setopt($curl3, CURLOPT_RETURNTRANSFER, true);
            
   $headers = array(
    
    'Content-Type: application/Json; charset=UTF-8',
    'api-key:'.$array_datos["token"]
    );
    
    curl_setopt($curl3, CURLOPT_HTTPHEADER, $headers);
   $data3 = curl_exec($curl3);
   curl_close($curl3);
   $array_datos3 = json_decode($data3, true);



   
   

   if (isset($_REQUEST['enviar'])) {
       
  
      
        $parametros = array(
            'player_name'  => urlencode($_REQUEST["player_name"]),
            'player_mins' => $_REQUEST["player_mins"],
            'player_pts' => $_REQUEST["player_pts"],
            'player_asist' => $_REQUEST["player_asist"],
            'player_reb' => $_REQUEST["player_reb"],
            'player_tap' => $_REQUEST["player_tap"]
        );
        
        $params_json = json_encode($parametros);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://localhost/DWes/apirestauths/apirestauth/player.php?id=1");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
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
    
        print_r($array_resultado);

     
        
    } else {


        $players = $array_datos3["usuarios"];
        foreach ($players as $player) {
            $player_name = $player["player_name"];
            $player_mins = $player["player_mins"];
            $player_pts = $player["player_pts"];
            $player_asist = $player["player_asist"];
            $player_reb = $player["player_reb"];
            $player_tap = $player["player_tap"];
        }

       
        ?>

    <form id="form_prueba" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
       

        <label for="player_name">Nombre del Jugador:</label><br>
        <input type="text" id="player_name" name="player_name" value="<?php echo $player_name; ?>" required><br><br>

        <label for="player_mins">Minutos Jugados:</label><br>
        <input type="number" id="player_mins" name="player_mins" value="<?php echo $player_mins; ?>" required><br><br>

        <label for="player_pts">Puntos Anotados:</label><br>
        <input type="number" id="player_pts" name="player_pts" value="<?php echo $player_pts; ?>" required><br><br>

        <label for="player_asist">Asistencias:</label><br>
        <input type="number" id="player_asist" name="player_asist" value="<?php echo $player_asist; ?>"  required><br><br>

        <label for="player_reb">Rebotes:</label><br>
        <input type="number" id="player_reb" name="player_reb" value="<?php echo $player_reb; ?>" required><br><br>

        <label for="player_tap">Tapones:</label><br>
        <input type="number" id="player_tap" name="player_tap" value="<?php echo $player_tap; ?>" required><br><br>
        

        <input type="submit" name="enviar" value="enviar">
    </form>

    <?php
    }
    ?>
</body>

</html>