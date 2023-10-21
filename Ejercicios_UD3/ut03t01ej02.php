<!DOCTYPE html>
<html>

<head>
    <title>UT03 Ejercicio tutoría 02</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <h1>Tutoría 1. Ejercicio 2</h1>
    <p>Crear un formulario que pida en una caja de texto el código de un jugador y mostrar el nombre del jugador pedido.</p>
    <?php
    if (isset($_POST['num_jugador'])) {
        // Se ha enviado un número de jugador
        // Nos conectamos a la base de datos

        try {
            $conexion = new mysqli('localhost', 'super', '123456', 'baloncesto');
            echo "<p>Conexión establecida</p>";

            // Recuperamos los equipos
            $consulta = $conexion->stmt_init();
            $consulta->prepare('select nombre_jugador, fecha_nacimiento from jugadores where cod_jugador = ?');
            $codigo = $_POST['num_jugador'];
            $consulta->bind_param('i', $codigo);
            $consulta->execute();
            $consulta->bind_result($nombre, $fecha_nac);
    ?>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">F.Nacimiento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($consulta->fetch()) {
                        print "<tr><th scope='row'>$nombre</th>\n<td>$fecha_nac</td></tr>\n";
                    }
                    ?>
                </tbody>
            </table>
        <?php
        } catch (Exception $e) {
            echo "<p>Error al conectar: ", $e->getMessage(), "</p>";
        } finally {
            $consulta->close();
            $conexion->close();
        }
    } else {
        // No se ha enviado formulario (primera ejecución)
        ?>
        <h1>Buscar jugador por código</h1>
        <form name="formCodJugador" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="text" placeholder="Código" name="num_jugador">
            <input type="submit" name="Enviar" value="Enviar">
        </form>
    <?php
    }
    ?>

</body>

</html>