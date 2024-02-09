<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Festivos de un pais</title>
</head>

<body>
   <?php
   // API-KEY que obtenemos al registrarnos
   $api_key = "iOg2L8cDwAfR6z8kntxsbmyYJEUxemGl";

   if (isset($_REQUEST['enviar'])) {
      if (isset($_REQUEST['year']) && isset($_REQUEST['pais'])) {
         $year = $_REQUEST['year'];
         $pais = $_REQUEST['pais'];

         // Endpoint para obtener los festivos
         $endpoint_holidays = "https://calendarific.com/api/v2/holidays?api_key=$api_key&country=$pais&year=$year";

         // Se solicitan los festivos del pais y del año seleccionados
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $endpoint_holidays);
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

         $headers = array(
            'Content-Type: application/json; charset=UTF-8'
         );
         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

         $response = curl_exec($ch);
         curl_close($ch);

         // Guardamos en un array el resultado devuelto por la API REST
         // OJO! Se pasa true como segundo parámetro para que el array sea asociativo
         $array_resultado = json_decode($response, true);
         $festivos = $array_resultado['response']['holidays'];

         // Mostramos los días festivos
         $actual_mes = date('n');
         echo "<h2>Estos son los festivos en $pais para el mes actual</h2>";
         echo "<ul>";

         // Recorremos los festivos recibidos
         foreach($festivos as $festivo) {
            // Si el mes es el actual
            if ($actual_mes == $festivo['date']['datetime']['month']) {
               $fecha = $festivo['date']['iso'];
               $nombre_festivo = $festivo['name'];
               echo "<li>$fecha --> $nombre_festivo</li>";
            }
         }
         echo "</ul>";
      }
   } else {
      // Solicitamos la lista de paises para el desplegable del formulario
   
      // Endpoint para obtener la lista de paises
      $endpoint_countries = "https://calendarific.com/api/v2/countries?api_key=$api_key";

      // Se solicitan los paises
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $endpoint_countries);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      $headers = array(
         'Content-Type: application/json; charset=UTF-8'
      );
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

      $response = curl_exec($ch);
      curl_close($ch);

      // Guardamos en un array el resultado devuelto por la API REST
      // OJO! Se pasa true como segundo parámetro para que el array sea asociativo
      $array_resultado = json_decode($response, true);
      $paises = $array_resultado['response']['countries'];

      // Obtenemos el año actual
      $actual_year = date("Y");
      ?>

      <!-- Formulario para recoger los datos -->
      <form id="form_vacaciones" action="" method="post">
         <input type="hidden" name="year" value="<?php echo $actual_year ?>">

         <label for="pais">Selecciona el país:</label>
         <select name="pais">
            <?php foreach ($paises as $pais) { ?>
               <option value="<?php echo $pais['iso-3166'] ?>">
                  <?php echo $pais['country_name'] ?>
               </option>
            <?php } ?>
         </select>
         </br>
         <input type="submit" name="enviar" value="Aceptar">
      </form>

      <?php
   }
   ?>

</body>

</html>