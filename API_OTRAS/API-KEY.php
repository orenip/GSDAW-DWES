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
     *PabloPianelo
     * Superpablo1234
     */

    // Si se han enviado datos desde el formulario se recogen y se genera el JSON
    if (isset($_REQUEST['enviar'])) {

        $key = "7oBs5Wljh3KJb3txqTJXCjUyekQWhkFs";
        $country = "ES";
        $year = 2019;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://calendarific.com/api/v2/holidays?&api_key=" . $key . "&country=" . $country . "&year=" . $year);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($curl);
        curl_close($curl);

        $array_datos = json_decode($data, true);
        // print_r($array_datos["response"]["holidays"]);

        if (isset($array_datos)) {
            $vacaciones = $array_datos["response"]["holidays"];
            ?>
            <!-- Tabla para mostrar los datos -->
            <table border="1">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Fecha</th>
                        <th>Tipo de Observancia</th>
                        <th>Mensajer Servidor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($vacaciones as $vacacion) {
                        ?>
                        <tr>
                            <td><?php echo $vacacion['name']; ?></td>
                            <td><?php echo $vacacion['description']; ?></td>
                            <td><?php echo $vacacion['date']['iso']; ?></td>
                            <td><?php echo implode(', ', $vacacion['type'])//preguntar; ?></td>
                            <td><?php echo $array_datos['meta']['code']; ?></td>


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
    } else {
        ?>

        <!-- Formulario para recoger los datos -->
        <form id="form_prueba" action="" method="post">
            <input type="submit" name="enviar" value="Aceptar">
        </form>

    <?php
    }
    ?>
</body>

</html>