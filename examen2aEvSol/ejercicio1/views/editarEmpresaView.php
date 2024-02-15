<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Practica 6</title>
	<link rel="stylesheet" type="text/css" href="views/css/estilos.css" />  

</head>

<body>


	<form action="index.php">

		<input type="hidden" name="controlador" value="empresa">
		<input type="hidden" name="accion" value="editar">		
		<!--ponemos un readonly para que no se pueda coambiar el id-->
		<label for="emp_id">ID</label>
		<input type="text" readonly name="emp_id" value="<?php echo $empresa->getId(); ?>">
		</br>

		<?php echo isset($errores["empresa"]) ? "*" : "" ?>
		<label for="emp_nombre">NOMBRE</label>
		<input type="text" name="emp_nombre" value="<?php echo $empresa->getNombre(); ?>">
		</br>
		
		<input type="submit" name="submit" value="Aceptar">
		
	</form>
	</br>
	<!--aqui recorremos todos los errores-->
	<?php
    if (isset($errores)):
	    foreach ($errores as $key => $error):
		    echo $error . "</br>";
	    endforeach;
    endif;
    ?>

<?php include_once("common/pie.php"); ?>

</body>

</html>