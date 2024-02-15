<?php
    



function insertar($param)
{
    $apikey="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2Nzg0NzY5NjYsImRhdGEiOnsiaWQiOiIxMDAiLCJub21icmUiOiJVc3VhcmlvIGRlIFBydWViYSJ9fQ.JRIwruSLeRdKqmHHqmp9CkvEKuqTOwl0t7aVPhCMbzE";

    $params_json = json_encode($param);
    $url="http://localhost/examen/ejercicio2/aptos.php";    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch,CURLOPT_HTTPHEADER,array('api-key:'.$apikey));
    $headers = array(
        'Content-Type: application/json; charset=UTF-8'
    );
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $params_json);
    $response = curl_exec($ch);
    curl_close($ch);
    echo $response;

}


//creamos un articulo
$parametros = array(
    'emp_id' => '1',
  
);

insertar($parametros);


?>


