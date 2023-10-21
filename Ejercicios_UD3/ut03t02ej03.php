<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Soluciones ejercicios tutoría 2</title>
</head>

<body>
   <h1>Tutoría 2. Ejercicio 3</h1>
   <p>Implementar un formulario que pida el código de un jugador y lo elimine de la tabla.</p>
   <?php
   if (!isset($_REQUEST['enviar'])) {
      // Si no venimos del formulario lo mostramos
      ?>
      <p>Introduce el código del jugador a borrar...</p>
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
         <input type="number" name="cod_jugador" required/><br />
         <input type="submit" name="enviar" value="Enviar" />
      </form>
      <?php
   } else {
      $cod_jugador = $_REQUEST['cod_jugador'];

      try {
         // Nos conectamos a la base de datos 
         // Instanciamos un objeto de tipo MySQLi
         $conexion = new mysqli('localhost', 'root', '', 'baloncesto');

         // Construimos la consulta a la base de datos para eliminar el jugador
         $sql = "delete from jugadores where cod_jugador = $cod_jugador";
         $result = $conexion->query($sql);

         // Si se ha ejecutado el delete correctamente informamos
         if ($conexion->affected_rows == 1) {
            echo "<p>Jugador borrado.</p>";
         } else {
            echo "<p>No se ha borrado el jugador.</p>";
         }
         
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