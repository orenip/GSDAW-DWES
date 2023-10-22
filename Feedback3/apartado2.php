<!DOCTYPE html>
<html>

<head>
    <title>Apartado 2</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <h1>Feedback 3 - Apartado 2</h1>
    <p>Debe dar la oportunidad de filtrar los resultados por socio y libro (¡ojo, no por ejemplar!).</p>

    <?php
    if (isset($_POST['Socio'])) {

        try {
            $conexion = new mysqli('localhost', 'super', '123456', 'biblioteca');
            echo "<p>Conexión establecida</p>";

            // Recuperamos los equipos
            $consulta = $conexion->stmt_init();
            $consulta->prepare('SELECT `socios`.`soc_nombre`, `libros`.`lib_titulo` 
            FROM `libros` 
                INNER JOIN `ejemplares` ON `ejemplares`.`eje_libro` = `libros`.`lib_isbn` 
                INNER JOIN `prestamos` ON `prestamos`.`pre_ejemplar` = `ejemplares`.`eje_signatura` 
                INNER JOIN `socios` ON `prestamos`.`pre_socio` = `socios`.`soc_id`
                WHERE  `socios`.`soc_nombre` = ?');

            $codigo = $_POST['Socio'];
            $consulta->bind_param('i', $codigo);
            $consulta->execute();
            $consulta->bind_result($soc_nombre, $lib_titulo);
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
                        print "<tr><th scope='row'>$soc_nombre</th>\n<td>$lib_titulo</td></tr>\n";
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
        <h1>Buscar jugador por Socio</h1>
        <form name="formCodJugador" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="socio">Filtrar por Socio:</label>
            <input type="text" placeholder="Socio" name="Socio">
            <input type="submit" name="Enviar" value="Enviar">
        </form>
    <?php
    }
    ?>

</body>

</html>