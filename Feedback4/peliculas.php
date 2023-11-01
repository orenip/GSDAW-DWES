<?php
session_start();
?>
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
    <h1>Feedback 4 - Apartado 2</h1>
    <p>Página donde se muestren las películas almacenadas enmarcadas en una tabla HTML. Debe tener un bóton para volver a la página principal.</p>
    <h1>Películas Almacenadas</h1>
    <?php
    if (isset($_SESSION['peliculas'])) {
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
                <?php foreach ($_SESSION['peliculas'] as $pelicula) {
                    print "<tr><td>" . $pelicula['titulo'] . "</td>\n<td>" . $pelicula['anio'] . "</td>\n<td>" . $pelicula['genero'] . "</td><td>" . $pelicula['director'] . "</td>\n</tr>\n";
                } ?>

            </tbody>
        </table>

    <?php
    }
    ?>
    <a href="index.php">Volver a la página principal</a>
    <a href="busqueda.php">Buscar películas</a>
</body>

</html>