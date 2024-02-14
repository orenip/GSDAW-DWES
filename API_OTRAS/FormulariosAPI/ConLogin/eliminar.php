
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








    if (isset($_POST['enviar'])) {

        
        
    
        $dato=$_POST['nombre'];
        $parametros = array();
        $params_json = json_encode($parametros);

      
       
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://localhost/DWes/apirestauths/apirestauth/player.php?id=".$dato);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        
              
        $headers = array(
        
            'Content-Type: application/Json; charset=UTF-8',
            'api-key:'.$array_datos["token"]
            );
            
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params_json);
        $response = curl_exec($ch);
        curl_close($ch);
        echo $response;
        
    } else {
      
        ?>

    <form id="form_prueba" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
       

        <label for="nombre">id:</label>
        <input type="text" id="nombre" name="nombre" value="" required><br><br>


        <input type="submit" name="enviar" value="enviar">
    </form>

    <?php
    }
    ?>
</body>

</html>