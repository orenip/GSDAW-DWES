<?php

//Introducimos el token
$apikey = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3MDgxMDQ4MjcsImRhdGEiOnsiaWQiOiIxMDAiLCJub21icmVzIjoiVXN1YXJpbyBkZSBQcnVlYmEifX0.R3AYADynxWMa1BQHDzA6fxfsC4_u8GVJRxsXtocpFVc";
//$params_json= json_encode($params);
//Indicamos la ruta de promocion.php
$url = "http://localhost/GSDAW-DWES/Ejercicio3examen/promocion.php";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
//Indicamos que queremos obtener el resultado de la petición
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($curl);

$headers = array(
    'Content-Type: application/json", Charset: "UTF-8',
    'api-key:' . $apikey
);

if ($data === false) {
    die('Error executing cURL request: ' . curl_error($curl));
}

curl_close($curl);

$array_datos = json_decode($data, true);

if ($array_datos === null) {
    die('Error decoding JSON: ' . json_last_error_msg());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
</head>

<body>

    <form action="" method="get">
        <label for="filtro_cat_id">Filtrar por ID:</label>
        <input type="text" name="filtro_cat_id">
        <br>
        <label for="filtro_cat_nombre">Filtrar por Referencia:</label>
        <input type="text" name="filtro_cat_nombre">
        <br>
        <input type="submit" name="filtrar" value="Filtrar">
    </form>
    <?php

    if (is_array($array_datos) && count($array_datos) > 0) {

        $filter_cat_id = isset($_REQUEST['filtro_cat_id']) ? $_REQUEST['filtro_cat_id'] : null;
        $filter_cat_nombre = isset($_REQUEST['filtro_cat_nombre']) ? $_REQUEST['filtro_cat_nombre'] : null;

        foreach ($array_datos as $promocion) {
            if (is_array($promocion) && isset($promocion['id'])) {
                if (
                    ($filter_cat_id === null || $promocion['id'] == $filter_cat_id) &&
                    ($filter_cat_nombre === null || stripos($promocion['inm_referencia'], $filter_cat_nombre) !== false)
                ) {
                    echo "<h2>Promocion con id= " . $promocion['id'] . ": " . $promocion['inm_referencia'] . "</h2>";
                }
            } else {
                echo "<p>Invalido promocion formato</p>";
            }
        }
    } else {
        echo "<p>No se encontraron promocion.</p>";
    }
    ?>
</body>

</html>