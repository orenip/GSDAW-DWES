<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Soluciones ejercicios tutoría 3</title>
</head>

<body>
   <h1>Tutoría 3. Ejercicio 2</h1>
   <p>Crear una tabla HTML que muestre todos los equipo. En cada fila se aparecerán los datos de los equipos y al final
      de cada una de ellas aparecerá un botón que nos llevará a otra página donde podremos ver los jugadores del equipo
      seleccionado. Los jugadores también aparecerán en una tabla HTML.</p>
   <?php
   if (!isset($_REQUEST['cod_jugador'])) {
      // Si no se reciben datos del jugador no se hace nada
      ?>
      <p>No se han recibido datos del jugador</p>
      <?php
   } elseif (isset($_REQUEST['actualizar_jugador'])) {
      // Si hemos pulsado el botón actualizar actualizamos los datos del jugador
   
      try {
         // Nos conectamos a la base de datos 
         // Instanciamos un objeto de tipo MySQLi
         $conexion = new mysqli('localhost', 'root', '', 'baloncesto');

         $cod_jugador = $_REQUEST['cod_jugador'];
         $nombre = $_REQUEST['nombre'];
         $fecha_nacimiento = $_REQUEST['fecha_nacimiento'];
         $altura = $_REQUEST['altura'];
         $posicion = $_REQUEST['posicion'];
         $equipo_jugador = $_REQUEST['equipo_jugador'];

         // Construimos la consulta a la base de datos
         $sql = "update jugadores set nombre_jugador='$nombre', fecha_nacimiento='$fecha_nacimiento', estatura=$altura, posicion='$posicion', equipo=$equipo_jugador where cod_jugador=$cod_jugador";
         $result = $conexion->query($sql);

         // Si se ha ejecutado el update correctamente informamos
         if ($conexion->affected_rows == 1) {
            echo "<p>Jugador actualizado.</p>";
         } else {
            echo "<p>No se ha actualizado el jugador.</p>";
         }

         echo "<a href='ut03t03ej01JugadoresEquipo.php?cod_equipo=$equipo_jugador'>Volver al listado de jugadores</a>";

      } catch (Exception $e) {
         // Si se produce una excepción mostramos el mensaje de error
         echo "<p>Se ha producido un error: ", $e->getMessage(), "</p>";
      } finally {
         // Para finalizar liberamos recursos
         $result->close();
         $conexion->close();
      }
   } elseif (isset($_REQUEST['editar_jugador'])) {
      // Si se viene del listado de jugadores se cargan los datos recibidos en el formulario
      ?>
      <p>Modifica los datos del jugador</p>
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
         <input type="hidden" name="cod_jugador" value="<?php echo $_REQUEST['cod_jugador'] ?>" /><br />
         Nombre: <input type="text" name="nombre" value="<?php echo $_REQUEST['nombre'] ?>" /><br />
         Fecha nacimiento: <input type="date" name="fecha_nacimiento"
            value="<?php echo $_REQUEST['fecha_nacimiento'] ?>" /><br />
         Altura (cm): <input type="number" name="altura" value="<?php echo $_REQUEST['altura'] ?>" /><br />
         Posición: <input type="text" name="posicion" value="<?php echo $_REQUEST['posicion'] ?>" /><br />
         Equipo: <input type="number" name="equipo_jugador" value="<?php echo $_REQUEST['equipo_jugador'] ?>" /><br />
         <input type="submit" name="cancelar" value="Cancelar" />
         <input type="submit" name="actualizar_jugador" value="Actualizar" />
      </form>
      <?php
   } elseif (isset($_REQUEST['cancelar'])) {
      // Si pulsamos el botón cancelar volvemos al listado de jugadores
      header("Location: ut03t03ej01JugadoresEquipo.php?cod_equipo=" . $_REQUEST['equipo_jugador']);
      die;
   }
   ?>
</body>

</html>