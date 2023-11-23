<!-- Vista para listar los registros de un determinado modelo -->

<!-- Incluimos la cabecera -->
<?php include_once("common/cabecera.php"); ?>
<body>
    <!-- Incluimos el menú --> 
    <?php include_once("common/menu.php"); ?>

    <p>Se ha producido un error</p></br>

    <?php
    if (isset($error))
        echo $error . "</br>";
    ?>

    <a href="index.php">Inicio</a>
<!-- Incluimos el pie de página -->
    <?php include_once("common/pie.php"); ?>
</body>

</html>