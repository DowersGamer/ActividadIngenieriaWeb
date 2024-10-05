<!DOCTYPE html>
<html lang="es">
<head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Multiplicar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('https://s0.smartresize.com/wallpaper/831/147/HD-wallpaper-numbers-mathematics.jpg'); /* Reemplaza con la ruta de tu imagen */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            background-color: rgba(255, 255, 255, 1.0); /* Fondo blanco con opacidad */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
        table {
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: center;
            
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
    <h1>Generar Tabla de Multiplicar</h1>
    <form method="POST" action="">
        <label for="numero">Ingrese un número:</label>
        <input type="number" name="numero" id="numero" required>
        <input type="submit" value="Generar Tabla">
    </form>

    <?php
    // Verificar si el usuario ha enviado un número
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["numero"])) {
        $numero = intval($_POST["numero"]); // Convertir a número entero

        // Mostrar la tabla de multiplicar
        echo "<h2>Tabla de multiplicar del número $numero</h2>";
        echo "<table>";
        for ($i = 1; $i <= 10; $i++) {
            $resultado = $numero * $i;
            echo "<tr><td>$numero x $i</td><td>$resultado</td></tr>";
        }
        echo "</table>";
    }
    ?>
</div>
<!-- Botón "Regresar" -->
<button class="regresar-btn" onclick="window.history.back();">Regresar</button>

</body>
</html>
