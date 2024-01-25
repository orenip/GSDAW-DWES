<!-- Vista para listar los registros de un determinado modelo -->

<!-- Incluimos la cabecera -->
<?php include_once("common/cabecera.php"); ?>
<body>
    <!-- Incluimos el menú --> 
    <?php include_once("common/menu.php"); ?>

    <h1>Equipo docente de: <?php echo $desc_curso; ?></h1>

    <p><a href="index.php?controlador=EquipoDocente&accion=nuevo&cod_curso=<?php echo $cod_curso; ?>">Nuevo</a></p>

    <table class="table">
        <tr>
            <th>Profesor</th>
            <th>Materia</th>
            <th>Acción 1</th>
            <th>Acción 2</th>
        </tr>
        <?php
        foreach ($profes as $profe) {
            ?>
            <tr>
                <td>
                    <?php echo $profe->getNombreProfesor(); ?>
                </td>
                <td>
                    <?php echo $profe->getMateriaEquipo(); ?>
                </td>
                <td>
                    <a href="index.php?controlador=EquipoDocente&accion=editar&curso_equipo=<?php echo $profe->getCursoEquipo(); ?>&profesor_equipo=<?php echo $profe->getProfesorEquipo(); ?>">Editar</a>
                </td>
                <td>
                    <a href="index.php?controlador=EquipoDocente&accion=borrar&curso_equipo=<?php echo $profe->getCursoEquipo(); ?>&profesor_equipo=<?php echo $profe->getProfesorEquipo(); ?>">Borrar</a>
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