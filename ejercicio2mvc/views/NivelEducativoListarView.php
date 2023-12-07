<!-- Vista para listar los registros de un determinado modelo -->

<!-- Incluimos la cabecera -->
<?php include_once("common/cabecera.php"); ?>
<body>
    <!-- Incluimos el menú --> 
    <?php include_once("common/menu.php"); ?>

    <p><a href="index.php?controlador=NivelEducativo&accion=nuevo">Nuevo</a></p>

    <table class="table">
        <tr>
            <th>Codigo</th>
            <th>Descripción</th>
            <th>Acción 1</th>
            <th>Acción 2</th>
        </tr>
        <?php
        foreach ($niveles as $nivel) {
            ?>
            <tr>
                <td>
                    <?php echo $nivel->getCodNivel(); ?>
                </td>
                <td>
                    <?php echo $nivel->getDescNivel(); ?>
                </td>
                <td>
                    <a href="index.php?controlador=NivelEducativo&accion=editar&cod_nivel=<?php echo $nivel->getCodNivel(); ?>">Editar</a>
                </td>
                <td>
                    <a href="index.php?controlador=NivelEducativo&accion=borrar&cod_nivel=<?php echo $nivel->getCodNivel(); ?>">Borrar</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>

    <!-- Incluimos el pie de página -->
    <?php include_once("common/pie.php"); ?>
</body>

</html>