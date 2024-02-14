<?php
$parametros = array(
'art_cantidad' => 60
);



$params_json = json_encode($parametros);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost/DWes/Pianelo_Alonso_pablo_DWES06_Tarea/articulo.php?art_id=2");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


$headers = array(

'Content-Type: application/Json; charset=UTF-8'

);

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

curl_setopt($ch, CURLOPT_POSTFIELDS, $params_json);
$response = curl_exec($ch);
curl_close($ch);
echo $response;
?>