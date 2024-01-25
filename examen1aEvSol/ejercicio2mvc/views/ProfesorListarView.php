<!-- Vista para listar los registros de un determinado modelo -->

<!-- Incluimos la cabecera -->
<?php include_once("common/cabecera.php"); ?>
<body>
    <!-- Incluimos el menú --> 
    <?php include_once("common/menu.php"); ?>

    <p><a href="index.php?controlador=Profesor&accion=nuevo">Nuevo</a></p>

    <table class="table">
        <tr>
            <th>Codigo</th>
            <th>Nombre profesor</th>
            <th>Acción 1</th>
            <th>Acción 2</th>
        </tr>
        <?php
        foreach ($profes as $profe) {
            ?>
            <tr>
                <td>
                    <?php echo $profe->getCodProfesor(); ?>
                </td>
                <td>
                    <?php echo $profe->getNombreProfesor(); ?>
                </td>
                <td>
                    <a href="index.php?controlador=Profesor&accion=editar&cod_profesor=<?php echo $profe->getCodProfesor(); ?>">Editar</a>
                </td>
                <td>
                    <a href="index.php?controlador=Profesor&accion=borrar&cod_profesor=<?php echo $profe->getCodProfesor(); ?>">Borrar</a>
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