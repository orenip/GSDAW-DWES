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
            'cat_id' => 1, // Assuming you want to update a category with ID 1
            'cat_nombre' => urlencode($_REQUEST['cat_nombre']),
            // Other parameters according to your API
        );

        $params_json = json_encode($parametros);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://localhost/GSDAW-DWES/Feedback6/categoria.php");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Content-Type: application/json"
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params_json);
        $response = curl_exec($ch);
        curl_close($ch);

        // echo $response; // Uncomment to see the response from the API
        $array_resultado = json_decode($response, true);
        echo "<h2>Actualizada la categoría</h2>";

    } else {
    ?>
        <form action="" method="post">
            <label for="cat_nombre">Nuevo nombre de la categoría</label>
            <input type="text" name="cat_nombre">
            <br>
            <input type="submit" name="enviar" value="Aceptar">
        </form>
    <?php
    }
    ?>

</body>

</html>