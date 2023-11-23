<!-- Vista para listar los registros de un determinado modelo -->

<!-- Incluimos la cabecera -->
<?php include_once("common/cabecera.php"); ?>
<body>
    <!-- Incluimos el menú --> 
    <?php include_once("common/menu.php"); ?>
    
    <table class="table table-striped">
        <tr>
         <th>COD_EQUIPO</th>
            <th>NOMBRE_EQUIPO</th>
            <th>PRESUPUESTO</th>
            <th>FECHA_FUNDACION</th>
            <th>ZONA</th>
            <th>TITULOS</th>
            <th colspan=2>ACCIONES</th>
        </tr>
        <?php
        foreach ($equipos as $equipo) {
            ?>
            <tr>
                <td>
                    <?php echo $equipo->getCOD_EQUIPO() ?>
                </td>
                <td>
                    <?php echo $equipo->getNOMBRE_EQUIPO() ?>
                </td>
                <td>
                    <?php echo $equipo->getPRESUPUESTO() ?>
                </td>
                <td>
                    <?php echo $equipo->getFECHA_FUNDACION() ?>
                </td>   
                <td>
                    <?php echo $equipo->getZONA() ?>
                </td> 
                <td>
                    <?php echo $equipo->getTITULOS() ?>
                </td>
                <td>
                    <a class="btn btn-warning" href="index.php?controlador=Equipos&accion=editar&COD_EQUIPO=<?php echo $equipo->getCOD_EQUIPO() ?>">Editar</a>
                </td>
                <td>
                    <a class="btn btn-danger" href="index.php?controlador=Equipos&accion=borrar&COD_EQUIPO=<?php echo $equipo->getCOD_EQUIPO() ?>">Borrar</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <a class="btn btn-primary" href="index.php?controlador=Equipos&accion=nuevo">Nuevo</a>
<!-- Incluimos el pie de página -->
<?php include_once("common/pie.php"); ?>
</body>

</html>