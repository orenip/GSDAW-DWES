
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
        curl_setopt($curl,CURLOPT_URL,"http://localhost/DWes/Pianelo_Alonso_pablo_DWES06_Tarea/articulo.php");
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($curl);
        curl_close($curl);

        $array_datos = json_decode($data, true);

        $curl2 = curl_init();
        curl_setopt($curl2,CURLOPT_URL,"http://localhost/DWes/Pianelo_Alonso_pablo_DWES06_Tarea/categoria.php");
        curl_setopt($curl2, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
        $data2 = curl_exec($curl2);
        curl_close($curl2);

        $array_datos2 = json_decode($data2, true);



         //print_r($array_datos);

        if (isset($array_datos)) {
            $articulos = $array_datos["articulos"];
            $categorias= $array_datos2["categorias"];
                
                
            ?>
            <!-- Tabla para mostrar los datos -->
            <table border="1">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>categoria</th>
                        <th>cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($articulos as $articulo) {
                        ?>
                        <tr>
                            <td><?php echo $articulo['art_nombre']; ?></td>
                            <td><?php  echo sacarNombreCategoria($articulo['art_categoria'], $categorias);   ?></td>
                            <td><?php echo $articulo['art_cantidad']; ?></td>


                        </tr>
                    <?php
                    }
                    
                    ?>
                </tbody>
            </table>
            


        <?php

          


        
        } else {
            echo "No se encontraron articulos.";
        }
       
        function sacarNombreCategoria($idCategoria, $categorias){
            foreach ($categorias as $categoria) {
                if ($idCategoria === $categoria["cat_id"]) {
                    return $categoria['cat_nombre'];
                }
            }
            return "Categoría no encontrada";
    }
        
    ?>
</body>

</html>