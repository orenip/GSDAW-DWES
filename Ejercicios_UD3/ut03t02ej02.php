<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Soluciones ejercicios tutoría 2</title>
</head>

<body>
   <h1>Tutoría 2. Ejercicio 2</h1>
   <p>Crear un formulario que recoja datos de un nuevo equipo y lo inserte en la tabla.</p>
   <?php
   if (!isset($_REQUEST['enviar'])) {
      // Si no venimos del formulario lo mostramos
      ?>
      <p>Indica el código del equipo a mostrar</p>
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
         Nombre del equipo: <input type="text" name="nombre" required/><br />
         Presupuesto: <input type="number" name="presupuesto" required/><br />
         Fecha fundación: <input type="date" name="fecha_fundacion" required/><br />
         Zona: <input type="number" name="zona" required/><br />
         Número de títulos: <input type="number" name="titulos" required/><br />
         <input type="submit" name="enviar" value="Enviar" />
      </form>
      <?php
   } else {
      // Recuperamos los datos del formulario
      $nombre = $_REQUEST['nombre'];
      $presupuesto = $_REQUEST['presupuesto'];
      $fecha_fundacion = $_REQUEST['fecha_fundacion'];
      $zona = $_REQUEST['zona'];
      $titulos = $_REQUEST['titulos'];

      try {
         // Nos conectamos a la base de datos 
         // Instanciamos un objeto de tipo MySQLi
         $conexion = new mysqli('localhost', 'root', '', 'baloncesto');

         // Consulta para recuperar el código de equipo más alto
         $sql_max_codigo = "select max(COD_EQUIPO) from EQUIPOS";
         $result_max_codigo = $conexion->query($sql_max_codigo);
         $array_max_codigo = $result_max_codigo->fetch_array();
         $max_codigo = $array_max_codigo[0];

         // El siguiente código de equipo lo calculamos
         $next_codigo = $max_codigo + 1;

         // Construimos la consulta a la base de datos para insertar el nuevo equipo
         $sql = "insert into equipos values ($next_codigo,'$nombre',$presupuesto,'$fecha_fundacion',$zona,$titulos)";
         $result = $conexion->query($sql);

         // Si se ha ejecutado la inserción correctamente informamos
         if ($result) {
            echo "<p>Equipo insertado correctamente.</p>";
         } else {
            echo "<p>No se ha insertado el equipo.</p>";
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