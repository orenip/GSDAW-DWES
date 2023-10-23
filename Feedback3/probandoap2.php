<!DOCTYPE html>
<html>

<head>
    <title>Página Principal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <h1>Página Principal</h1>
    <p>En lugar de la fecha de devolución, cuando el préstamo no haya sido devuelto, aparecerá un botón que automáticamente realizará la devolución
        del préstamo, tomando como fecha de devolución la fecha actual.</p>

    <?php
    $filtroSocio = isset($_POST['filtroSocio']) ? $_POST['filtroSocio'] : '';
    $filtroLibro = isset($_POST['filtroLibro']) ? $_POST['filtroLibro'] : '';

    try {
        $conexion = new mysqli('localhost', 'super', '123456', 'biblioteca');
        echo "<p>Conexión establecida</p>";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Realizar la búsqueda con los filtros
            $query = "SELECT `socios`.`soc_nombre`, `ejemplares`.`eje_signatura`, `libros`.`lib_titulo`, `prestamos`.`pre_devolucion`, `prestamos`.`pre_fecha`
            FROM `libros`
            INNER JOIN `ejemplares` ON `ejemplares`.`eje_libro` = `libros`.`lib_isbn`
            INNER JOIN `prestamos` ON `prestamos`.`pre_ejemplar` = `ejemplares`.`eje_signatura`
            INNER JOIN `socios` ON `prestamos`.`pre_socio` = `socios`.`soc_id`
            WHERE (`socios`.`soc_nombre` LIKE '%$filtroSocio%' OR '$filtroSocio' = '') 
                AND (`libros`.`lib_titulo` LIKE '%$filtroLibro%' OR '$filtroLibro' = '')
            ORDER BY `prestamos`.`pre_fecha` DESC";
        } else {
            // Recuperar todos los préstamos
            $query = 'SELECT `socios`.`soc_nombre`, `ejemplares`.`eje_signatura`, `libros`.`lib_titulo`, `prestamos`.`pre_devolucion`, `prestamos`.`pre_fecha`
            FROM `libros`
            INNER JOIN `ejemplares` ON `ejemplares`.`eje_libro` = `libros`.`lib_isbn`
            INNER JOIN `prestamos` ON `prestamos`.`pre_ejemplar` = `ejemplares`.`eje_signatura`
            INNER JOIN `socios` ON `prestamos`.`pre_socio` = `socios`.`soc_id`
            ORDER BY `prestamos`.`pre_fecha` DESC';
        }

        $result = $conexion->query($query);
    ?>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="filtroSocio">Filtrar por Socio:</label>
                <input type="text" class="form-control" id="filtroSocio" name="filtroSocio" value="<?php echo $filtroSocio; ?>">
            </div>
            <div class="form-group">
                <label for "filtroLibro">Filtrar por Libro:</label>
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
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>

                <?php
                while ($prestamo = $result->fetch_array()) {
                    echo "<tr>";
                    echo "<th scope='row'>$prestamo[0]</th>";
                    echo "<td>$prestamo[1]</td>";
                    echo "<td>$prestamo[2]</td>";
                    echo "<td>";
                    if (empty($prestamo[3])) {
                        echo "<form method='POST' action='" . $_SERVER['PHP_SELF'] . "'>";
                        echo "<input type='hidden' name='prestamo_id' value='$prestamo[1]'>";
                        echo "<input type='submit' value='Devolver' class='btn btn-primary'>";
                        echo "</form>";
                    } else {
                        echo $prestamo[3];
                    }
                    echo "</td>";
                    echo "<td>$prestamo[4]</td>";
                    echo "<td>";
                    if (empty($prestamo[3])) {
                        echo "<form method='POST' action='" . $_SERVER['PHP_SELF'] . "'>";
                        echo "<input type='hidden' name='prestamo_id' value='$prestamo[1]'>";
                        echo "<input type='submit' value='Actualizar Fecha' class='btn btn-success'>";
                        echo "</form>";
                    }
                    echo "</td>";
                    echo "</tr>";
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