<!-- Vista para listar los registros de un determinado modelo -->

<!-- Incluimos la cabecera -->
<?php include_once("common/cabecera.php"); ?>
<body>
    <!-- Incluimos el menú --> 
    <?php include_once("common/menu.php"); ?>
	<div class="container">
        <form class="form-horizontal" action="index.php" method="post">
            <input type="hidden" name="controlador" value="Partidos">
            <input type="hidden" name="accion" value="editar">

            <div class="form-group">
                <label class="control-label col-sm-2" for="COD_PARTIDO">COD_PARTIDO</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" name="COD_PARTIDO" value="<?php echo $partido->getCOD_PARTIDO(); ?>" readonly>
                </div>
            </div>

            <div class="form-group <?php echo isset($errores["FECHA"]) ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2" for="FECHA">FECHA</label>
                <div class="col-sm-5">
                    <?php echo isset($errores["FECHA"]) ? '*' : ''; ?>
                    <input type="date" class="form-control" name="FECHA" value="<?php echo $partido->getFECHA(); ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="COD_EQUIPO1">COD_EQUIPO1</label>
                <div class="col-sm-5">
                    <select class="form-control" name="COD_EQUIPO1">
                        <option value="">Selecciona un equipo</option>
                        <?php
                        foreach ($equipos as $equipo) {
                            $selected = ($partido->getCOD_EQUIPO1() == $equipo['COD_EQUIPO']) ? 'selected' : '';
                            echo "<option value='" . $equipo['COD_EQUIPO'] . "' $selected>" . $equipo['NOMBRE_EQUIPO'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="COD_EQUIPO2">COD_EQUIPO2</label>
                <div class="col-sm-5">
                    <select class="form-control" name="COD_EQUIPO2">
                        <option value="">Selecciona un equipo</option>
                        <?php
                        foreach ($equipos as $equipo) {
                            $selected = ($partido->getCOD_EQUIPO2() == $equipo['COD_EQUIPO']) ? 'selected' : '';
                            echo "<option value='" . $equipo['COD_EQUIPO'] . "' $selected>" . $equipo['NOMBRE_EQUIPO'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group <?php echo isset($errores["PUNTOS_EQUIPO1"]) ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2" for="PUNTOS_EQUIPO1">PUNTOS_EQUIPO1</label>
                <div class="col-sm-5">
                    <?php echo isset($errores["PUNTOS_EQUIPO1"]) ? '*' : ''; ?>
                    <input type="number" class="form-control" name="PUNTOS_EQUIPO1" value="<?php echo $partido->getPUNTOS_EQUIPO1(); ?>">
                </div>
            </div>

            <div class="form-group <?php echo isset($errores["PUNTOS_EQUIPO2"]) ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2" for="PUNTOS_EQUIPO2">PUNTOS_EQUIPO2</label>
                <div class="col-sm-5">
                    <?php echo isset($errores["PUNTOS_EQUIPO2"]) ? '*' : ''; ?>
                    <input type="number" class="form-control" name="PUNTOS_EQUIPO2" value="<?php echo $partido->getPUNTOS_EQUIPO2(); ?>">
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