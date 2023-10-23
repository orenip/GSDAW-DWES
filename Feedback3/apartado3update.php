<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['prestamo_id'])) {
    $prestamoID = $_POST['prestamo_id'];

    try {
        $conexion = new mysqli('localhost', 'super', '123456', 'biblioteca');

        // Actualizar la fecha de devolución a la fecha actual
        $query = "UPDATE prestamos SET pre_devolucion = NOW() WHERE pre_id = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param('i', $prestamoID);
        
        if ($stmt->execute()) {
            echo "Préstamo devuelto con éxito.";
        } else {
            echo "Error al devolver el préstamo.";
        }

        $stmt->close();
        $conexion->close();
    } catch (Exception $e) {
        echo "Error al conectar: " . $e->getMessage();
    }
} else {
    echo "Acceso no válido a esta página.";
}
?>
