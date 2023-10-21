<?php
// Si recibe usuario y clave la comprueba y si es correcta redirige a la pantalla principal
if (isset($_POST['usuario'])) {
    // Nos conectamos a la base de datos para comprobar el usuario
    try {
        // Traemos la declaración de la conexión
        require_once('conexionbd.php');

        // Creamos la consulta preparada para comprobar las credenciales
        $consulta = $conexion->stmt_init();
        $consulta->prepare('select usuario from usuarios where usuario = ? and contrasena = ?');

        // Establecemos las variables que usaremos para la consulta preparada
        $usuario = $_POST['usuario'];
        $pwd_enc = md5($_POST['pwd']);

        // Sustituimos los parámetros de la consulta preparada
        $consulta->bind_param('ss', $usuario, $pwd_enc);
        $consulta->execute();

        if ($consulta->fetch()) {
            session_start();
            $_SESSION['usuario_app'] = $usuario;
            header('Location: principal.php');
        } else {
            $error_login = true;
        }
    } catch (Exception $e) {
        echo "<p>Error al conectar: ", $e->getMessage(), "</p>";
    } finally {
        $consulta->close();
        $conexion->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>BiblioAppWeb Login</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="container">
        <h2>Inicio de sesión</h2>
        <?php
        if (isset($error_login)) {
            echo "<p>Error al autentificarse</p>";
        }
        ?>
        <form action="index.php" method="post">
            <div class="form-group">
                <label for="usuario">Usuario:</label>
                <input type="text" class="form-control" id="usuario" placeholder="Introduce el usuario" name="usuario">
            </div>
            <div class="form-group">
                <label for="pwd">Contraseña:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Introduce contraseña" name="pwd">
            </div>
            <button type="submit" class="btn btn-default" value="acceder">Acceder</button>
        </form>
    </div>
</body>

</html>