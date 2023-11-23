<!-- Vista para listar los registros de un determinado modelo -->

<!-- Incluimos la cabecera -->
<?php include_once("common/cabecera.php"); ?>
<body>
    <!-- Incluimos el menú --> 
    <?php include_once("common/menu.php"); ?>
    <table class="table table-striped">
        <tr>
         <th>COD_PARTIDO</th>
            <th>FECHA</th>
            <th>COD_EQUIPO1</th>
            <th>COD_EQUIPO2</th>
            <th>PUNTOS_EQUIPO1</th>
            <th>PUNTOS_EQUIPO2</th>
            <th colspan=2>ACCIONES</th>
        </tr>
        <?php
        foreach ($partidos as $partido) {
            ?>
            <tr>
                <td>
                    <?php echo $partido->getCOD_PARTIDO() ?>
                </td>
                <td>
                    <?php echo $partido->getFECHA() ?>
                </td>
                <td>
                    <?php echo $partido->getCOD_EQUIPO1() ?>
                </td>
                <td>
                    <?php echo $partido->getCOD_EQUIPO2() ?>
                </td>   
                <td>
                    <?php echo $partido->getPUNTOS_EQUIPO1() ?>
                </td> 
                <td>
                    <?php echo $partido->getPUNTOS_EQUIPO2() ?>
                </td>
                <td>
                    <a class="btn btn-warning" href="index.php?controlador=Partidos&accion=editar&COD_PARTIDO=<?php echo $partido->getCOD_PARTIDO() ?>">Editar</a>
                </td>
                <td>
                    <a class="btn btn-danger" href="index.php?controlador=Partidos&accion=borrar&COD_PARTIDO=<?php echo $partido->getCOD_PARTIDO() ?>">Borrar</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <a class="btn btn-primary" href="index.php?controlador=Partidos&accion=nuevo">Nuevo</a>
<!-- Incluimos el pie de página -->
<?php include_once("common/pie.php"); ?>
</body>

</html>