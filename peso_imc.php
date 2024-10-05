<!DOCTYPE html>
<html lang="es">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de IMC</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #399999;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            background-color: whitesmoke;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        input[type="number"] {
            padding: 10px;
            width: 100%;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .resultado {
            margin-top: 25px;
        }
        /* Botón regresar */
        .regresar-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #ff6b6b;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .regresar-btn:hover {
            background-color: #e63946;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Calculadora de IMC</h1>
    <form method="POST" action="">
        <label for="peso">Peso (kg):</label>
        <input type="number" name="peso" id="peso" step="0.1" required>

        <label for="altura">Altura (m):</label>
        <input type="number" name="altura" id="altura" step="0.01" required>

        <input type="submit" value="Calcular IMC">
    </form>

    <?php
    // Verificar si el formulario ha sido enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["peso"]) && isset($_POST["altura"])) {
        $peso = floatval($_POST["peso"]); // Convertir peso a número flotante
        $altura = floatval($_POST["altura"]); // Convertir altura a número flotante

        // Calcular el IMC
        $imc = $peso / ($altura * $altura);

        // Clasificación del IMC según la OMS
        if ($imc < 18.5) {
            $clasificacion = "Bajo peso";
        } elseif ($imc >= 18.5 && $imc < 24.9) {
            $clasificacion = "Peso normal";
        } elseif ($imc >= 25 && $imc < 29.9) {
            $clasificacion = "Sobrepeso";
        } else {
            $clasificacion = "Obesidad";
        }

        // Mostrar el resultado del IMC y su clasificación
        echo "<div class='resultado'>";
        echo "<h2>Tu IMC es: " . round($imc, 2) . "</h2>";
        echo "<p>Clasificación: <strong>$clasificacion</strong></p>";
        echo "</div>";
    }
    ?>
</div>

<!-- Botón "Regresar" -->
<button class="regresar-btn" onclick="window.history.back();">Regresar</button>

</body>
</html>
