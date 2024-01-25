<?php
$parametros = array();

$params_json = json_encode($parametros);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://jsonplaceholder.typicode.com/posts/1");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_POSTFIELDS, $params_json);
$response = curl_exec($ch);
curl_close($ch);
echo $response;
?>

