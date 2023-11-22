<!-- Vista para añadir un nuevo item a la tabla -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Microframework MVC - Modelo, Vista, Controlador</title>
</head>

<body>
	<!-- Formulario para insertar un nuevo item --> 
	<form action="index.php" method="post">
		<input type="hidden" name="controlador" value="Partidos">
		<input type="hidden" name="accion" value="nuevo">

		<?php echo isset($errores["COD_PARTIDO"]) ? "*" : "" ?>
		<label for="COD_PARTIDO">COD_PARTIDO</label>
		<input type="text" name="COD_PARTIDO">
		</br>

		<?php echo isset($errores["FECHA"]) ? "*" : "" ?>
		<label for="FECHA">FECHA</label>
		<input type="date" name="FECHA">
		</br>

		<?php echo isset($errores["COD_EQUIPO1"]) ? "*" : "" ?>
		<label for="COD_EQUIPO1">COD_EQUIPO1</label>
		<input type="number" name="COD_EQUIPO1">
		</br>

		<?php echo isset($errores["COD_EQUIPO2"]) ? "*" : "" ?>
		<label for="COD_EQUIPO2">COD_EQUIPO2</label>
		<input type="number" name="COD_EQUIPO2">
		</br>

		<?php echo isset($errores["PUNTOS_EQUIPO1"]) ? "*" : "" ?>
		<label for="PUNTOS_EQUIPO1">PUNTOS_EQUIPO1</label>
		<input type="number" name="PUNTOS_EQUIPO1">
		</br>

		<?php echo isset($errores["PUNTOS_EQUIPO2"]) ? "*" : "" ?>
		<label for="PUNTOS_EQUIPO2">PUNTOS_EQUIPO2</label>
		<input type="number" name="PUNTOS_EQUIPO2">
		</br>

		<input type="submit" name="submit" value="Aceptar">
	</form>
	</br>

	<?php
	// Si hay errores se muestran
	if (isset($errores)):
		foreach ($errores as $key => $error):
			echo $error . "</br>";
		endforeach;
	endif;
	?>

</body>

</html>