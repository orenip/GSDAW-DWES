<?php
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "http://localhost/GSDAW-DWES/Feedback6/categoria.php");
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($curl);

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
    <title>Ejercicio 1</title>
</head>

<body>

    <form action="" method="get">
        <label for="filtro_cat_id">Filtrar por ID:</label>
        <input type="text" name="filtro_cat_id">
        <br>
        <label for="filtro_cat_nombre">Filtrar por Nombre:</label>
        <input type="text" name="filtro_cat_nombre">
        <br>
        <input type="submit" name="filtrar" value="Filtrar">
    </form>
    <?php

if (is_array($array_datos) && count($array_datos) > 0) {
    $filter_cat_id = isset($_REQUEST['filtro_cat_id']) ? $_REQUEST['filtro_cat_id'] : null;
    $filter_cat_nombre = isset($_REQUEST['filtro_cat_nombre']) ? $_REQUEST['filtro_cat_nombre'] : null;

    foreach ($array_datos as $categoria) {
        if (is_array($categoria) && isset($categoria['cat_id']) && isset($categoria['cat_nombre'])) {
            // Check if the current category matches the filter criteria
            if (
                ($filter_cat_id === null || $categoria['cat_id'] == $filter_cat_id) &&
                ($filter_cat_nombre === null || stripos($categoria['cat_nombre'], $filter_cat_nombre) !== false)
            ) {
                echo "<h2>Categoría con id= " . $categoria['cat_id'] . ": " . $categoria['cat_nombre'] . "</h2>";
                // Display other category details as needed
            }
        } else {
            echo "<p>Invalid category format</p>";
            var_dump($categoria); // Output the content for debugging purposes
        }
    }
} else {
    echo "<p>No se encontraron categorías.</p>";
}
?>




</body>

</html>
