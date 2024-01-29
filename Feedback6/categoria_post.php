<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>

<body>

    <?php

if (isset($_REQUEST['enviar'])) {
    $parametros = array(
        'cat_nombre' => urlencode($_REQUEST['cat_nombre']),

        // Otros parámetros según tu API
    );

    $params_json = json_encode($parametros);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost/GSDAW-DWES/Feedback6/categoria.php");
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
    //echo $response; //Para ver la respuesta de la API
    $array_resultado = json_decode($response, true);
    echo "<h2>Insertado el post con id= " . $array_resultado['id'] . "</h2>";  

    } else {
    ?>
        <form action="" method="post">
            <!-- Puedes añadir más campos según los parámetros de tu API -->
            <label for="cat_nombre">Nombre de la categoría</label>
            <input type="text" name="cat_nombre">
            <br>
            <input type="submit" name="enviar" value="Aceptar">
        </form>
    <?php
    }
    ?>

</body>

</html>
