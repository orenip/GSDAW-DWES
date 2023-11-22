<!-- Vista para editar un elemento de la tabla -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Microframework MVC - Modelo, Vista, Controlador</title>
</head>

<body>
	<form action="index.php" method="post">
		<input type="hidden" name="controlador" value="Equipos">
		<input type="hidden" name="accion" value="editar">

		<label for="COD_EQUIPO">Codigo</label>
		<input type="number" name="COD_EQUIPO" value="<?php echo $equipo->getCOD_EQUIPO(); ?>" readonly>
		</br>

		<?php echo isset($errores["NOMBRE_EQUIPO"]) ? "*" : "" ?>
		<label for="NOMBRE_EQUIPO">NOMBRE_EQUIPO</label>
		<input type="text" name="NOMBRE_EQUIPO" value="<?php echo $equipo->getNOMBRE_EQUIPO(); ?>">
		</br>

		<?php echo isset($errores["PRESUPUESTO"]) ? "*" : "" ?>
		<label for="PRESUPUESTO">PRESUPUESTO</label>
		<input type="number" name="PRESUPUESTO" value="<?php echo $equipo->getPRESUPUESTO(); ?>">
		</br>

		<?php echo isset($errores["FECHA_FUNDACION"]) ? "*" : "" ?>
		<label for="FECHA_FUNDACION">FECHA_FUNDACION</label>
		<input type="date" name="FECHA_FUNDACION" value="<?php echo $equipo->getFECHA_FUNDACION(); ?>">
		</br>


		<?php echo isset($errores["ZONA"]) ? "*" : "" ?>
		<label for="ZONA">ZONA</label>
		<input type="number" name="ZONA" value="<?php echo $equipo->getZONA(); ?>">
		</br>

		<?php echo isset($errores["TITULOS"]) ? "*" : "" ?>
		<label for="TITULOS">TITULOS</label>
		<input type="number" name="TITULOS" value="<?php echo $equipo->getTITULOS(); ?>">
		</br>


		<input type="submit" name="submit" value="Aceptar">
	</form>
	</br>
	
	<?php
	// Si hay errores los mostramos.
	if (isset($errores)):
		foreach ($errores as $key => $error):
			echo $error . "</br>";
		endforeach;
	endif;
	?>
</body>

</html>