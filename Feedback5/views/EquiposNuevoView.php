<!-- Vista para listar los registros de un determinado modelo -->

<!-- Incluimos la cabecera -->
<?php include_once("common/cabecera.php"); ?>
<body>
    <!-- Incluimos el menú --> 
    <?php include_once("common/menu.php"); ?>
	
	<!-- Formulario para insertar un nuevo item --> 
	<div class="container">
        <form class="form-horizontal" action="index.php" method="post">
            <input type="hidden" name="controlador" value="Equipos">
            <input type="hidden" name="accion" value="nuevo">

            <div class="form-group">
                <label class="control-label col-sm-2" for="COD_EQUIPO">COD_EQUIPO</label>
                <div class="col-sm-5">
                    <?php echo isset($errores["COD_EQUIPO"]) ? '*' : ''; ?>
                    <input type="number" class="form-control" name="COD_EQUIPO">
                </div>
            </div>

            <div class="form-group <?php echo isset($errores["NOMBRE_EQUIPO"]) ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2" for="NOMBRE_EQUIPO">NOMBRE_EQUIPO</label>
                <div class="col-sm-5">
                    <?php echo isset($errores["NOMBRE_EQUIPO"]) ? '*' : ''; ?>
                    <input type="text" class="form-control" name="NOMBRE_EQUIPO">
                </div>
            </div>

            <div class="form-group <?php echo isset($errores["PRESUPUESTO"]) ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2" for="PRESUPUESTO">PRESUPUESTO</label>
                <div class="col-sm-5">
                    <?php echo isset($errores["PRESUPUESTO"]) ? '*' : ''; ?>
                    <input type="number" class="form-control" name="PRESUPUESTO">
                </div>
            </div>

            <div class="form-group <?php echo isset($errores["FECHA_FUNDACION"]) ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2" for="FECHA_FUNDACION">FECHA_FUNDACION</label>
                <div class="col-sm-5">
                    <?php echo isset($errores["FECHA_FUNDACION"]) ? '*' : ''; ?>
                    <input type="date" class="form-control" name="FECHA_FUNDACION">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="ZONA">ZONA</label>
                <div class="col-sm-5">
                    <select class="form-control" name="ZONA">
                        <option value="">Selecciona una Zona</option>
                        <?php
                        foreach ($zonas as $zona) {
                            echo "<option value='" . $zona['COD_ZONA'] . "'>" . $zona['NOMBRE_ZONA'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group <?php echo isset($errores["TITULOS"]) ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2" for="TITULOS">TITULOS</label>
                <div class="col-sm-5">
                    <?php echo isset($errores["TITULOS"]) ? '*' : ''; ?>
                    <input type="number" class="form-control" name="TITULOS">
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
	// Si hay errores se muestran
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