<!DOCTYPE html>
<html>

<head>
    <title>Ejemplo Listar y Eliminar</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <h1>Ejemplo Listado con botón para Eliminar</h1>
    <p>Este ejemplo utiliza MySQLi para listar los registros de una tabla y para cada registro incorpora un botón que permite eliminar dicho registro.</p>
    <hr>
    <?php
    // Utilizamos excepciones para controlar los errores de conexión
    try {
        // Instanciamos un objeto de tipo MySQLi
        $conexion = new mysqli('localhost', 'super', '123456', 'baloncesto');

        // Se ha establecido la conexión
        echo "<p>Conexión establecida con la Base de Datos</p>";

        // Si el script ha recibido un código de jugador hay que eliminarlo
        if (isset($_POST['eliminar'])) {
            $codigo = $_POST['num_jugador'];
            echo "<p>He recibido para borrar el código del jugador: $codigo</p>";
            $sqlBorrar = "delete from jugadores where cod_jugador=$codigo";
            $regsBorrados = $conexion->query($sqlBorrar);
            // Si el método devuelve true es que se ha ejecutado bien la sentencia SQL
            if ($regsBorrados) {
                echo "<p>Se han borrado el jugador con código $codigo";
            }
        }

        // Recuperamos los equipos usando el método "query" que devuelve un objeto mysql_result
        // o "false" si la consulta es erronea
        $result = $conexion->query('select * from jugadores');
    ?>
        <!-- Creamos la tabla y la cabecera de la misma con Bootstrap -->
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Cod.</th>
                    <th scope="col">Nombre equipo</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody>

                <?php
                // Recuperamos el primer registro del resultado de la consulta
                $equipo = $result->fetch_array();

                // Bucle para recorrer todos los jugadores recuperados
                // Mientras en $equipo haya algo es que hay jugadores para mostrar
                while ($equipo != null) {
                    // Código HTML para mostrar en cada fila los datos del jugador
                    // usamos el array con claves numéricas
                    print "<tr><td scope='row'>$equipo[0]</td><td>$equipo[1]</td>\n";

                    // Form HTML con dos campos ocultos y un botón
                    echo '<td><form action="" method="post">';
                    echo '<input type="text" hidden="hidden" name="num_jugador" value="' . $equipo[0] . '"/>';
                    echo '<input type="text" hidden="hidden" name="eliminar" value="eliminar"/>';
                    echo '<input type="submit" value="Eliminar" />';
                    echo '</form></td></tr>';
                    echo "\n";

                    // Avanzamos al siguiente jugador
                    $equipo = $result->fetch_array();
                }
                ?>
            </tbody>
        </table>

    <?php

    } catch (Exception $e) {
        // Si se produce una excepción mostramos el mensaje de error
        echo "<p>Se ha producido un error: ", $e->getMessage(), "</p>";
    } finally {
        // Para finalizar liberamos recursos
        $result->close();
        $conexion->close();
    }

    ?>
</body>

</html>