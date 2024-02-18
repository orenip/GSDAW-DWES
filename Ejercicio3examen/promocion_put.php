<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
</head>

<body>

    <?php

    if (isset($_REQUEST['enviar'])) {
        $parametros = array(
            'id' => 1, // Assuming you want to update a category with ID 1
            'pro_nombre' => urlencode($_REQUEST['pro_nombre']),
            'pro_lon' => urlencode($_REQUEST['pro_lon']),
            'pro_lat' => urlencode($_REQUEST['pro_lat']),

        );

        //Introducimos el token
        $apikey = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3MDgxMDQ4MjcsImRhdGEiOnsiaWQiOiIxMDAiLCJub21icmVzIjoiVXN1YXJpbyBkZSBQcnVlYmEifX0.R3AYADynxWMa1BQHDzA6fxfsC4_u8GVJRxsXtocpFVc";
        //$params_json= json_encode($params);
        //Indicamos la ruta de promocion.php
        $url = "http://localhost/GSDAW-DWES/Ejercicio3examen/promocion.php";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        //Indicamos que queremos obtener el resultado de la petición
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($curl);

        $headers = array(
            'Content-Type: application/json; charset=UTF-8'
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $params_json);
        $response = curl_exec($ch);
        curl_close($ch);
        //echo $response; //Para ver la respuesta de la API
        $array_resultado = json_decode($response, true);
        echo "<h2>Actualizada la categoría</h2>";
    } else {
    ?>
        <form action="" method="post">
            <label for="cat_nombre">Nombre</label>
            <input type="text" name="pro_nombre">
            <br>
            <label for="cat_nombre">Lon</label>
            <input type="text" name="pro_lon">
            <br>
            <label for="cat_nombre">Lat</label>
            <input type="text" name="pro_lat">
            <br>

            <input type="submit" name="enviar" value="Aceptar">
        </form>
    <?php
    }
    ?>

</body>

</html>