<!DOCTYPE html>
<html>

<head>
    <title>UT03 Ejercicio tutoría 01</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <h1>Tutoría 1. Ejercicio 1</h1>
    <p>Mostrar en una tabla HTML el contenido de la tabla EQUIPOS.</p>

    <?php
    try {
        $conexion = new mysqli('localhost', 'super', '123456', 'baloncesto');
        echo "<p>Conexión establecida</p>";

        // Recuperamos los equipos
        $result = $conexion->query('select * from equipos');
    ?>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Cod.</th>
                    <th scope="col">Nombre equipo</th>
                </tr>
            </thead>
            <tbody>


                <?php
                $equipo = $result->fetch_array();
                while ($equipo != null) {
                    print "<tr><th scope='row'>$equipo[0]</th>\n<td>$equipo[1]</td></tr>\n";
                    $equipo = $result->fetch_array();
                }
                ?>
            </tbody>
        </table>
    <?php
    } catch (Exception $e) {
        echo "<p>Error al conectar: ", $e->getMessage(), "</p>";
    } finally {
        $result->close();
        $conexion->close();
    }

    ?>
</body>

</html>