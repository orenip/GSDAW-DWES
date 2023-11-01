<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Películas Almacenadas</title>
    <meta charset="utf-8">
</head>

<body>
    <h1>Películas Almacenadas</h1>
    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Año</th>
                <th>Género</th>
                <th>Director</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_SESSION['peliculas'])) {
                foreach ($_SESSION['peliculas'] as $pelicula) {
                    echo "<tr>";
                    echo "<td>{$pelicula['titulo']}</td>";
                    echo "<td>{$pelicula['anio']}</td>";
                    echo "<td>{$pelicula['genero']}</td>";
                    echo "<td>{$pelicula['director']}</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
    <a href="index.php">Volver a la página principal</a>
    <a href="busqueda.php">Buscar películas</a>
</body>

</html>
