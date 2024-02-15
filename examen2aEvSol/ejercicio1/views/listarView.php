<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>MVC - Modelo, Vista, Controlador - Jourmoly</title>
</head>

<body>
    <table>
        <tr>
            <th>NOMBRE
            </th>
            <th>EMPRESA
            </th>
            <th>
                APTO
            </th>
        </tr>
        <?php
        foreach ($alumnos as $alumno) {
        ?>
        <tr>
            
            <td><?php echo $alumno->getNombre() ?></td>
            <td><?php echo $alumno->getEmpresa() ?></td>
            <td><?php echo $alumno->getApto() ?></td>
            <td><a href="index.php?controlador=alumno&accion=editar&alu_id=<?php echo $alumno->getId() ?>">Editar</a>
            </td>
            <td><a href="index.php?controlador=alumno&accion=borrar&alu_id=<?php echo $alumno->getId() ?>">Borrar</a>
            </td>

        </tr>
        <?php
        }
        ?>
    </table>
    <?php include_once("common/pie.php"); ?>
</body>

</html>