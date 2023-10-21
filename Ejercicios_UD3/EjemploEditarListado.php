<!DOCTYPE html>
<html>

<head>
    <title>Ejemplo listado con botón para editar en otro script</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <h1>Ejemplo Listado con botón para Editar</h1>
    <p>Este ejemplo utiliza MySQLi para listar los registros de una tabla y para cada registro incorpora un botón que permite editar dicho registro en otro script PHP</p>
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

        // Si el script recibe la opción de editar un jugador
        if (isset($_POST['editar'])) {
            // Pasamos a variables los nuevos datos del jugador
            $codigo = $_POST['num_jugador'];
            $new_nombre = $_POST['nom_jugador'];
            $new_fec_nac = $_POST['fec_nac'];
            $new_estatura = $_POST['estatura'];
            $new_posicion = $_POST['posicion'];
            $new_equipo = $_POST['cod_equipo'];

            echo "<p>He recibido para editar el jugador: $codigo - $new_nombre - $new_fec_nac - $new_estatura - $new_posicion - $new_equipo</p>";

            // Actualizamos los datos del jugador
            $sqlUpdate = "update jugadores set nombre_jugador = '$new_nombre', fecha_nacimiento = '$new_fec_nac', estatura = $new_estatura, posicion = '$new_posicion', equipo = $new_equipo where cod_jugador=$codigo";
            $regsActualizados = $conexion->query($sqlUpdate);
            // Si el método devuelve true es que se ha ejecutado bien la sentencia SQL
            if ($regsActualizados) {
                echo "<p>Se han actualizado el jugador con código $codigo";
            } else {
                echo "<p>No se ha actualizado el jugador con código $codigo";
            }
        }


        // Si el script recibe la opción de nuevo un jugador
        if (isset($_POST['nuevo'])) {
            // Pasamos a variables los nuevos datos del jugador
            $codigo = $_POST['num_jugador'];
            $new_nombre = $_POST['nom_jugador'];
            $new_fec_nac = $_POST['fec_nac'];
            $new_estatura = $_POST['estatura'];
            $new_posicion = $_POST['posicion'];
            $new_equipo = $_POST['cod_equipo'];

            echo "<p>He recibido para añadir el jugador: $codigo - $new_nombre - $new_fec_nac - $new_estatura - $new_posicion - $new_equipo</p>";

            // Actualizamos los datos del jugador
            $sqlAdd = "insert into jugadores values ($codigo,'$new_nombre','$new_fec_nac',$new_estatura,'$new_posicion',$new_equipo)";
            $regsInsertados = $conexion->query($sqlAdd);
            // Si el método devuelve true es que se ha ejecutado bien la sentencia SQL
            if ($regsInsertados) {
                echo "<p>Se ha añadido el jugador con código $codigo";
            } else {
                echo "<p>No se ha añadido el jugador con código $codigo";
            }
        }



        // Si el script recibe la opción de cancelar la edición de un jugador
        if (isset($_POST['cancelar'])) {
            echo "<p>Se ha cancelado la modificación o inserción del jugador.</p>";
        }


        // Recuperamos los equipos usando el método "query" que devuelve un objeto mysql_result
        // o "false" si la consulta es erronea
        $result = $conexion->query('select * from jugadores');
    ?>
        <!-- Botón para crear un nuevo jugador -->
        <form action="EjemploEditarNuevo.php" method="post">
            <input type="submit" value="Nuevo Jugador" />
        </form>

        <!-- Creamos la tabla y la cabecera de la misma con Bootstrap -->
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Cod.</th>
                    <th scope="col">Nombre equipo</th>
                    <th scope="col">Acción 1</th>
                    <th scope="col">Acción 2</th>
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

                    // Form HTML con los campos del jugador ocultos y botón para editar en otro script
                    echo '<td><form action="EjemploEditarModificar.php" method="post">';
                    echo '<input type="text" hidden="hidden" name="num_jugador" value="' . $equipo[0] . '"/>';
                    echo '<input type="text" hidden="hidden" name="nom_jugador" value="' . $equipo[1] . '"/>';
                    echo '<input type="text" hidden="hidden" name="fec_nac" value="' . $equipo[2] . '"/>';
                    echo '<input type="text" hidden="hidden" name="estatura" value="' . $equipo[3] . '"/>';
                    echo '<input type="text" hidden="hidden" name="posicion" value="' . $equipo[4] . '"/>';
                    echo '<input type="text" hidden="hidden" name="cod_equipo" value="' . $equipo[5] . '"/>';
                    echo '<input type="text" hidden="hidden" name="editar" value="editar"/>';
                    echo '<input type="submit" value="Editar" />';
                    echo '</form></td>';
                    echo "\n";

                    // Form HTML con dos campos ocultos y un botón para eliminar
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