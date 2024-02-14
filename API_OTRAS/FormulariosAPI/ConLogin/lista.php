
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
//    print_r( $array_datos["token"] );



    //jugador
       $curl = curl_init();
        curl_setopt($curl,CURLOPT_URL,"http://localhost/DWes/apirestauths/apirestauth/player.php");
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

           
    $headers = array(
    
        'Content-Type: application/Json; charset=UTF-8',
        'api-key:'.$array_datos["token"]
        );
        
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $data = curl_exec($curl);
        curl_close($curl);

        $array_datos = json_decode($data, true);

       


      

         if (isset($array_datos)) {
            $players = $array_datos["usuarios"];
           
                
                
            ?>
            <!-- Tabla para mostrar los datos -->
            <table border="1">
                <thead>
                    <tr>
                        <th>player_name</th>
                        <th>player_mins</th>
                        <th>player_pts</th>
                        <th>player_asist</th>
                        <th>player_reb</th>
                        <th>player_tap</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($players as $player) {
                        // print_r($players);
                        // print_r($player);
                        ?>
                        <tr>
                            <td><?php echo $player['player_name']; ?></td>
                            <td><?php  echo $player['player_mins'];  ?></td>
                            <td><?php echo $player['player_pts']; ?></td>
                            <td><?php echo $player['player_asist']; ?></td>
                            <td><?php echo $player['player_reb']; ?></td>
                            <td><?php echo $player['player_tap']; ?></td>


                        </tr>
                    <?php
                    }
                    
                    ?>
                </tbody>
            </table>
            


        <?php

          


        
        } else {
            echo "No se encontraron players.";
        }
       
      
    
        
    ?>
</body>

</html>