<!-- Vista para listar los registros de un determinado modelo -->

<!-- Incluimos la cabecera -->
<?php include_once("common/cabecera.php"); ?>
<body>
    <!-- Incluimos el menú --> 
    <?php include_once("common/menu.php"); ?>

	<div class="container">
        <form class="form-horizontal" action="index.php" method="post">
            <input type="hidden" name="controlador" value="Zonas">
            <input type="hidden" name="accion" value="editar">

            <div class="form-group">
                <label class="control-label col-sm-2" for="COD_ZONA">Codigo</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" name="COD_ZONA" value="<?php echo $zona->getCOD_ZONA(); ?>" readonly>
                </div>
            </div>

            <div class="form-group <?php echo isset($errores["NOMBRE_ZONA"]) ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2" for="NOMBRE_ZONA">NOMBRE_ZONA</label>
                <div class="col-sm-5">
                    <?php echo isset($errores["NOMBRE_ZONA"]) ? '*' : ''; ?>
                    <input type="text" class="form-control" name="NOMBRE_ZONA" value="<?php echo $zona->getNOMBRE_ZONA(); ?>">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-5">
                    <button type="submit" class="btn btn-primary" name="submit">Aceptar</button>
                </div>
            </div>
        </form>
    </div>
	
	<?php
	// Si hay errores los mostramos.
	if (isset($errores)):
		foreach ($errores as $key => $error):
			echo $error . "</br>";
		endforeach;
	endif;
	?>
<!-- Incluimos el pie de página -->
    <?php include_once("common/pie.php"); ?>
</body>

</html>