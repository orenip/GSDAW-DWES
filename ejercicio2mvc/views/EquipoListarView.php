<!-- Vista para listar los registros de un determinado modelo -->

<!-- Incluimos la cabecera -->
<?php include_once("common/cabecera.php"); ?>
<body>
    <!-- Incluimos el menú --> 
    <?php include_once("common/menu.php"); ?>

    <p><a href="index.php?controlador=Equipo&accion=nuevo">Nuevo</a></p>

    <table class="table">
        <tr>
            <th>Profesor</th>
            <th>Materia</th>
            <th>Editar</th>
            <th>Borrar</th>
        </tr>
        <?php
        
        foreach ($equipos as $equipo) {
            ?>
            <tr>
                <td>
                    <?php echo $equipo->getDescProfesor(); ?>
                </td>
                <td>
                    <?php echo $equipo->getMateriaEquipo(); ?>
                </td>
                <td>
                    <a href="index.php?controlador=Equipo&accion=editar&curso_equipo=<?php echo $equipo->getCursoEquipo(); ?>">Editar</a>
                </td>
                <td>
                    <a href="index.php?controlador=Equipo&accion=borrar&curso_equipo=<?php echo $equipo->getCursoEquipo(); ?>">Borrar</a>
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