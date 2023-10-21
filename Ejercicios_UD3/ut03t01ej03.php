<!DOCTYPE html>
<html>

<head>
    <title>UT03 - Tutoría 1 - Ejercicio 03</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <h1>Tutoría 1. Ejercicio 3</h1>
    <p>Diseñar un formulario que pida en una caja de texto el código de un equipo y mostrar el número de jugadores que tiene y sus nombres.</p>
   
    <?php
    if (isset($_POST['cod_equipo'])) {
        // Se ha enviado un codigo de equipo
        // Nos conectamos a la base de datos

        try {
            $conexion = new mysqli('localhost', 'super', '123456', 'baloncesto');
            echo "<p>Conexión establecida</p>";

            // Recuperamos los jugadores de un equipo mediante una consulta preparada
            $consulta = $conexion->stmt_init();
            $consulta->prepare('select j.NOMBRE_JUGADOR from equipos e, jugadores j where e.COD_EQUIPO = j.EQUIPO and e.COD_EQUIPO = ?');
            $codigo = $_POST['cod_equipo'];
            $consulta->bind_param('i', $codigo);
            $consulta->execute();

            // Necesitamos almacenar los resultados para saber el número de registros devueltos
            // Si no se usa "store_result()" no funciona bien la propiedad "num_rows"
            $consulta->store_result();
            $numero_jugadores = $consulta->num_rows;

            // Enlazamos los resultados con las variables que almacenarán los campos de cada registro
            // Con cada llamada a fetch() vamos recuperando el siguiente registro y poniéndolo en las variables
            $consulta->bind_result($nombre_jugador);
            
            // Obtenemos y mostramos la cantidad de jugadores del equipo
            print "<p>Número de jugadores del equipo: " . $numero_jugadores . "</p>"; 
        ?>

            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nombre Jugador</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($consulta->fetch()) {
                        print "<tr><td scope='row'>$nombre_jugador</td></tr>\n";
                    }
                    ?>
                </tbody>
            </table>
        <?php
        } catch (Exception $e) {
            echo "<p>Error al conectar: ", $e->getMessage(), "</p>";
        } finally {
            // Siempre liberamos la memoria de los resultados, cerramos la consulta y la conexión a la BD
            $consulta->free_result();
            $consulta->close();
            $conexion->close();
        }
    } else {
        // No se ha enviado formulario (primera ejecución)
        ?>
        <h1>Datos de un equipo</h1>
        <form name="formCodEquipo" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="text" placeholder="Código equipo" name="cod_equipo">
            <input type="submit" name="Enviar" value="Enviar">
        </form>
    <?php
    }
    ?>

</body>

</html>