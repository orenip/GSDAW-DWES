<!DOCTYPE html>
<html>

<body>
    <?php
    if (isset($_POST['seleccion'])) {
        # Se ha enviado una jugada
        $seleccion = $_POST['seleccion'];
        echo "<p>Jugador: $seleccion</p>";

        # Array con opciones
        $opciones = array(1 => "Piedra", 2 => "Papel", 3 => "Tijera");
        $aleatorio = rand(1, 3);
        $maquina = $opciones[$aleatorio];
        echo "<p>Máquina: $maquina</p>";

        if ($seleccion == "Piedra") {
            if ($maquina == "Papel") {
                echo "<h1>Has perdido</h1>";
            } elseif ($maquina == "Tijera") {
                echo "<h1>Has ganado</h1>";
            } else {
                echo "<h1>Empate</h1>";
            }
        } elseif ($seleccion == "Papel") {
            if ($maquina == "Tijera") {
                echo "<h1>Has perdido</h1>";
            } elseif ($maquina == "Piedra") {
                echo "<h1>Has ganado</h1>";
            } else {
                echo "<h1>Empate</h1>";
            }
        } else {
            if ($maquina == "Piedra") {
                echo "<h1>Has perdido</h1>";
            } elseif ($maquina == "Papel") {
                echo "<h1>Has ganado</h1>";
            } else {
                echo "<h1>Empate</h1>";
            }
        }

    } else {
    // No se ha enviado formulario (primera ejecución)
    ?>
        <h1>Piedra, papel, tijera</h1>
        <form name="entrada" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="submit" name="seleccion" value="Piedra">
            <input type="submit" name="seleccion" value="Papel">
            <input type="submit" name="seleccion" value="Tijera">
        </form>
    <?php
    }
    ?>
</body>

</html>