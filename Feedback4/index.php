<?php
// Recuperamos la sesión anterior
session_start();


if (isset($_POST['Enviar'])) {
    // Recuperamos los datos de la película y creamos un array
    $datosPelicula = array(
        'titulo' => $_POST['titulo'],
        'anio' => $_POST['anio'],
        'genero' => $_POST['genero'],
        'director' => $_POST['director']
    );
    // Añadimos la película a la información de la sesión
    if (!isset($_SESSION['peliculas'])) {
        $_SESSION['peliculas'] = array();
    }
    $_SESSION['peliculas'][] = $datosPelicula;
}

?>

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
    <h1>Feedback 4 - Apartado 1</h1>
    <p>Vamos a crear un programa que almacene datos de películas en $_SESSION. <br>
        Página principal donde se muestre un formulario para que se inserten los datos de la película que serán el
        título, el año, el género y el director. El género se elegirá mediante una lista desplegable entre las opciones
        "Comedia", "Drama", "Musical", "Acción" e "Infantil". Esta página además debe tener un enlace a la otras dos páginas.</p>
       
    <!-- Se muestra el formulario y los enlace de enviar y buscar -->
    <h1>Introduce los datos de la película</h1>
    <form name="formPelicula" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        Título: <input type="text" name="titulo"><br>
        Año: <input type="text" name="anio"><br>
        Género:
        <select name="genero">
            <option value="Comedia">Comedia</option>
            <option value="Drama">Drama</option>
            <option value="Musical">Musical</option>
            <option value="Acción">Acción</option>
            <option value="Infantil">Infantil</option>
        </select><br>
        Director: <input type="text" name="director"><br>
        <input type="submit" name="Enviar" value="Enviar">
    </form>
    <!-- Enlaces a las otras dos páginas -->
    <a href="peliculas.php">Ver películas almacenadas</a>
    <a href="busqueda.php">Buscar películas</a>


</body>

</html>