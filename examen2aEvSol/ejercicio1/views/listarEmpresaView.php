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
            
        </tr>
        <?php
        foreach ($empresas as $empresa) {
        ?>
        <tr>
            
            <td><?php echo $empresa->getNombre()?></td>            
            <td><a href="index.php?controlador=empresa&accion=editar&emp_id=<?php echo $empresa->getId() ?>">Editar</a>
            </td>
            <td><a href="index.php?controlador=empresa&accion=borrar&emp_id=<?php echo $empresa->getId() ?>">Borrar</a>
            </td>
            <td><a href="index.php?controlador=empresa&accion=calificar&emp_id=<?php echo $empresa->getId() ?>">Calificar</a>
            </td>

        </tr>
        <?php
        }
        ?>
    </table>
    <?php include_once("common/pie.php"); ?>
</body>

</html>