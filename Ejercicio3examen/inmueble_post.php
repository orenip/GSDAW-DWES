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
            'inm_referencia' => urlencode($_REQUEST['inm_referencia']),
            'inm_descripcion' => urlencode($_REQUEST['inm_descripcion']),
            'inm_habitaciones' => urlencode($_REQUEST['inm_habitaciones']),
            'inm_precio' => urlencode($_REQUEST['inm_precio']),
            'inm_promocion' => urlencode($_REQUEST['inm_promocion']),

        );
        //Introducimos el token
        $apikey = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3MDgxMDQ4MjcsImRhdGEiOnsiaWQiOiIxMDAiLCJub21icmVzIjoiVXN1YXJpbyBkZSBQcnVlYmEifX0.R3AYADynxWMa1BQHDzA6fxfsC4_u8GVJRxsXtocpFVc";
        //$params_json= json_encode($params);
        //Indicamos la ruta de inmueble.php
        $url = "http://localhost/GSDAW-DWES/Ejercicio3examen/inmueble.php";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        //Indicamos que queremos obtener el resultado de la petición
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
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
        echo "<h2>Insertado el inmueble con id= " . $array_resultado['id'] . "</h2>";
    } else {
    ?>
        <form action="" method="post">
            <!-- Puedes añadir más campos según los parámetros de tu API -->
            <label for="cat_nombre">Referencia</label>
            <input type="text" name="inm_referencia">
            <br>
            <label for="cat_nombre">Descripcion</label>
            <input type="text" name="inm_descripcion">
            <br>
            <label for="cat_nombre">Nombre de la categoría</label>
            <input type="text" name="cat_nombre">
            <br>
            <label for="cat_nombre">Habitaciones</label>
            <input type="text" name="inm_habitaciones">
            <br>
            <label for="cat_nombre">Precio</label>
            <input type="text" name="inm_precio">
            <br>
            <label for="cat_nombre">Promocion</label>
            <input type="text" name="inm_promocion">
            <br>
            <input type="submit" name="enviar" value="Aceptar">
        </form>
    <?php
    }
    ?>

</body>

</html>