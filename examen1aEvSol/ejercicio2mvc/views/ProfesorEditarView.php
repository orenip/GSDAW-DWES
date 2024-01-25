<!-- Incluimos la cabecera -->
<?php include_once("common/cabecera.php"); ?>

<!-- Vista para editar un elemento de la tabla -->

<body>
	<!-- Incluimos un menú para la aplicación -->
	<?php include_once("common/menu.php"); ?>

	<!-- Parte específica de nuestra vista -->
	<form action="index.php" method="post">
		<input type="hidden" name="controlador" value="Profesor">
		<input type="hidden" name="accion" value="editar">

		<label for="cod_profesor">Codigo</label>
		<input type="text" name="cod_profesor" value="<?php echo $profe->getCodProfesor(); ?>" readonly>
		</br>

		<?php echo isset($errores["nombre_profesor"]) ? "*" : "" ?>
		<label for="nombre_profesor">Nombre del profesor</label>
		<input type="text" name="nombre_profesor" value="<?php echo $profe->getNombreProfesor(); ?>">
		</br>

		<input type="submit" name="submit" value="Aceptar">
		<input type="submit" name="cancel" value="Cancelar">
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

	<!-- Incluimos el pie de la página -->
	<?php include_once("common/pie.php"); ?>
</body>

</html>