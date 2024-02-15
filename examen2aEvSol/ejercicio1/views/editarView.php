<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Practica 6</title>
	<link rel="stylesheet" type="text/css" href="views/css/estilos.css" />  

</head>

<body>


	<form action="index.php">

		<input type="hidden" name="controlador" value="alumno">
		<input type="hidden" name="accion" value="editar">		
		
		<label for="alu_id">ID</label>
		<input type="text" readonly name="alu_id" value="<?php echo $alumno->getId(); ?>">
		</br>

		<?php echo isset($errores["alumno"]) ? "*" : "" ?>
		<label for="alu_nombre">NOMBRE</label>
		<input type="text" name="alu_nombre" value="<?php echo $alumno->getNombre(); ?>">
		</br>


		<?php echo isset($errores["alumno"]) ? "*" : "" ?>
		<label for="art_categoria">empresa</label>
		<select name="alu_empresa">
			<?php
				//importamos La clase de CategoriaModel
				require "models/EmpresaModel.php";
				//creamos una instancia de CategoriaModel
				$emp=new EmpresaModel();

				$resultados=$emp->getAll();
				//recorremos las categorias mostrando al usuario el nombre, pero seleccionando su id

				foreach($resultados as $resultado)
				{
					echo "<option value='" . $resultado->getId() . "'>" . $resultado->getNombre() . "</option>";
					
				}
			
			?>
		</select>
		</br>

		<?php echo isset($errores["alumno"]) ? "*" : "" ?>
		
		<label for="alu_apto">APTO</label>
		<select name="alu_apto">
			<?php
		echo "<option value='0'>0</option>";
		echo "<option value='1'>1</option>";
		
		?>

		</select>
		<input type="submit" name="submit" value="Aceptar">
		
	</form>
	</br>
	<!--recorremos los errores-->
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