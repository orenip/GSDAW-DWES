<?php
// Recuperamos la sesión anterior
session_start();


if (isset($_POST['Enviar'])) {
    // Recuperamos los datos de la película y creamos un array
    $datospersonas = array(
        'nombre' => $_POST['nombre'],
        'voto' => $_POST['voto']
    );
    // Añadimos la película a la información de la sesión
    if (!isset($_SESSION['personas'])) {
        $_SESSION['personas'] = array();
    }
    $_SESSION['personas'][] = $datosPelicula;
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
       
    <!-- Se muestra el formulario y los enlace de enviar y buscar -->
    <h1>Introduce a quien votar</h1>
    <form name="formPersonas" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <select name="nombre">
            <option value="Juan">Juan</option>
            <option value="Pepe">Pepe</option>
            <option value="Manu">Manu</option>
            <option value="Angela">Angela</option>
            <option value="Maria">Maria</option>
        </select><br>
        <?php
         //   if($nombre.value)
        
        ?>
        <input type="submit" name="Enviar" value="Enviar">
        
    </form>
    <!-- <a href="busqueda.php">Buscar películas</a> -->

    <?php
    if (isset($_SESSION['personas'])) {
    ?>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Votos</th>
                </tr>
            </thead>
            <tbody>
                
                <?php foreach ($_SESSION['personas'] as $persona) {
                  
                    print "<tr><td>" . $pelicula['nombre'] . $pelicula['votos'] . "</td>\n</tr>\n";
                } ?>

            </tbody>
        </table>

    <?php
    }
    ?>


</body>

</html>