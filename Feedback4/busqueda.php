<?php
session_start();

if (isset($_POST['Filtrar'])) {
    $generoSeleccionado = $_POST['genero_filtro'];

    // Verifica si $_SESSION['peliculas'] está definido antes de filtrar
    if (isset($_SESSION['peliculas'])) {
        $peliculasFiltradas = array_filter($_SESSION['peliculas'], function ($pelicula) use ($generoSeleccionado) {
            return $pelicula['genero'] === $generoSeleccionado;
        });
        $_SESSION['peliculas_filtradas'] = array_values($peliculasFiltradas);
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Búsqueda de Películas</title>
    <meta charset="utf-8">
</head>

<body>
    <h1>Búsqueda de Películas por Género</h1>
    <form name="formBusqueda" action="busqueda.php" method="post">
        Filtrar por Género:
        <select name="genero_filtro">
            <option value="Comedia">Comedia</option>
            <option value="Drama">Drama</option>
            <option value="Musical">Musical</option>
            <option value="Acción">Acción</option>
            <option value="Infantil">Infantil</option>
        </select>
        <input type="submit" name="Filtrar" value="Filtrar">
    </form>
    <h2>Películas Filtradas</h2>
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
            if (isset($_SESSION['peliculas_filtradas'])) {
                foreach ($_SESSION['peliculas_filtradas'] as $pelicula) {
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
    <a href="peliculas.php">Ver todas las películas</a>
</body>

</html>
