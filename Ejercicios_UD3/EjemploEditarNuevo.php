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
    <h1>Ejemplo Formulario para añadir un nuevo jugador y volver al listado</h1>
    <p>Inicialmente se muestra un formulario para introducir los datos de un jugador. Luego se pasan los datos al script que añade el jugador y vuelve a listar todos los jugadores.</p>

    <hr>
    <h1>Nuevo jugador</h1>
    <!-- Formulario que se envía cuando cambiamos los datos -->
    <form action="EjemploEditarListado.php" method="post">
        Codigo <input type="text" name="num_jugador" /><br>
        Nombre <input type="text" name="nom_jugador" /><br>
        Fecha nacimiento <input type="date" name="fec_nac" /><br>
        Estatura <input type="text" name="estatura" /><br>
        Posición <input type="text" name="posicion" /><br>
        Equipo <input type="text" name="cod_equipo" /><br>
        <input type="text" hidden="hidden" name="nuevo" value="nuevo" />
        <input type="submit" value="Añadir jugador" />
    </form>

    <!-- Formulario que se envía cuando cancelamos la modificación -->
    <form action="EjemploEditarListado.php" method="post">
        <input type="text" hidden="hidden" name="cancelar" value="cancelar" />
        <input type="submit" value="Cancelar" />
    </form>

</body>

</html>