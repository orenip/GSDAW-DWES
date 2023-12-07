<!-- Incluimos la cabecera -->
<?php include_once("common/cabecera.php"); ?>

<!-- Vista para editar un elemento de la tabla -->

<body>
	<!-- Incluimos un menú para la aplicación -->
	<?php include_once("common/menu.php"); ?>

	<!-- Parte específica de nuestra vista -->
	<form action="index.php" method="post">
		<input type="hidden" name="controlador" value="Producto">
		<input type="hidden" name="accion" value="editar">

		<input type="hidden" name="codigo" value="<?php echo $producto->getCodigo(); ?>">
		</br>

		<?php echo isset($errores["nombre"]) ? "*" : "" ?>
		<label for="nombre">Nombre del producto</label>
		<input type="text" name="nombre" value="<?php echo $producto->getNombre(); ?>">
		</br>

		<?php echo isset($errores["precio"]) ? "*" : "" ?>
		<label for="precio">Precio</label>
		<input type="number" name="precio" min="0" step="0.01" value="<?php echo $producto->getPrecio(); ?>">
		</br>

		<?php echo isset($errores["stock"]) ? "*" : "" ?>
		<label for="stock">Stock</label>
		<input type="number" name="stock" value="<?php echo $producto->getStock(); ?>">
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