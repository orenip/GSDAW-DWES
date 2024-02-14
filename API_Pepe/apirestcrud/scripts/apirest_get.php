<?php
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "http://localhost/DWES/dwes06-API_REST/apirestcrud/articulo.php");
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($curl);
curl_close($curl);

$array_datos = json_decode($data);
print_r($array_datos);
?>
