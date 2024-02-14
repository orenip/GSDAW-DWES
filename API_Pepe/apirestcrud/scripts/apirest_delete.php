<?php
$parametros = array(
  'art_id' => 1
);

$params_json = json_encode($parametros);

$ch = curl_init();
$url = "http://localhost/DWES/dwes06-API_REST/apirestcrud/articulo.php";
$url .= '?' . http_build_query($parametros);

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_POSTFIELDS, $parametros);
$response = curl_exec($ch);
curl_close($ch);
echo $response;
?>
