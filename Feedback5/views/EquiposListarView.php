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
         <th>COD_EQUIPO</th>
            <th>NOMBRE_EQUIPO</th>
            <th>PRESUPUESTO</th>
            <th>FECHA_FUNDACION</th>
            <th>ZONA</th>
            <th>TITULOS</th>
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
                    <a href="index.php?controlador=Equipos&accion=editar&COD_EQUIPO=<?php echo $equipo->getCOD_EQUIPO() ?>">Editar</a>
                </td>
                <td>
                    <a href="index.php?controlador=Equipos&accion=borrar&COD_EQUIPO=<?php echo $equipo->getCOD_EQUIPO() ?>">Borrar</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <a href="index.php?controlador=Equipos&accion=nuevo">Nuevo</a>
</body>

</html>