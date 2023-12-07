<!-- Vista para listar los registros de un determinado modelo -->

<!-- Incluimos la cabecera -->
<?php include_once("common/cabecera.php"); ?>
<body>
    <!-- Incluimos el menú --> 
    <?php include_once("common/menu.php"); ?>

    <p><a href="index.php?controlador=Producto&accion=nuevo">Nuevo</a></p>

    <table class="table">
        <tr>
            <th>Codigo</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Acción 1</th>
            <th>Acción 2</th>
        </tr>
        <?php
        foreach ($productos as $producto) {
            ?>
            <tr>
                <td>
                    <?php echo $producto->getCodigo(); ?>
                </td>
                <td>
                    <?php echo $producto->getNombre(); ?>
                </td>
                <td>
                    <?php echo $producto->getPrecio(); ?>
                </td>
                <td>
                    <?php echo $producto->getStock(); ?>
                </td>
                <td>
                    <a href="index.php?controlador=Producto&accion=editar&codigo=<?php echo $producto->getCodigo(); ?>">Editar</a>
                </td>
                <td>
                    <a href="index.php?controlador=Producto&accion=borrar&codigo=<?php echo $producto->getCodigo(); ?>">Borrar</a>
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