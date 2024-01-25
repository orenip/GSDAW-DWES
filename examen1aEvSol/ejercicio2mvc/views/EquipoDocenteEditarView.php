<!-- Incluimos la cabecera -->
<?php include_once("common/cabecera.php"); ?>

<!-- Vista para editar un elemento de la tabla -->

<body>
	<!-- Incluimos un menú para la aplicación -->
	<?php include_once("common/menu.php"); ?>

	<!-- Parte específica de nuestra vista -->
	<form action="index.php" method="post">
		<input type="hidden" name="controlador" value="EquipoDocente">
		<input type="hidden" name="accion" value="editar">

		<input type="hidden" name="curso_equipo" value="<?php echo $equipo->getCursoEquipo(); ?>">
		<input type="hidden" name="profesor_equipo" value="<?php echo $equipo->getProfesorEquipo(); ?>">
		
		<label for="profesor_equipo">Profesor</label>
		<select name="profesor_equipo_new" id="profesor_equipo_new">
			<?php foreach ($profes as $profe):
				if ($profe->getCodProfesor() == $equipo->getProfesorEquipo()) {
					echo "<option value='" . $profe->getCodProfesor() . "' selected>";
				} else {
					echo "<option value='" . $profe->getCodProfesor() . "'>";
				}
				echo $profe->getNombreProfesor(); ?>
				</option>
			<?php endforeach; ?>
		</select>
		</br>

		<?php echo isset($errores["materia_equipo"]) ? "*" : "" ?>
		<label for="materia_equipo">Materia</label>
		<input type="text" name="materia_equipo" value="<?php echo $equipo->getMateriaEquipo(); ?>">
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