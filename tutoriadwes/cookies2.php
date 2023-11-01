<!DOCTYPE html>
<html>

<head>
    <title>UT04 Ejercicio 02</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <?php


    if (isset($_POST['Volcar'])) {
        // Se ha pulsado el botón para volcar los datos almacenados en la cookie en la tabla socios
        echo "<p>Pulsado el botón de Volcar --> pasamos los datos de sesión a la base de datos</p>";

        try {
            $conexion = new mysqli('localhost', 'root', '', 'biblioteca');
            echo "<p>Conexión establecida</p>";

            // Creamos la consulta preparada para insertar datos
            $consulta = $conexion->stmt_init();
            $consulta->prepare('insert into socios(soc_dni,soc_nombre,soc_ciudad) values (?,?,?)');

            // Recorremos los socios y los insertamos en la tabla
            $socios = json_decode($_COOKIE['socios']);
            foreach ($socios as $socio) {
                $consulta->bind_param('sss', $socio[1], $socio[0], $socio[2]);
                $consulta->execute();
            }

            echo "<p>Socios guardados en la base de datos</p>";

            // Eliminamos los datos de la cookie
            setcookie("socios", null, time() - 60);
        } catch (Exception $e) {
            echo "<p>Error al conectar: ", $e->getMessage(), "</p>";
        } finally {
            $consulta->close();
            $conexion->close();
        }
    }


    if (isset($_POST['Enviar'])) {
        echo "<p>Se ha pulsado el botón Enviar --> añadir datos de socio a la sesión</p>";

        // Recuperamos los datos del socio y creamos un array
        $datosSocio = array($_POST['nom_socio'], $_POST['dni_socio'], $_POST['ciudad_socio']);
        // Añadimos el socio a la información de la cookie
        if (!isset($_COOKIE['socios'])) {
            $datos_guardados = array();
        } else {
            $datos_guardados = json_decode($_COOKIE['socios']);
        }
        $datos_guardados[] = $datosSocio;
        setcookie('socios', json_encode($datos_guardados));
    }

    // Si hay datos de socios en la cookie se muestran
    if (isset($datos_guardados)) {
        $socios_guardados = $datos_guardados;
    } else {
        $socios_guardados = json_decode($_COOKIE['socios']);
    }

    if (isset($socios_guardados)) {
        ?>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">DNI</th>
                    <th scope="col">Ciudad</th>
                </tr>
            </thead>
            <tbody>

                <?php
                // Recorremos el array de socios guardado en la sesión
                foreach ($socios_guardados as $socio) {
                    print "<tr><td>$socio[0]</td>\n<td>$socio[1]</td>\n<td>$socio[2]</td></tr>\n";
                }
                ?>
            </tbody>
        </table>
        <?php
    }
    ?>

    <!-- Se muestra el formulario y los botones de enviar y volcar -->
    <h1>Introduce los datos del socio</h1>
    <form name=" formSocio" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        Nombre: <input type="text" name="nom_socio"> </br>
        DNI: <input type="text" name="dni_socio"> </br>
        Ciudad: <input type="text" name="ciudad_socio"> </br>
        <input type="submit" name="Enviar" value="Enviar">
        </br>
        </br>
        <input type="submit" name="Volcar" value="Volcar">
    </form>
</body>

</html>