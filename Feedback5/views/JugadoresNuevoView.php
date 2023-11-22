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
		<input type="hidden" name="controlador" value="Jugadores">
		<input type="hidden" name="accion" value="nuevo">

		<?php echo isset($errores["COD_EQUIPO"]) ? "*" : "" ?>
		<label for="COD_JUGADOR">COD_JUGADOR</label>
		<input type="number" name="COD_JUGADOR">
		</br>

		<?php echo isset($errores["NOMBRE_JUGADOR"]) ? "*" : "" ?>
		<label for="NOMBRE_JUGADOR">NOMBRE_EQUIPO</label>
		<input type="text" name="NOMBRE_JUGADOR">
		</br>

		<?php echo isset($errores["FECHA_NACIMIENTO"]) ? "*" : "" ?>
		<label for="FECHA_NACIMIENTO">FECHA_FUNDACION</label>
		<input type="date" name="FECHA_NACIMIENTO">
		</br>

		<?php echo isset($errores["ESTATURA"]) ? "*" : "" ?>
		<label for="ESTATURA">ESTATURA</label>
		<input type="number" name="ESTATURA">
		</br>

		<?php echo isset($errores["POSICION"]) ? "*" : "" ?>
		<label for="EQUIPO">EQUIPO</label>
		<input type="text" name="EQUIPO">
		</br>

		<?php echo isset($errores["EQUIPO"]) ? "*" : "" ?>
		<label for="EQUIPO">EQUIPO</label>
		<input type="number" name="EQUIPO">
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