<!-- Vista para listar los registros de un determinado modelo -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>MVC - Modelo, Vista, Controlador - Jourmoly</title>
</head>

<body>
    <table>
        <tr>
         <th>COD_ZONA</th>
            <th>NOMBRE_ZONA</th>
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
                    <a href="index.php?controlador=Zonas&accion=editar&COD_ZONA=<?php echo $zona->getCOD_ZONA() ?>">Editar</a>
                </td>
                <td>
                    <a href="index.php?controlador=Zonas&accion=borrar&COD_ZONA=<?php echo $zona->getCOD_ZONA() ?>">Borrar</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <a href="index.php?controlador=Zonas&accion=nuevo">Nuevo</a>
</body>

</html>