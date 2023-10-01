<!DOCTYPE html>
<html>
<head>
    <title>Decimal a Binario</title>
</head>
<body>
    <h1>Decimal a Binario</h1>
    <!-- Formulario POST para enviar los datos  -->
    <form method="post">
        <label for="numero">Introduce un número decimal:</label>
        <input type="text" id="numero" name="numero" required>
        <input type="submit" name="convertir" value="Convertir">
    </form>

    <?php
    // Procesar el formulario
    if (isset($_POST['convertir'])) {
        $decimal = intval($_POST['numero']);

        if (!is_numeric($_POST['numero']) || $decimal < 0) {
            echo '<p>El número introducido no es válido.</p>';
        } else {
            $binario = decbin($decimal); // Utiliza la función decbin para convertir decimal a binario

            // Crear checkbox
            echo '<p>La representación binaria es:</p>';
            foreach (str_split($binario) as $bit) {
                echo '<input type="checkbox" ' . ($bit == '1' ? 'checked' : '') . '>';
            }
        }
    }
?>
</body>
</html>