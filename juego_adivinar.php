<?php
session_start();

// Número máximo de intentos
$maxIntentos = 6;

// Verificar si ya hay un mensaje temporal guardado en una cookie
if (isset($_COOKIE['mensaje_final'])) {
    $mensaje_final = $_COOKIE['mensaje_final'];
    setcookie('mensaje_final', '', time() - 3600); // Borrar la cookie
}

// Generar número aleatorio si es la primera vez que se juega
if (!isset($_SESSION['numero_aleatorio'])) {
    $_SESSION['numero_aleatorio'] = rand(1, 20);
    $_SESSION['intentos_restantes'] = $maxIntentos;
    $_SESSION['mensaje'] = '';
    $_SESSION['acertado'] = false; // Indicar si se ha acertado el número
}

// Comprobar si el formulario fue enviado y si la variable 'numero_usuario' está definida
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["numero_usuario"])) {
    $numero_usuario = intval($_POST["numero_usuario"]);
    
    if ($_SESSION['intentos_restantes'] > 0) {
        if ($numero_usuario > $_SESSION['numero_aleatorio']) {
            $_SESSION['mensaje'] = "El número es menor que $numero_usuario.";
        } elseif ($numero_usuario < $_SESSION['numero_aleatorio']) {
            $_SESSION['mensaje'] = "El número es mayor que $numero_usuario.";
        } else {
            // Indicar que se ha acertado el número y mostrar felicitaciones
            $_SESSION['mensaje'] = "¡Felicidades! Adivinaste el número {$_SESSION['numero_aleatorio']}.";
            $_SESSION['acertado'] = true; // Indicar que se ha acertado el número
        }
        $_SESSION['intentos_restantes']--;
    }
    
    // Verificar si se acabaron los intentos
    if ($_SESSION['intentos_restantes'] == 0 && $numero_usuario != $_SESSION['numero_aleatorio']) {
        // Guardar el mensaje en una cookie antes de destruir la sesión
        setcookie('mensaje_final', "¡Lo siento! Se acabaron los intentos. El número correcto era {$_SESSION['numero_aleatorio']}.", time() + 3600);
        session_destroy();
        header("Location: juego_adivinar.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego de Adivinar el Número</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            background-color: white;
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
        .mensaje {
            color: red;
            margin-bottom: 15px;
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
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
</head>
<body>

<div class="container">
    <h1>Adivina el número</h1>
    
    <?php if (isset($_SESSION['mensaje'])): ?>
        <p class="mensaje"><?php echo $_SESSION['mensaje']; ?></p>
        
        <?php if ($_SESSION['acertado']): ?>
            <!-- Mostrar el confeti -->
            <script>
                // Mostrar el confeti al adivinar correctamente
                confetti({
                    particleCount: 300,
                    spread: 100,
                    origin: { y: 0.6 }
                });

                // Redirigir después de 3 segundos y destruir la sesión
                setTimeout(function() {
                    window.location.href = 'reiniciar_juego.php'; // Redirigir a una página que reinicie la sesión
                }, 6000);
            </script>
        <?php endif; ?>
        
    <?php endif; ?>

    <?php if (isset($_SESSION['intentos_restantes']) && $_SESSION['intentos_restantes'] > 0): ?>
        <p>Te quedan <strong><?php echo $_SESSION['intentos_restantes']; ?></strong> intentos.</p>
        <form method="POST" action="">
            <input type="number" name="numero_usuario" min="1" max="20" required>
            <input type="submit" value="Adivinar">
        </form>
    <?php else: ?>
        <form method="POST" action="">
            <input type="submit" value="Reiniciar el juego">
        </form>
    <?php endif; ?>
</div>
<!-- Botón "Regresar" -->
<button class="regresar-btn" onclick="window.history.back();">Regresar</button>

</body>
</html>

