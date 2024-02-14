
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
   
   
   $curl2 = curl_init();
   curl_setopt($curl2,CURLOPT_URL,"http://localhost/DWes/Pianelo_Alonso_pablo_DWES06_Tarea/categoria.php");
   curl_setopt($curl2, CURLOPT_SSL_VERIFYPEER, false);
   curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
   $data2 = curl_exec($curl2);
   curl_close($curl2);
   $array_datos2 = json_decode($data2, true);
   
   

   if (isset($_REQUEST['enviar'])) {
       
    if ($_REQUEST['categoria_id']!=" ") {
      
    
       
        $parametros = array(
        'art_nombre' => urlencode($_REQUEST['nombre']),
        'art_categoria' => $_REQUEST['categoria_id'],
        'art_cantidad' => $_REQUEST['cantidad'],
        );
        
        $params_json = json_encode($parametros);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://localhost/DWes/Pianelo_Alonso_pablo_DWES06_Tarea/articulo.php");
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
        $array_resultado = json_decode($response, true);
       
        print_r($array_resultado);


    }else{
        echo "Campo no valido ";
    }
     
        
    } else {
       
        ?>

    <form id="form_prueba" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
       

        <label for="nombre">Nombre :</label>
        <input type="text" id="nombre" name="nombre" value="" required><br><br>

        <!-- <label for="categoria">categoria:</label>
        <input type="number" id="categoria" name="categoria" value="" required><br><br> -->

        <label for="cantidad">categorias:</label>
        <select id="categorias" name="categoria_id"> 
        <option value=" ">Opciones</option>
                <?php
                $categorias = $array_datos2["categorias"];
                foreach ($categorias as $categoria) {
                    echo '<option value=' . $categoria["cat_id"] . '>' . $categoria["cat_nombre"] . '</option>';
                }
                ?>
            </select>
            
            <br><br>
        <label for="cantidad">cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" value="" required><br><br>

        <input type="submit" name="enviar" value="enviar">
    </form>

    <?php
    }
    ?>
</body>

</html>