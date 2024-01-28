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
            'title' => urlencode($_REQUEST['title']),
            'body' => urlencode($_REQUEST['body']),
            'userId' => $_REQUEST['userid']
        );

        $params_json = json_encode($parametros);

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
        $array_resultado = json_decode($response, true);
        echo "<h2>Insertado el post con id= " . $array_resultado['id'] . "</h2>";
    } else {
    ?>
        <form action="" method="post">
            <input type="hidden" name="userid" value="23">
            <label for="title">Titulo del post</label>
            <input type="text" name="title">
            <br>
            <label for="body">Cuerpo del post</label>
            <input type="text" name="body">
            <br>
            <input type="submit" name="enviar" value="Aceptar">
        </form>
    <?php
    }
    ?>

</body>

</html>