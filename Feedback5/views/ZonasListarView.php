<!-- Vista para listar los registros de un determinado modelo -->

<!-- Incluimos la cabecera -->
<?php include_once("common/cabecera.php"); ?>
<body>
    <!-- Incluimos el menú --> 
    <?php include_once("common/menu.php"); ?>

    <table class="table table-striped">
        <tr>
         <th>COD_ZONA</th>
            <th>NOMBRE_ZONA</th>
            <th colspan=2>ACCIONES</th>
        </tr>
        <?php
        foreach ($zonas as $zona) {
            ?>
            <tr>
                <td>
                    <?php echo $zona->getCOD_ZONA() ?>
                </td>
                <td>
                    <?php echo $zona->getNOMBRE_ZONA() ?>
                </td>
                <td>
                    <a class="btn btn-warning" href="index.php?controlador=Zonas&accion=editar&COD_ZONA=<?php echo $zona->getCOD_ZONA() ?>">Editar</a>
                </td>
                <td>
                    <a class='btn btn-danger' href="index.php?controlador=Zonas&accion=borrar&COD_ZONA=<?php echo $zona->getCOD_ZONA() ?>">Borrar</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <a class="btn btn-primary" href="index.php?controlador=Zonas&accion=nuevo">Nuevo</a>
<!-- Incluimos el pie de página -->
<?php include_once("common/pie.php"); ?>
</body>

</html>