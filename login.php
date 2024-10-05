<?php 
// Configuración de la base de datos
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "clase1"; 

// Crear conexión  
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Inicializar la variable de error
$error = "";

// Capturar los datos enviados por el formulario de login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Asegurarse de que no haya inyección SQL
    $usuario = $conn->real_escape_string($usuario);

    // Query para seleccionar el usuario
    $sql = "SELECT * FROM registro WHERE usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Obtener la fila con los datos del usuario
        $row = $result->fetch_assoc();

        // Verificar la contraseña ingresada directamente sin hash
        if (password_verify($password, $row['contrasena'])) {
            // Contraseña correcta, iniciar sesión
            session_start();
            $_SESSION['usuario'] = $usuario;

            // Redirigir al usuario a la página principal
            header("Location: ejercicios.html");
            exit();
        } else {
            $error = "Contraseña incorrecta."; // Guardar mensaje de error
        }
    } else {
        $error = "Usuario no encontrado."; // Guardar mensaje de error
    }

    // Cerrar la conexión
    $stmt->close();
}

// Cerrar la conexión fuera del bloque POST
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            text-align: left;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error-message {
            color: red;
            margin-bottom: 15px;
        }
        /* Estilo para el mensaje de bienvenida */
        .welcome-message {
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 40px;
            font-weight: bold;
            color: #007bff;
            opacity: 1;
            animation: fadeOut 5s infinite;
        }
        /* Animación de desvanecimiento */
        @keyframes fadeOut {
            0% {
                opacity: 1;
            }
            80% {
                opacity: 0;
            }
            100% {
                display: none;
                opacity: 0;
            }
        }
    </style>


<div class="welcome-message">¡Bienvenid@!</div>
    </style>
</head>
<body>

<div class="login-container">
    <h2>Iniciar Sesión</h2>

    <?php if (!empty($error)) : ?>
        <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" value="<?php echo isset($usuario) ? htmlspecialchars($usuario) : ''; ?>" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Ingresar">
    </form>
</div>



</body>
</html>
