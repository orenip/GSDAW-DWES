<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comidas</title>
</head>

<body>

    <?php
    // Obtener las categorías de comidas disponibles
    $categories_url = "https://www.themealdb.com/api/json/v1/1/categories.php";
    $categories_data = json_decode(file_get_contents($categories_url), true);

    // Si no se ha selecionado ninguna categoria, mostramos todas
    if (!isset($_GET['category'])) {
        echo "<h2>Selecciona una categoría:</h2>";
        echo "<ul>";
        foreach ($categories_data['categories'] as $category) {
            echo "<li><a href='?category={$category['strCategory']}'>{$category['strCategory']}</a></li>";
        }
        echo "</ul>";
    } else {
        // Si se ha seleccionado una categoría, mostrar las comidas de esa categoría
        $selected_category = $_GET['category'];
        echo "<h2>Comidas en la categoría '{$selected_category}':</h2>";

        // Obtener las comidas de la categoría seleccionada
        $meals_url = "https://www.themealdb.com/api/json/v1/1/filter.php?c=" . urlencode($selected_category);
        $meals_data = json_decode(file_get_contents($meals_url), true);

        // Mostrar la imagen de la categoría
        echo "<img src='{$categories_data['categories'][0]['strCategoryThumb']}' alt='Imagen de la categoría''>";

        // Mostrar el listado de comidas de la categoría seleccionada
        echo "<ul>";
        foreach ($meals_data['meals'] as $meal) {
            echo "<li><a href='?meal={$meal['strMeal']}'>{$meal['strMeal']}</a></li>";
        }
        echo "</ul>";
    }

    // Mostrar los detalles de la comida si se ha seleccionado una
    if (isset($_GET['meal'])) {
        $selected_meal = $_GET['meal'];

        // Obtener los detalles de la comida seleccionada
        $meal_details_url = "https://www.themealdb.com/api/json/v1/1/search.php?s=" . urlencode($selected_meal);
        $meal_details_data = json_decode(file_get_contents($meal_details_url), true);

        // Mostrar la imagen, nombre y las instrucciones de preparación de la comida seleccionada
        $meal_details = $meal_details_data['meals'][0];
        echo "<h2>{$meal_details['strMeal']}</h2>";
        echo "<img src='{$meal_details['strMealThumb']}' alt='Imagen de la comida''>";
        echo "<p>{$meal_details['strInstructions']}</p>";
    }
    ?>

    <p><a href="/">Volver a seleccionar otra categoría</a></p>

</body>

</html>
