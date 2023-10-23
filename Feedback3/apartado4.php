<!DOCTYPE html>
<html>

<head>
    <title>Apartado 4</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <h1>Feedback 3 - Apartado 4</h1>
    <p>En lugar de la fecha de devolución, cuando el préstamo no haya sido devuelto aparecerá un botón que automáticamente realizará la devolución del préstamo, tomando como fecha de devolución la fecha actual.</p>

    <?php
    try {
        $conexion = new mysqli('localhost', 'super', '123456', 'biblioteca');
        echo "<p>Conexión establecida</p>";

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['prestamo_id'])) {
            // Actualizar la fecha de devolución a la fecha actual
            $prestamoID = $_POST['prestamo_id'];
            $query = "UPDATE prestamos SET pre_devolucion = NOW() WHERE pre_id = ?";
            $stmt = $conexion->prepare($query);
            $stmt->bind_param('i', $prestamoID);
            if ($stmt->execute()) {
                echo "Préstamo devuelto con éxito.";
            } else {
                echo "Error al devolver el préstamo.";
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_prestamo'])) {
            // Eliminar el préstamo
            $prestamoID = $_POST['eliminar_prestamo'];
            $query = "DELETE FROM prestamos WHERE pre_id = ?";
            $stmt = $conexion->prepare($query);
            $stmt->bind_param('i', $prestamoID);
            if ($stmt->execute()) {
                echo "Préstamo eliminado con éxito.";
            } else {
                echo "Error al eliminar el préstamo.";
            }
        }

        // Recuperamos los préstamos
        $result = $conexion->query('SELECT `prestamos`.`pre_id`, `socios`.`soc_nombre`, `ejemplares`.`eje_signatura`, `libros`.`lib_titulo`, `prestamos`.`pre_devolucion`, `prestamos`.`pre_fecha` FROM `libros` 
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
                    <th scope="col">Fecha Préstamo</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>

                <?php
                while ($prestamo = $result->fetch_array()) {
                    echo "<tr>";
                    echo "<th scope='row'>$prestamo[1]</th>";
                    echo "<td>$prestamo[2]</td>";
                    echo "<td>$prestamo[3]</td>";
                    echo "<td>";
                    if (empty($prestamo[4])) {
                        echo "<form method='POST' action='" . $_SERVER['PHP_SELF'] . "'>";
                        echo "<input type='hidden' name='prestamo_id' value='$prestamo[0]'>";
                        echo "<input type='submit' value='Devolver' class='btn btn-primary'>";
                        echo "</form>";
                    } else {
                        echo $prestamo[4];
                    }
                    echo "</td>";
                    echo "<td>$prestamo[5]</td>";
                    echo "<td>";
                    echo "<form method='POST' action='" . $_SERVER['PHP_SELF'] . "'>";
                    echo "<input type='hidden' name='eliminar_prestamo' value='$prestamo[0]'>";
                    echo "<input type='submit' value='Eliminar' class='btn btn-danger'>";
                    echo "</form>";
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
