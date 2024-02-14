<?php
$parametros = array(
    'art_nombre' => 'Nintendo Swich',
    'art_categoria' => 5,
    'art_cantidad' => 10
);

$params_json = json_encode($parametros);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost/DWES/dwes06-API_REST/apirestcrud/articulo.php");
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
echo $response;
?>


