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
     * En este script se utiliza una API REST para hacer un POST, pero además se usa
     * un formulario HTML para recoger los datos que se enviarán a la API REST.
     */

    // Si se han enviado datos desde el formulario se recogen y se genera el JSON
    if (isset($_REQUEST['enviar'])) {
        $parametros = array(
            'title' => urlencode($_REQUEST['title']),
            'body' => urlencode($_REQUEST['body']),
            'userId' => $_REQUEST['userid']
        );

        $params_json = json_encode($parametros);

        // Se hace la llamada POST a la API
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://jsonplaceholder.typicode.com/posts");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            'Content-Type: application/json; charset=UTF-8'
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params_json);
        $response = curl_exec($ch);
        curl_close($ch);

        // OJO! Se pasa true como segundo parámetro para que el array sea asociativo
        $array_resultado = json_decode($response, true);

        // Se muestra el resultado devuelto por la API
        echo "<h2>Insertado el post con id = " . $array_resultado['id'] . "</h2>";
        echo "<p>Resultado obtenido<p>";
        print_r($array_resultado);
    } else {
        ?>

        <!-- Formulario para recoger los datos -->
        <form id="form_prueba" action="" method="post">
            <input type="hidden" name="userid" value="23">

            <label for="title">Título del post</label>
            <input type="text" name="title">
            </br>
            <textarea name="body" form="form_prueba" rows="10" cols="40" placeholder="Cuerpo del post..."></textarea>
            </br>
            <input type="submit" name="enviar" value="Aceptar">
        </form>

        <?php
    }
    ?>
</body>

</html>