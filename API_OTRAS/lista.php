
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
 

        

        $curl = curl_init();
        curl_setopt($curl,CURLOPT_URL,"http://localhost/DWes/prueba/articulo.php");
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($curl);
        curl_close($curl);

        $array_datos = json_decode($data, true);
        // print_r($array_datos);

        if (isset($array_datos)) {
            $vacaciones = $array_datos["articulo"];
            ?>
            <!-- Tabla para mostrar los datos -->
            <table border="1">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>categoria</th>
                        <th>Fecha</th>
                        <th>cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($vacaciones as $vacacion) {
                        ?>
                        <tr>
                            <td><?php echo $vacacion['art_nombre']; ?></td>
                            <td><?php echo $vacacion['art_categoria']; ?></td>
                            <td><?php echo $vacacion['fecha_nacimiento']; ?></td>
                            <td><?php echo $vacacion['art_cantidad']; ?></td>


                        </tr>
                    <?php
                    }
                    
                    ?>
                </tbody>
            </table>
            
        <?php
        } else {
            echo "No se encontraron vacaciones para el año especificado.";
        }
   
    ?>
</body>

</html>