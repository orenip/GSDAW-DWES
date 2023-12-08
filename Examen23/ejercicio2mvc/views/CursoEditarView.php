<!-- Incluimos la cabecera -->
<?php include_once("common/cabecera.php"); ?>

<!-- Vista para editar un elemento de la tabla -->

<body>
	<!-- Incluimos un menú para la aplicación -->
	<?php include_once("common/menu.php"); ?>

	<!-- Parte específica de nuestra vista -->
	<form action="index.php" method="post">
		<input type="hidden" name="controlador" value="Curso">
		<input type="hidden" name="accion" value="editar">

		<label for="cod_curso">Codigo</label>
		<input type="text" name="cod_curso" value="<?php echo $curso->getCodCurso(); ?>" readonly>
		</br>

		<?php echo isset($errores["desc_curso"]) ? "*" : "" ?>
		<label for="desc_curso">Descripción del curso</label>
		<input type="text" name="desc_curso" value="<?php echo $curso->getDescCurso(); ?>">
		</br>

		<label for="nivel_curso">Nivel educativo</label>
		<select name="nivel_curso" id="nivel_curso">
			<?php foreach ($niveles as $nivel):
				if ($nivel->getCodNivel() == $curso->getNivelCurso()) {
					echo "<option value='" . $curso->getNivelCurso() . "' selected>";
				} else {
					echo "<option value='" . $curso->getNivelCurso() . "'>";
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