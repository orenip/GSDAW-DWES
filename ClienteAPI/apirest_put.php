<?php
$parametros = array(
    'id' => 1,
    'title' => urlencode('Titulo del post'),
    'body' => urlencode('Cuerpo'),
    'userId' => 1
);

$params_json = json_encode($parametros);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://jsonplaceholder.typicode.com/posts/1");
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


