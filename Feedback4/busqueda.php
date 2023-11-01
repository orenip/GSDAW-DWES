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
    <title>Apartado 3</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <h1>Feedback 4 - Apartado 3</h1>
    <p>Página de búsqueda. Nos aparece un formulario con la lista desplegable de los géneros y un botón de filtrado, 
        al seleccionar un género y pulsar el botón nos debe mostrar únicamente las películas del género seleccionado. 
        Debe tener un bóton para volver a la página principal.</p>

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




    <h3>Películas Filtradas</h3>
    <?php
    // Comprobar si existen datos de películas en la sesión
    if (isset($_SESSION['peliculas_filtradas'])) {
    ?>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Título</th>
                    <th scope="col">Año</th>
                    <th scope="col">Género</th>
                    <th scope="col">Director</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['peliculas_filtradas'] as $pelicula) {
                    print "<tr><td>" . $pelicula['titulo'] . "</td>\n<td>" . $pelicula['anio'] . "</td>\n<td>" . $pelicula['genero'] . "</td><td>" . $pelicula['director'] . "</td>\n</tr>\n";
                } ?>

            </tbody>
        </table>
    <?php
    }
    ?>
    <!-- Enlaces a las otras dos páginas -->
    <a href="index.php">Volver a la página principal</a>
    <a href="peliculas.php">Ver todas las películas</a>
</body>

</html>