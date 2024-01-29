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
        // Assuming you want to delete the category with the provided 'cat_id'
        $cat_id = $_REQUEST['cat_id'];

        // You can choose to include other parameters in the query string if needed
        $query_string = http_build_query(array('cat_id' => $cat_id));

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://localhost/GSDAW-DWES/Feedback6/categoria.php?" . $query_string);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Content-Type: application/json"
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);

        // echo $response; // Uncomment to see the response from the API
        $array_resultado = json_decode($response, true);
        echo "<h2>Eliminada la categoría con id= " . $cat_id . "</h2>";

    } else {
    ?>
        <form action="" method="post">
            <label for="cat_id">Id categoria</label>
            <input type="text" name="cat_id">
            <br>
            <input type="submit" name="enviar" value="Eliminar">
        </form>
    <?php
    }
    ?>

</body>

</html>
