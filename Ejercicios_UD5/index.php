<?php
// Importamos las clases necesarias
require_once('JuegoParesNones.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Tutoría 01 - UT05</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="container">
        <h2>Guardar objetos en la sesión - Pares o nones</h2>

        <?php
        // En primer lugar creamos el juego de pares o nones
        $juego = new JuegoParesNones(5);

        // Y lo almacenamos en la sesión (serialización automática)
        session_start();
        $_SESSION['juego'] = $juego;
        ?>

        <form action="jugar.php" method="post">
            <div class="form-group">
                <label for="numero">Elige un número:</label>
                <select name="numero" id="numero">
                    <option selected="selected" value=0>0</option>
                    <?php
                    // Construimos las opciones según el número máximo
                    for ($i = 1; $i <= $juego->getNumeroMaximo(); $i++) {
                        echo "<option value=$i>$i</option>";
                    }
                    ?>
                </select><br>
                <label for="numero">Elige opción:</label>
                <select name="opcion" id="opcion">
                    <option selected="selected" value="P">Pares</option>
                    <option value="N">Nones</option>
                </select>
            </div>
            <button type="submit" class="btn btn-default" value="jugar">Jugar</button>
        </form>
    </div>
</body>

</html>