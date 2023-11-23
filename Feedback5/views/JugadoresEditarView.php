<!-- Vista para listar los registros de un determinado modelo -->

<!-- Incluimos la cabecera -->
<?php include_once("common/cabecera.php"); ?>
<body>
    <!-- Incluimos el menú --> 
    <?php include_once("common/menu.php"); ?>
	
	<div class="container">
        <form class="form-horizontal" action="index.php" method="post">
            <input type="hidden" name="controlador" value="Jugadores">
            <input type="hidden" name="accion" value="editar">

            <div class="form-group">
                <label class="control-label col-sm-2" for="COD_JUGADOR">Codigo</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" name="COD_JUGADOR" value="<?php echo $jugador->getCOD_JUGADOR(); ?>" readonly>
                </div>
            </div>

            <div class="form-group <?php echo isset($errores["NOMBRE_JUGADOR"]) ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2" for="NOMBRE_JUGADOR">NOMBRE_JUGADOR</label>
                <div class="col-sm-5">
                    <?php echo isset($errores["NOMBRE_JUGADOR"]) ? '*' : ''; ?>
                    <input type="text" class="form-control" name="NOMBRE_JUGADOR" value="<?php echo $jugador->getNOMBRE_JUGADOR(); ?>">
                </div>
            </div>

            <div class="form-group <?php echo isset($errores["FECHA_NACIMIENTO"]) ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2" for="FECHA_NACIMIENTO">FECHA_NACIMIENTO</label>
                <div class="col-sm-5">
                    <?php echo isset($errores["FECHA_NACIMIENTO"]) ? '*' : ''; ?>
                    <input type="date" class="form-control" name="FECHA_NACIMIENTO" value="<?php echo $jugador->getFECHA_NACIMIENTO(); ?>">
                </div>
            </div>

            <div class="form-group <?php echo isset($errores["ESTATURA"]) ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2" for="ESTATURA">ESTATURA</label>
                <div class="col-sm-5">
                    <?php echo isset($errores["ESTATURA"]) ? '*' : ''; ?>
                    <input type="number" class="form-control" name="ESTATURA" value="<?php echo $jugador->getESTATURA(); ?>">
                </div>
            </div>

            <div class="form-group <?php echo isset($errores["POSICION"]) ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2" for="POSICION">POSICION</label>
                <div class="col-sm-5">
                    <?php echo isset($errores["POSICION"]) ? '*' : ''; ?>
                    <input type="text" class="form-control" name="POSICION" value="<?php echo $jugador->getPOSICION(); ?>">
                </div>
            </div>

            <div class="form-group <?php echo isset($errores["EQUIPO"]) ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2" for="EQUIPO">EQUIPO</label>
                <div class="col-sm-5">
                    <?php echo isset($errores["EQUIPO"]) ? '*' : ''; ?>
                    <select class="form-control" name="EQUIPO">
                        <option value="">Selecciona un equipo</option>
                        <?php
                        foreach ($equipos as $equipo) {
                            $selected = ($jugador->getEQUIPO() == $equipo['COD_EQUIPO']) ? 'selected' : '';
                            echo "<option value='" . $equipo['COD_EQUIPO'] . "' $selected>" . $equipo['NOMBRE_EQUIPO'] . "</option>";
                        }
                        ?>
                    </select>
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