<!DOCTYPE html>
<html>

<head>
    <title>Ejemplo Editar y volver al listado</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <h1>Ejemplo Formulario para actualizar un registro y volver al listado</h1>
    <p>Este ejemplo utiliza MySQLi para listar los registros de una tabla y para cada registro incorpora un botón que permite eliminar dicho registro.</p>
    <p>Jugador para editar</p>
    <p><?php echo $_POST['num_jugador'] ?> - <?php echo $_POST['nom_jugador'] ?> - <?php echo $_POST['fec_nac'] ?> - <?php echo $_POST['estatura'] ?> - <?php echo $_POST['cod_equipo'] ?></p>
    <hr>
    <h1>Editar jugador</h1>
    <!-- Formulario que se envía cuando cambiamos los datos -->
    <form action="EjemploEditarListado.php" method="post">
        Codigo <input type="text" readonly="readonly" name="num_jugador" value="<?php echo $_POST['num_jugador'] ?>" /><br>
        Nombre <input type="text" name="nom_jugador" value="<?php echo $_POST['nom_jugador'] ?>" /><br>
        Fecha nacimiento <input type="date" name="fec_nac" value="<?php echo $_POST['fec_nac'] ?>" /><br>
        Estatura <input type="text" name="estatura" value="<?php echo $_POST['estatura'] ?>" /><br>
        Posición <input type="text" name="posicion" value="<?php echo $_POST['posicion'] ?>" /><br>
        Equipo <input type="text" name="cod_equipo" value="<?php echo $_POST['cod_equipo'] ?>" /><br>
        <input type="text" hidden="hidden" name="editar" value="editar" />
        <input type="submit" value="Guardar cambios" />
    </form>

    <!-- Formulario que se envía cuando cancelamos la modificación -->
    <form action="EjemploEditarListado.php" method="post">
        <input type="text" hidden="hidden" name="cancelar" value="cancelar" />
        <input type="submit" value="Cancelar" />
    </form>

</body>

</html>