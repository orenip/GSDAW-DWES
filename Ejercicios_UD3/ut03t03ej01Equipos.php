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
   try {
      // Nos conectamos a la base de datos 
      // Instanciamos un objeto de tipo MySQLi
      $conexion = new mysqli('localhost', 'root', '', 'baloncesto');

      // Consulta para recuperar los equipos
      $sql = "select * from equipos";
      $result = $conexion->query($sql);

      // Si hemos recuperado algún equipo los pasamos a un array de registros y los mostramos en una tabla
      if ($result->num_rows > 0) {
         $equipos = $result->fetch_all();
         echo "<table><tr>";
         echo "<th>Código</th>";
         echo "<th>Nombre</th>";
         echo "<th>Presupuesto</th>";
         echo "<th>Fecha fundación</th>";
         echo "<th>Zona</th>";
         echo "<th>Títulos</th>";
         echo "</tr>";

         // Para cada registro mostramos los datos en una fila de la tabla
         foreach ($equipos as $key => $value) {
            echo "<tr>";
            echo "<td>" . $value[0] . "</td>";
            echo "<td>" . $value[1] . "</td>";
            echo "<td>" . $value[2] . "</td>";
            echo "<td>" . $value[3] . "</td>";
            echo "<td>" . $value[4] . "</td>";
            echo "<td>" . $value[5] . "</td>";

            // En cada fila ponemos un botón para listar los jugadores del equipo
            echo "<td><form action='ut03t03ej01JugadoresEquipo.php' method='post'>";
            echo "<input type='hidden' name='cod_equipo' value='$value[0]'/>";
            echo "<input type='submit' name='ver_jugadores' value='Ver jugadores'/></form></td>";
            echo "</tr>";
         }
         echo "</table>";
      }

   } catch (Exception $e) {
      // Si se produce una excepción mostramos el mensaje de error
      echo "<p>Se ha producido un error: ", $e->getMessage(), "</p>";
   } finally {
      // Para finalizar liberamos recursos
      $result->close();
      $conexion->close();
   }
   ?>
</body>

</html>