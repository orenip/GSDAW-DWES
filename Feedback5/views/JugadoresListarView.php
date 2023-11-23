<!-- Vista para listar los registros de un determinado modelo -->

<!-- Incluimos la cabecera -->
<?php include_once("common/cabecera.php"); ?>
<body>
    <!-- Incluimos el menú --> 
    <?php include_once("common/menu.php"); ?>
<body>
    <table class="table table-striped">
        <tr>
         <th>COD_JUGADOR</th>
            <th>NOMBRE_JUGADOR</th>
            <th>FECHA_NACIMIENTO</th>
            <th>ESTATURA</th>
            <th>POSICION</th>
            <th>EQUIPO</th>
            <th colspan=2>ACCIONES</th>
        </tr>
        <?php
        foreach ($jugadores as $jugador) {
            ?>
            <tr>
                <td>
                    <?php echo $jugador->getCOD_JUGADOR() ?>
                </td>
                <td>
                    <?php echo $jugador->getNOMBRE_JUGADOR() ?>
                </td>
                <td>
                    <?php echo $jugador->getFECHA_NACIMIENTO() ?>
                </td>
                <td>
                    <?php echo $jugador->getESTATURA() ?>
                </td>   
                <td>
                    <?php echo $jugador->getPOSICION() ?>
                </td> 
                <td>
                    <?php echo $jugador->getEQUIPO() ?>
                </td>
                <td>
                    <a class="btn btn-warning" href="index.php?controlador=Jugadores&accion=editar&COD_JUGADOR=<?php echo $jugador->getCOD_JUGADOR() ?>">Editar</a>
                </td>
                <td>
                    <a class="btn btn-danger" href="index.php?controlador=Jugadores&accion=borrar&COD_JUGADOR=<?php echo $jugador->getCOD_JUGADOR() ?>">Borrar</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <a class="btn btn-primary" href="index.php?controlador=Jugadores&accion=nuevo">Nuevo</a>
<!-- Incluimos el pie de página -->
<?php include_once("common/pie.php"); ?>
</body>

</html>