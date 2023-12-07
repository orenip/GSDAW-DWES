<!-- Incluimos la cabecera -->
<?php include_once("common/cabecera.php"); ?>

<!-- Vista para editar un elemento de la tabla -->

<body>
	<!-- Incluimos un menú para la aplicación -->
	<?php include_once("common/menu.php"); ?>

	<!-- Parte específica de nuestra vista -->
	<form action="index.php" method="post">
		<input type="hidden" name="controlador" value="Equipo">
		<input type="hidden" name="accion" value="editar">

		<label for="curso_equipo">Curso</label>
		<input type="text" name="curso_equipo" value="<?php echo $equipo->getCursoEquipo(); ?>" readonly>
		</br>

		<?php echo isset($errores["materia_equipo"]) ? "*" : "" ?>
		<label for="materia_equipo">Materia</label>
		<input type="text" name="materia_equipo" value="<?php echo $equipo->getMateriaEquipo(); ?>">
		</br>

		<label for="profesor_equipo">Profesor</label>
		<select name="profesor_equipo" id="profesor_equipo">
			<?php foreach ($profesores as $profesor):
				if ($profesor->getCodProfesor() == $equipo->getProfesorEquipo()) {
					echo "<option value='" . $equipo->getCodProfesor() . "' selected>";
				} else {
					echo "<option value='" . $equipo->getCodProfesor() . "'>";
				}
				echo $nivel->getDescNivel(); ?>
				</option>
			<?php endforeach; ?>
		</select>
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