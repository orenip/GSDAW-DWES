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
    $filtroSocio = isset($_POST['filtroSocio']) ? $_POST['filtroSocio'] : '';
    $filtroLibro = isset($_POST['filtroLibro']) ? $_POST['filtroLibro'] : '';

    try {
        $conexion = new mysqli('localhost', 'super', '123456', 'biblioteca');
        echo "<p>Conexión establecida</p>";

        
        // Modificación de la consulta para añadir los filtros
        $query = "SELECT `socios`.`soc_nombre`, `ejemplares`.`eje_signatura`, `libros`.`lib_titulo`, `prestamos`.`pre_devolucion`, `prestamos`.`pre_fecha`
            FROM `libros`
            INNER JOIN `ejemplares` ON `ejemplares`.`eje_libro` = `libros`.`lib_isbn`
            INNER JOIN `prestamos` ON `prestamos`.`pre_ejemplar` = `ejemplares`.`eje_signatura`
            INNER JOIN `socios` ON `prestamos`.`pre_socio` = `socios`.`soc_id`
            WHERE (`socios`.`soc_nombre` LIKE '%$filtroSocio%' OR '$filtroSocio' = '') 
                AND (`libros`.`lib_titulo` LIKE '%$filtroLibro%' OR '$filtroLibro' = '')
            ORDER BY `prestamos`.`pre_fecha` DESC";
        
        $result = $conexion->query($query);
        

    ?>

        <!--Formulario para enviar los filtros-->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="filtroSocio">Filtrar por Socio:</label>
                <input type="text" class="form-control" id="filtroSocio" name="filtroSocio" value="<?php echo $filtroSocio; ?>">
            </div>
            <div class="form-group">
                <label for="filtroLibro">Filtrar por Libro:</label>
                <input type="text" class="form-control" id="filtroLibro" name="filtroLibro" value="<?php echo $filtroLibro; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nombre socio</th>
                    <th scope="col">Signatura</th>
                    <th scope="col">Título</th>
                    <th scope="col">Fecha Devolución</th>
                    <th scope="col">Fecha Préstamo</th>
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