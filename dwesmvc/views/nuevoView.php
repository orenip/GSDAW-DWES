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
		<input type="hidden" name="controlador" value="Item">
		<input type="hidden" name="accion" value="nuevo">

		<?php echo isset($errores["codigo"]) ? "*" : "" ?>
		<label for="codigo">Codigo</label>
		<input type="text" name="codigo">
		</br>

		<?php echo isset($errores["nombre"]) ? "*" : "" ?>
		<label for="nombre">Nombre</label>
		<input type="text" name="nombre">
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