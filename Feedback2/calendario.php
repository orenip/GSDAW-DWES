<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario</title>
</head>
<body>
    <h1>Calendario</h1>
    <!-- Formulario POST para enviar los datos  -->
    <div class="formulario">
        <form method="post">
            <label for="anio">Año:</label>
            <input type="text" id="anio" name="anio" placeholder="Introduce un Año" required>
            <br>
            <label for="mes">Mes:</label>
            <input type="text" id="mes" name="mes" placeholder="Mes en Nº" required>
            <br>
            <input type="submit" name="ver" value="Ver Calendario">
        </form>
    </div>
    
    <br>
    <?php
    // Procesar el formulario
    if (isset($_POST['ver'])) {
        $anio = intval($_POST['anio']);
        $mes = intval($_POST['mes']);
        
        // Validación.
        if (!is_numeric($_POST['anio']) || !is_numeric($_POST['mes']) ||
        $anio < 1 || $anio > 9999 || $mes < 1 || $mes > 12) {
        echo '<p>La fecha introducida no es valida.</p>';
    } else {
            // Calcular el primer día de la semana del mes
            $primerDiaMes = date("N", strtotime("$anio-$mes-01"));
            // Nombres de los días de la semana
            $diasSemana = ['L', 'M', 'X', 'J', 'V', 'S', 'D'];
            
            // Crear la tabla HTML para el calendario
            echo '<table border="1">';
            echo '<tr>';
            
            // Mostrar los nombres de los días de la semana
            foreach ($diasSemana as $dia) {
                echo '<th>' . $dia . '</th>';
            }
            
            echo '</tr><tr>';
            
            // Rellenar el calendario
            for ($i = 1; $i < $primerDiaMes; $i++) {
                echo '<td></td>';
            }
            
            $ultimoDiaMes = date("t", strtotime("$anio-$mes-01"));
            
            for ($dia = 1; $dia <= $ultimoDiaMes; $dia++) {
                echo '<td>' . $dia . '</td>';
                
                if (($dia + $primerDiaMes - 1) % 7 == 0) {
                    echo '</tr>';
                    
                    if ($dia != $ultimoDiaMes) {
                        echo '<tr>';
                    }
                }
            }
            
            echo '</tr>';
            echo '</table>';
        }
    }
    ?>
</body>
</html>
