<!DOCTYPE html>
<html>

<head>
    <title>Crear Préstamo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body>
    <h1>Crear Préstamo</h1>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verificar si se enviaron los datos necesarios
        if (isset($_POST['socio']) && isset($_POST['ejemplar'])) {
            // Conectar a la base de datos (ajusta esto según tus credenciales)
            $conexion = new mysqli('localhost', 'super', '123456', 'biblioteca');

            // Verificar la conexión
            if ($conexion->connect_error) {
                die("Error en la conexión a la base de datos: " . $conexion->connect_error);
            }

            // Obtener el ID del socio y el ID del ejemplar del formulario
            $socio = $_POST['socio'];
            $ejemplar = $_POST['ejemplar'];

            // Obtener la fecha actual en el formato de MySQL
            $fechaActual = date('Y-m-d H:i:s');

            // Preparar la consulta para insertar un nuevo préstamo
            $consulta = $conexion->prepare('INSERT INTO prestamos (pre_fecha, pre_socio, pre_ejemplar) VALUES (?, ?, ?)');
            $consulta->bind_param('sss', $fechaActual, $socio, $ejemplar);

            // Ejecutar la consulta
            if ($consulta->execute()) {
                echo "Préstamo registrado con éxito.";
            } else {
                echo "Error al registrar el préstamo: " . $conexion->error;
            }

            // Cerrar la consulta y la conexión
            $consulta->close();
            $conexion->close();
        } else {
            echo "Faltan datos del formulario.";
        }
    }
    ?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <label for="socio">Selecciona un Socio:</label>
            <select class="form-control" id="socio" name="socio">
                <?php
                // Conecta a la base de datos y recupera los socios
                $conexion = new mysqli('localhost', 'super', '123456', 'biblioteca');
                $result = $conexion->query('SELECT soc_id, soc_nombre FROM socios');

                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['soc_id']}'>{$row['soc_nombre']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="ejemplar">Selecciona un Ejemplar (Libro):</label>
            <select class="form-control" id="ejemplar" name="ejemplar">
                <?php
                // Recupera los ejemplares disponibles con sus títulos de libros correspondientes
                $result = $conexion->query('SELECT e.eje_signatura, l.lib_titulo FROM ejemplares e 
                                            INNER JOIN libros l ON e.eje_libro = l.lib_isbn 
                                            WHERE e.eje_signatura NOT IN (SELECT pre_ejemplar FROM prestamos WHERE pre_devolucion IS NULL)');

                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['eje_signatura']}'>{$row['lib_titulo']} ({$row['eje_signatura']})</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Registrar Préstamo</button>
    </form>

    <?php
    $conexion->close();
    ?>
</body>

</html>
