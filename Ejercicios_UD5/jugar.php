<?php
// Importamos las clases necesarias
require_once('JuegoParesNones.php');

// Recuperamos la sesión y comprobamos si existe algún juego
session_start();
if (!isset($_SESSION['juego'])) {
    $sin_juego = true;
} else {
    $juego = $_SESSION['juego'];
    $sin_juego = false;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Tutoría 01 - UT05</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="container">
        <h2>Guardar objetos en la sesión - Pares o nones</h2>

        <?php
        // Comprobamos si hay un juego activo
        if ($sin_juego) {
            echo "<p>No hay juego activo</p>";
            echo "<p><a href='index.php'>Iniciar juego</a></p>";
        } else {
            // Tenemos un juego activo
            // Recogemos los parámetros del jugador
            if (isset($_POST['numero'])) {
                $jugador_num = $_POST['numero'];
                $jugador_opcion = $_POST['opcion'];

                // Llamamos al método del juego
                if ($juego->jugar($jugador_num, $jugador_opcion)) {
                    echo "<p>Enhorabuena, has ganado!";
                } else {
                    echo "<p>Lo siento, has perdido!";
                }
                echo "<p><a href='index.php'>Volver a jugar</a></p>";
            } else {
                echo "<p>No se han recibido parámetros para jugar</p>";
                echo "<p><a href='index.php'>Iniciar juego</a></p>";
            }
        }

        ?>
    </div>
</body>

</html>