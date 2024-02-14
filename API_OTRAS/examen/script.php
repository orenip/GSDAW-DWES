<?php


$parametros = array(
    "username"=> urlencode('prueba'),
    "password"=> urlencode('prueba')
    );
    
    $params_json = json_encode($parametros);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost/GSDAW-DWES/API_OTRAS/examen/ejercicio2/auth.php");
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




    //empresa
       $curl = curl_init();
        curl_setopt($curl,CURLOPT_URL,"http://localhost/GSDAW-DWES/API_OTRAS/examen/ejercicio2/empresa.php");
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

           
    $headers = array(
    
        'Content-Type: application/Json; charset=UTF-8',
        'api-key:'.$array_datos["token"]
        );
        
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $data = curl_exec($curl);
        curl_close($curl);

        $array_empresa = json_decode($data, true);

       


      

         if (isset($array_empresa)) {
            $empresas = $array_empresa["empresas"];
           
            ?> 

<form id="form_prueba" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <h1>SELECIONA LA EMPRESA</h1>
            <select name="select">
            <?php  foreach ($empresas as $empresa) {?>
            <option value="<?php echo $empresa['emp_id']; ?>"><?php echo $empresa['emp_nombre']; ?></option>
            <?php }    ?>
        </select>

            <input type="submit" name="enviar" value="enviar">
    </form>
<?php
           
    }


    
   if (isset($_REQUEST['enviar'])) {


    if (isset($_POST["select"])) {
        $opcionSeleccionada = $_POST["select"];
        
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_URL,"http://localhost/GSDAW-DWES/API_OTRAS/examen/ejercicio2/apto.php?emp_id=".$opcionSeleccionada);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

           
    $headers = array(
    
        'Content-Type: application/Json; charset=UTF-8',
        'api-key:'.$array_datos["token"]
        );
        
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $data = curl_exec($curl);
        curl_close($curl);

        $array_apto = json_decode($data);

        print_r($array_apto);
            






    } else {
        echo "No se ha seleccionado ninguna opción.";
    }
        
    }








?>