<!DOCTYPE html>
<html>

<head>
    <title>Apartado 1</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <h1>Feedback 3 - Apartado 1</h1>
    <p> La página principal mostrará una tabla HTML con los préstamos realizados. 
        Los datos que se mostrarán serán el nombre del socio, la signatura del ejemplar, el título del libro y las fechas de devolución y préstamo. 
        En la parte superior deben aparecer los últimos preśtamos realizados.</p>

    <?php
    try {
        $conexion = new mysqli('localhost', 'super', '123456', 'biblioteca');
        echo "<p>Conexión establecida</p>";

        // Recuperamos los equipos
        $result = $conexion->query('SELECT `socios`.`soc_nombre`, `ejemplares`.`eje_signatura`, `libros`.`lib_titulo` , `prestamos`.`pre_devolucion`, `prestamos`.`pre_fecha`
        FROM `libros` 
            INNER JOIN `ejemplares` ON `ejemplares`.`eje_libro` = `libros`.`lib_isbn` 
            INNER JOIN `prestamos` ON `prestamos`.`pre_ejemplar` = `ejemplares`.`eje_signatura` 
            INNER JOIN `socios` ON `prestamos`.`pre_socio` = `socios`.`soc_id`
            ORDER BY `prestamos`.`pre_fecha` DESC ');
    ?>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nombre socio</th>
                    <th scope="col">Signatura</th>
                    <th scope="col">Título</th>
                    <th scope="col">Fecha Devolución</th>
                    <th scope="col">Fecha Prestamo</th>
                </tr>
            </thead>
            <tbody>


                <?php
                $prestamos = $result->fetch_array();
                while ($prestamos != null) {
                    print "<tr><th scope='row'>$prestamos[0]</th><td>$prestamos[1]</td><td>$prestamos[2]</td><td>$prestamos[3]</td><td>$prestamos[4]</td></tr>\n";
                    $prestamos = $result->fetch_array();
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