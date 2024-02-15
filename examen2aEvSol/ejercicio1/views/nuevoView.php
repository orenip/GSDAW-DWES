<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>MVC - Modelo, Vista, Controlador - Jourmoly</title>
</head>

<body>


	<form action="index.php">

		<input type="hidden" name="controlador" value="alumno">
		<input type="hidden" name="accion" value="nuevo">

		<label for="alu_nombre">Nombre</label>
		<input type="text" name="alu_nombre">
		</br>

		<?php echo isset($errores["alumno"]) ? "*" : "" ?>
		<label for="alu_empresa">Empresa</label>
		
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