<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<body>
    
    <?php
$parametros = array(
    'title' => urlencode('Titulo del post'),
    'body' => urlencode('Cuerpo'),
    'userId' => 1
);

$params_json = json_encode($parametros);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://jsonplaceholder.typicode.com/posts");
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

</body>
</html>

