<!-- Vista para listar los registros de un determinado modelo -->

<!-- Incluimos la cabecera -->
<?php include_once("common/cabecera.php"); ?>
<body>
    <!-- Incluimos el menú --> 
    <?php include_once("common/menu.php"); ?>

    <p><a href="index.php?controlador=Curso&accion=nuevo">Nuevo</a></p>

    <table class="table">
        <tr>
            <th>Codigo</th>
            <th>Descripción</th>
            <th>Nivel educativo</th>
            <th>Acción 1</th>
            <th>Acción 2</th>
            <th>Acción 3</th>
        </tr>
        <?php
        foreach ($cursos as $curso) {
            ?>
            <tr>
                <td>
                    <?php echo $curso->getCodCurso(); ?>
                </td>
                <td>
                    <?php echo $curso->getDescCurso(); ?>
                </td>
                <td>
                    <?php echo $curso->getDescNIvel(); ?>
                </td>
                <td>
                    <a href="index.php?controlador=Curso&accion=editar&cod_curso=<?php echo $curso->getCodCurso(); ?>">Editar</a>
                </td>
                <td>
                    <a href="index.php?controlador=Curso&accion=borrar&cod_curso=<?php echo $curso->getCodCurso(); ?>">Borrar</a>
                </td>
                <td>
                    <a href="index.php?controlador=EquipoDocente&accion=listarCurso&curso_equipo=<?php echo $curso->getCodCurso(); ?>">Equipo docente</a>
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