<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" lang="es">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solución Ejercicio 1</title>
</head>

<body>
    <?php
    // En primer luga iniciamos sesión para ver si ya hay datos guardados
    session_start();

    // Si no está la variable de sesión con los votos la creamos
    if (!isset($_SESSION['candidatos'])) {
        $candidatos = [
            'Juan' => 0,
            'Juana' => 0,
            'Antonio' => 0,
            'Antonia' => 0,
        ];
    } else {
        // Si ya está la variable de sesión la recuperamos
        $candidatos = $_SESSION['candidatos'];
    }

    // Si se ha votado actualizamos la variable con los votos
    if (isset($_POST['votar'])) {

        // Si existe la cookie comprobamos si el voto coincide con el anterior
        if (isset($_COOKIE["ultimoVoto"]) and ($_POST['voto'] == $_COOKIE['ultimoVoto'])) {
                echo "<h2>Error</h2>";
                echo "<p>No puedes repetir el voto hasta que no pasen 30 segundos.</p>";
        } else {
            // Actualizamos los votos
            $votoActual = $_POST['voto'];
            $candidatos[$votoActual]++;

            // Guardamos la cookie durante 30 segundos
            $ultimoVoto = $_POST['voto'];
            setcookie('ultimoVoto', $ultimoVoto, time() + 30);
        }
    }

    // Si se ha reseteado la votación ponemos todo a 0
    if (isset($_POST['reset'])) {
        foreach ($candidatos as $clave => $valor) {
            $candidatos[$clave] = 0;
        }

        // También quitamos la cookie
        setcookie('ultimoVoto', $ultimoVoto, time() - 30);
    }

    // Guardamos los votos en la variable de sesión
    $_SESSION['candidatos'] = $candidatos;

    // Mostramos los resultados de las votaciones
    echo "<h2>Resultados</h2>";
    echo "<ul>";
    foreach ($candidatos as $clave => $valor) {
        echo "<li>" . $clave . ": " . $valor . " votos.</li>";
    }
    echo "</ul>";
    ?>

    <!-- Finalmente mostramos el formulario para votar -->
    <h2>Vota por un candidato</h2>
    <form method="post">
        <select name="voto">
            <?php foreach ($candidatos as $clave => $valor) { ?>
                <option value="<?php echo $clave ?>">
                    <?php echo $clave ?>
                </option>
            <?php } ?>
        </select>
        <input type="submit" name="votar" value="Votar" class="primary">
        <input type="submit" name="reset" value="Reiniciar votación" class="primary">
    </form>
</body>

</html>