<!-- Vista para listar los registros de un determinado modelo -->

<!-- Incluimos la cabecera -->
<?php include_once("common/cabecera.php"); ?>
<body>
    <!-- Incluimos el menú --> 
    <?php include_once("common/menu.php"); ?>

	<body>
    <div class="container">
        <form class="form-horizontal" action="index.php" method="post">
            <input type="hidden" name="controlador" value="Equipos">
            <input type="hidden" name="accion" value="editar">

            <div class="form-group">
                <label class="control-label col-sm-2" for="COD_EQUIPO">Codigo</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" name="COD_EQUIPO" value="<?php echo $equipo->getCOD_EQUIPO(); ?>" readonly>
                </div>
            </div>

            <div class="form-group <?php echo isset($errores["NOMBRE_EQUIPO"]) ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2" for="NOMBRE_EQUIPO">NOMBRE_EQUIPO</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="NOMBRE_EQUIPO" value="<?php echo $equipo->getNOMBRE_EQUIPO(); ?>">
                </div>
            </div>

            <div class="form-group <?php echo isset($errores["PRESUPUESTO"]) ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2" for="PRESUPUESTO">PRESUPUESTO</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" name="PRESUPUESTO" value="<?php echo $equipo->getPRESUPUESTO(); ?>">
                </div>
            </div>

            <div class="form-group <?php echo isset($errores["FECHA_FUNDACION"]) ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2" for="FECHA_FUNDACION">FECHA_FUNDACION</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control" name="FECHA_FUNDACION" value="<?php echo $equipo->getFECHA_FUNDACION(); ?>">
                </div>
            </div>

            <div class="form-group <?php echo isset($errores["ZONA"]) ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2" for="ZONA">ZONA</label>
                <div class="col-sm-5">
                    <select class="form-control" name="ZONA">
                        <option value="">Selecciona una Zona</option>
                        <?php
                        foreach ($zonas as $zona) {
                            $selected = ($equipo->getZONA() == $zona['COD_ZONA']) ? 'selected' : '';
                            echo "<option value='" . $zona['COD_ZONA'] . "' $selected>" . $zona['NOMBRE_ZONA'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group <?php echo isset($errores["TITULOS"]) ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2" for="TITULOS">TITULOS</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" name="TITULOS" value="<?php echo $equipo->getTITULOS(); ?>">
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