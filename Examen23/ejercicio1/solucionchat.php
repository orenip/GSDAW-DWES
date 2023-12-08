<?php
session_start();

// Inicializar la estructura de datos si no existe
if (!isset($_SESSION['votos'])) {
    $_SESSION['votos'] = array();
}

// Verificar si se ha hecho clic en el botón de votar
if (isset($_POST['votar'])) {
    // Obtener el ID de la persona votada
    $voto = $_POST['persona'];

    // Verificar si ya se ha votado a la misma persona en los últimos 30 segundos usando una cookie
    if (isset($_COOKIE['ultimo_voto']) && ($_COOKIE['ultimo_voto'] == $voto) && (time() - $_COOKIE['tiempo_voto'] < 30)) {
        echo "Solo puedes votar a la misma persona una vez cada 30 segundos.";
    } else {
        // Incrementar el contador de votos para la persona seleccionada
        $_SESSION['votos'][$voto] = isset($_SESSION['votos'][$voto]) ? $_SESSION['votos'][$voto] + 1 : 1;

        // Actualizar la cookie del último voto
        setcookie('ultimo_voto', $voto, time() + 30); // Cookie válida por 30 segundos
        setcookie('tiempo_voto', time(), time() + 30); // Cookie válida por 30 segundos
    }
}

// Verificar si se ha hecho clic en el botón de reiniciar votación
if (isset($_POST['reiniciar'])) {
    // Eliminar las cookies y reiniciar la sesión
    setcookie('ultimo_voto', '', time() - 3600); // Eliminar la cookie
    setcookie('tiempo_voto', '', time() - 3600); // Eliminar la cookie
    session_unset();
    session_destroy(); // Destruir completamente la sesión
}

// Lista de personas para votar
$personas = array("Persona 1", "Persona 2", "Persona 3", "Persona 4");

// Mostrar la lista de personas para votar y los resultados de la votación
?>
<form method="post" action="">
    <label for="persona">Selecciona una persona para votar:</label>
    <select name="persona" id="persona">
        <?php
        foreach ($personas as $key => $persona) {
            echo "<option value=\"$key\">$persona</option>";
        }
        ?>
    </select>
    <button type="submit" name="votar">Votar</button>

    <?php if (!empty($_SESSION['votos'])) : ?>
        <h2>Resultados de la votación:</h2>
        <?php foreach ($_SESSION['votos'] as $key => $votos) : ?>
            <p><?php echo $personas[$key] . ": " . $votos . " votos"; ?></p>
        <?php endforeach; ?>
    <?php endif; ?>

    <button type="submit" name="reiniciar">Reiniciar votación</button>
</form>
