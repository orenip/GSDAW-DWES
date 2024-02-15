<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo de uso de API REST con autentificación desde PHP</title>
</head>

<body>
    <?php
    // En primer lugar iniciamos sesión
    session_start();

    // Si se han enviado datos desde el formulario se recogen y se genera el JSON
    if (isset($_REQUEST['auth'])) {
        // Autentificación
        $parametros = array(
            'username' => urlencode($_REQUEST['username']),
            'password' => urlencode($_REQUEST['password'])
        );

        $params_json = json_encode($parametros);

        // Se hace la llamada POST a la API
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://profesoro.000webhostapp.com/apirestauth/auth.php");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            'Content-Type' => 'application/json; charset=UTF-8'
        );

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params_json);

        $response = curl_exec($ch);
        curl_close($ch);

        if ($response === false) {
            echo "<h2>Problema en la petición a la API.</h2>";
        } else {
            // OJO! Se pasa true como segundo parámetro para que el array sea asociativo
            $array_resultado = json_decode($response, true);

            if ($array_resultado['result'] == 'error') {
                echo "<h2>" . $array_resultado['details'] . ".</h2>";
            } else {
                // Guardamos el token
                $_SESSION['token'] = $array_resultado['token'];
            }
        }
    }

    // Si se ha pulsado el botón de cerrar sesión eliminamos el token
    if (isset($_REQUEST['logout'])) {
        unset($_SESSION['token']);
    }

    // Si se ha pulsado el botón de obtener los jugadores
    if (isset($_REQUEST['listar'])) {
        // Se hace la llamada POST a la API
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://profesoro.000webhostapp.com/apirestauth/player.php");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Pasamos el token en las cabeceras, con la etiqueta 'api-key'
        $headers = array(
            'Content-Type: application/json;charset=UTF-8',
            'api-key: ' . $_SESSION['token']
        );

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);

        if ($response === false) {
            echo "<h2>Problema en la petición a la API.</h2>";
        } else {
            // OJO! Se pasa true como segundo parámetro para que el array sea asociativo
            $array_resultado = json_decode($response, true);

            if ($array_resultado['result'] == 'error') {
                echo "<h2>" . $array_resultado['details'] . ".</h2>";
            } else {
                // Mostramos los jugadores
                print_r($array_resultado);
            }
        }
    }

    // Si se ha pulsado el botón de insertar jugador
    if (isset($_REQUEST['insert'])) {

        // Recogemos los datos del jugador
        $parametros = array(
            'player_name' => urlencode($_REQUEST['nombre']),
            'player_mins' => urlencode($_REQUEST['minutos']),
            'player_pts' => urlencode($_REQUEST['puntos']),
            'player_asist' => urlencode($_REQUEST['asistencias']),
            'player_reb' => urlencode($_REQUEST['rebotes']),
            'player_tap' => urlencode($_REQUEST['tapones'])
        );

        $params_json = json_encode($parametros);

        // Se hace la llamada POST a la API
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://profesoro.000webhostapp.com/apirestauth/player.php");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
        // Mandamos el token en las cabeceras
        $headers = array(
            'Content-Type: application/json; charset=UTF-8',
            'api-key:' . $_SESSION['token']
        );

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params_json);

        $response = curl_exec($ch);
        curl_close($ch);

        if ($response === false) {
            echo "<h2>Problema en la petición a la API.</h2>";
        } else {
            // OJO! Se pasa true como segundo parámetro para que el array sea asociativo
            $array_resultado = json_decode($response, true);

            if ($array_resultado['result'] == 'error') {
                echo "<h2>" . $array_resultado['details'] . ".</h2>";
            } else {
                // Informamos del resultado
                print_r($array_resultado);
            }
        }

    }

    // Si no hay token en la sesión hay que pedir la autentificación
    if (!isset($_SESSION['token'])) {
        ?>
        <!-- Formularios para recoger los datos -->
        <h1>Identificarse</h1>
        <form id="form_auth" action="" method="post">
            <label for="username">Usuario: </label>
            <input type="text" name="username">
            </br>
            <label for="password">Password: </label>
            <input type="password" name="password">
            </br>
            <input type="submit" name="auth" value="Identificarse">
        </form>

        <?php
    } else {
        ?>

        <h1>Trabajar con la API</h1>
        <form id="form_logout" action="" method="post">
            <input type="submit" name="logout" value="Cerrar sesión">
        </form>
        <br>
        <form id="form_listado" action="" method="post">
            <input type="submit" name="listar" value="Recuperar jugadores">
        </form>
        <br>
        <form id="form_insert" action="" method="post">
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre">
            </br>
            <label for="minutos">Minutos: </label>
            <input type="number" name="minutos" min="0">
            </br>
            <label for="puntos">Puntos: </label>
            <input type="number" name="puntos" min="0">
            </br>
            <label for="asistencias">Asistencias: </label>
            <input type="number" name="asistencias" min="0">
            </br>
            <label for="rebotes">Rebotes: </label>
            <input type="number" name="rebotes" min="0">
            </br>
            <label for="tapones">Tapones: </label>
            <input type="number" name="tapones" min="0">
            </br>
            <input type="submit" name="insert" value="Insertar jugador">
        </form>
        <?php
    }
    ?>
</body>

</html>