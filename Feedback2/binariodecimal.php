<!DOCTYPE html>
<html>
<head>
    <title>Binario a Decimal</title>
</head>
<body>
    <h1>Binario a Decimal</h1>
    <!-- Formulario POST para enviar los datos  -->
    <form method="post">
        <?php
        // Creación de checkbox.
        for ($i = 7; $i >= 0; $i--) {
            echo '<input type="checkbox" id="bit' . $i . '" name="bit' . $i . '" value="1"> ';
        }
        ?>
        <br>
        <input type="submit" name="convertir" value="Convertir">
    </form>

    <?php
    // Procesar el formulario
    if (isset($_POST['convertir'])) {
        $decimal = 0;
        
        // Calcular el valor decimal
        for ($i = 7; $i >= 0; $i--) {
            if (isset($_POST['bit' . $i])) {
                $decimal += pow(2, $i);
            }
        }
        
        echo '<p>Valor decimal es: ' . $decimal . '</p>';
    }
    ?>
</body>
</html>