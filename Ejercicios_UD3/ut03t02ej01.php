<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Soluciones ejercicios tutoría 2</title>
</head>

<body>
   <h1>Tutoría 2. Ejercicio 1</h1>
   <p>Diseñar un formulario que pida en una caja de texto el código de un equipo y mostrar el número de jugadores que
      tiene y sus nombres.</p>
   <?php
   if (!isset($_REQUEST['enviar'])) {
      // Si no venimos del formulario lo mostramos
      ?>
      <p>Indica el código del equipo a mostrar</p>
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
         Código de equipo: <input type="number" name="cod_equipo" /><br />
         <input type="submit" name="enviar" value="Enviar" />
      </form>
      <?php
   } else {
      $cod_equipo = $_REQUEST['cod_equipo'];

      try {
         // Nos conectamos a la base de datos 
         // Instanciamos un objeto de tipo MySQLi
         $conexion = new mysqli('localhost', 'root', '', 'baloncesto');

         // Construimos la consulta a la base de datos
         $sql = "select NOMBRE_JUGADOR from JUGADORES where equipo = " . $cod_equipo;
         $result = $conexion->query($sql);

         // Mostramos la cantidad de registros recuperados
         echo "<p>El equipo tiene " . $result->num_rows . " jugdores.</p>";

         // Recuperamos todos los registros a la vez - alternativa al "fetch_array()"
         $jugadores = $result->fetch_all();
         echo "<ul>";
         foreach ($jugadores as $key => $value) {
            echo "<li>" . $value[0] . "</li>";
         }
         echo "</ul>";

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