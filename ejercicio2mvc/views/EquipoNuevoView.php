<!-- Incluimos la cabecera -->
<?php include_once("common/cabecera.php"); ?>

<!-- Vista para editar un elemento de la tabla -->

<body>
	<!-- Incluimos un menú para la aplicación -->
	<?php include_once("common/menu.php"); ?>

	<!-- Parte específica de nuestra vista -->
	<!-- Formulario para insertar un nuevo item -->
	<form action="index.php" method="post">
		<input type="hidden" name="controlador" value="Equipo">
		<input type="hidden" name="accion" value="nuevo">

		<?php echo isset($errores["curso_equipo"]) ? "*" : "" ?>
		<label for="curso_equipo">Curso</label>
		<input type="number" name="curso_equipo">
		</br>
		<?php echo isset($errores["materia_equipo"]) ? "*" : "" ?>
		<label for="materia_equipo">Materia</label>
		<input type="text" name="materia_equipo">
		</br>

		<label for="profesor_equipo">Profesor</label>
		<select name="profesor_equipo" id="profesor_equipo">
			<?php foreach ($profesores as $profesor): ?>
				<option value="<?php echo $profesor->getCodProfesor(); ?>">
					<?php echo $profesor->getNombreProfesor(); ?>
				</option>
			<?php endforeach; ?>
		</select>
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