<!-- Vista para listar los registros de un determinado modelo -->

<!-- Incluimos la cabecera -->
<?php include_once("common/cabecera.php"); ?>
<body>
    <!-- Incluimos el menú --> 
    <?php include_once("common/menu.php"); ?>
	<!-- Formulario para insertar un nuevo item --> 
	<div class="container">
        <form class="form-horizontal" action="index.php" method="post">
            <input type="hidden" name="controlador" value="Jugadores">
            <input type="hidden" name="accion" value="nuevo">

            <div class="form-group">
                <label class="control-label col-sm-2" for="COD_JUGADOR">COD_JUGADOR</label>
                <div class="col-sm-5">
                    <?php echo isset($errores["COD_JUGADOR"]) ? '*' : ''; ?>
                    <input type="number" class="form-control" name="COD_JUGADOR">
                </div>
            </div>

            <div class="form-group <?php echo isset($errores["NOMBRE_JUGADOR"]) ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2" for="NOMBRE_JUGADOR">NOMBRE_JUGADOR</label>
                <div class="col-sm-5">
                    <?php echo isset($errores["NOMBRE_JUGADOR"]) ? '*' : ''; ?>
                    <input type="text" class="form-control" name="NOMBRE_JUGADOR">
                </div>
            </div>

            <div class="form-group <?php echo isset($errores["FECHA_NACIMIENTO"]) ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2" for="FECHA_NACIMIENTO">FECHA_NACIMIENTO</label>
                <div class="col-sm-5">
                    <?php echo isset($errores["FECHA_NACIMIENTO"]) ? '*' : ''; ?>
                    <input type="date" class="form-control" name="FECHA_NACIMIENTO">
                </div>
            </div>

            <div class="form-group <?php echo isset($errores["ESTATURA"]) ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2" for="ESTATURA">ESTATURA</label>
                <div class="col-sm-5">
                    <?php echo isset($errores["ESTATURA"]) ? '*' : ''; ?>
                    <input type="number" class="form-control" name="ESTATURA">
                </div>
            </div>

            <div class="form-group <?php echo isset($errores["POSICION"]) ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2" for="POSICION">POSICION</label>
                <div class="col-sm-5">
                    <?php echo isset($errores["POSICION"]) ? '*' : ''; ?>
                    <input type="text" class="form-control" name="POSICION">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="EQUIPO">EQUIPO</label>
                <div class="col-sm-5">
                    <select class="form-control" name="EQUIPO">
                        <option value="">Selecciona un Equipo</option>
                        <?php
                        foreach ($equipos as $equipo) {
                            echo "<option value='" . $equipo['COD_EQUIPO'] . "'>" . $equipo['NOMBRE_EQUIPO'] . "</option>";
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