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
         <th>COD_JUGADOR</th>
            <th>NOMBRE_JUGADOR</th>
            <th>FECHA_NACIMIENTO</th>
            <th>ESTATURA</th>
            <th>POSICION</th>
            <th>EQUIPO</th>
        </tr>
        <?php
        foreach ($jugadores as $jugador) {
            ?>
            <tr>
                <td>
                    <?php echo $jugador->getCOD_JUGADOR() ?>
                </td>
                <td>
                    <?php echo $jugador->getNOMBRE_JUGADOR() ?>
                </td>
                <td>
                    <?php echo $jugador->getFECHA_NACIMIENTO() ?>
                </td>
                <td>
                    <?php echo $jugador->getESTATURA() ?>
                </td>   
                <td>
                    <?php echo $jugador->getPOSICION() ?>
                </td> 
                <td>
                    <?php echo $jugador->getEQUIPO() ?>
                </td>
                <td>
                    <a href="index.php?controlador=Jugadores&accion=editar&COD_JUGADOR=<?php echo $jugador->getCOD_JUGADOR() ?>">Editar</a>
                </td>
                <td>
                    <a href="index.php?controlador=Jugadores&accion=borrar&COD_JUGADOR=<?php echo $jugador->getCOD_JUGADOR() ?>">Borrar</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <a href="index.php?controlador=Jugadores&accion=nuevo">Nuevo</a>
</body>

</html>