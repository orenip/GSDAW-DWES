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
        $id = $_REQUEST['id'];
        $query_string = http_build_query(array('id' => $id));
        //Introducimos el token
        $apikey = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3MDgxMDQ4MjcsImRhdGEiOnsiaWQiOiIxMDAiLCJub21icmVzIjoiVXN1YXJpbyBkZSBQcnVlYmEifX0.R3AYADynxWMa1BQHDzA6fxfsC4_u8GVJRxsXtocpFVc";
        //$params_json= json_encode($params);
        //Indicamos la ruta de inmueble.php
        $url = "http://localhost/GSDAW-DWES/Ejercicio3examen/inmueble.php";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        //Indicamos que queremos obtener el resultado de la petición
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($curl);

        $headers = array(
            'Content-Type: application/json; charset=UTF-8'
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $params_json);
        $response = curl_exec($ch);
        curl_close($ch);

        $array_resultado = json_decode($response, true);
        echo "<h2>Eliminado con id= " . $id . "</h2>";
    } else {
    ?>
        <form action="" method="post">
            <label for="id">Id Inmueble</label>
            <input type="text" name="id">
            <br>
            <input type="submit" name="enviar" value="Eliminar">
        </form>
    <?php
    }
    ?>

</body>

</html>