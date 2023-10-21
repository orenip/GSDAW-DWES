<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Soluciones ejercicios tutoría 3</title>
</head>

<body>
   <h1>Tutoría 3. Ejercicio 1</h1>
   <p>Crear una tabla HTML que muestre todos los equipo. En cada fila se aparecerán los datos de los equipos y al final de cada una de ellas aparecerá un botón que nos llevará a otra página donde podremos ver los jugadores del equipo seleccionado. Los jugadores también aparecerán en una tabla HTML.</p>
   <?php
   if (!isset($_REQUEST['cod_equipo'])) {
      // Si no recibimos un código de jugador mostramos mensaje
      ?>
      <p>No se ha recibido ningún código de equipo.</p>
      <?php
   } else {
      $cod_equipo = $_REQUEST['cod_equipo'];

      try {
         // Nos conectamos a la base de datos 
         // Instanciamos un objeto de tipo MySQLi
         $conexion = new mysqli('localhost', 'root', '', 'baloncesto');

         // Construimos la consulta a la base de datos
         $sql = "select * from JUGADORES where equipo = " . $cod_equipo;
         $result = $conexion->query($sql);

         // Recuperamos todos los registros a la vez - alternativa al "fetch_array()"
         $jugadores = $result->fetch_all();
         
         echo "<table><tr>";
         echo "<th>Código</th>";
         echo "<th>Nombre</th>";
         echo "<th>Fecha nacimiento</th>";
         echo "<th>Altura (cm)</th>";
         echo "<th>Posición</th>";
         echo "</tr>";

         // Para cada registro mostramos los datos en una fila de la tabla
         foreach ($jugadores as $key => $value) {
            echo "<tr>";
            echo "<td>" . $value[0] . "</td>";
            echo "<td>" . $value[1] . "</td>";
            echo "<td>" . $value[2] . "</td>";
            echo "<td>" . $value[3] . "</td>";
            echo "<td>" . $value[4] . "</td>";
         
            // En cada fila ponemos un botón para editar los datos del jugador
            echo "<td><form action='ut03t03ej02JugadorEditar.php' method='post'>";
            echo "<input type='hidden' name='cod_jugador' value='$value[0]'/>";
            echo "<input type='hidden' name='nombre' value='$value[1]'/>";
            echo "<input type='hidden' name='fecha_nacimiento' value='$value[2]'/>";
            echo "<input type='hidden' name='altura' value='$value[3]'/>";
            echo "<input type='hidden' name='posicion' value='$value[4]'/>";
            echo "<input type='hidden' name='equipo_jugador' value='$value[5]'/>";
            echo "<input type='submit' name='editar_jugador' value='Editar jugador'/></form></td>";
            echo "</tr>";
         }
         echo "</table>";

      } catch (Exception $e) {
         // Si se produce una excepción mostramos el mensaje de error
         echo "<p>Se ha producido un error: ", $e->getMessage(), "</p>";
      } finally {
         // Para finalizar liberamos recursos
         $result->close();
         $conexion->close();
      }
   }
   ?>
</body>

</html>