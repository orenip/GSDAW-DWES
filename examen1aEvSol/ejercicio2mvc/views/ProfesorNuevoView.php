<!-- Incluimos la cabecera -->
<?php include_once("common/cabecera.php"); ?>

<!-- Vista para editar un elemento de la tabla -->

<body>
	<!-- Incluimos un menú para la aplicación -->
	<?php include_once("common/menu.php"); ?>

	<!-- Parte específica de nuestra vista -->
	<!-- Formulario para insertar un nuevo item -->
	<form action="index.php" method="post">
		<input type="hidden" name="controlador" value="Profesor">
		<input type="hidden" name="accion" value="nuevo">

		<?php echo isset($errores["nombre_profesor"]) ? "*" : "" ?>
		<label for="nombre_profesor">Nombre del profesor</label>
		<input type="text" name="nombre_profesor">
		</br>

		<input type="submit" name="submit" value="Aceptar">
		<input type="submit" name="cancel" value="Cancelar">
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

	<!-- Incluimos el pie de la página -->
	<?php include_once("common/pie.php"); ?>
</body>

</html>