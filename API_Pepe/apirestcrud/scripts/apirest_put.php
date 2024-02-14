<?php
$parametros = array(
    'art_nombre' => 'Sony PlayStation 5',
    'art_categoria' => 5,
    'art_cantidad' => 27
);

$params_json = json_encode($parametros);

$url_params = array(
    'art_id' => 8
);

$ch = curl_init();
$url = "http://localhost/DWES/dwes06-API_REST/apirestcrud/articulo.php";
$url .= '?' . http_build_query($url_params);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
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
echo $response;
?>


