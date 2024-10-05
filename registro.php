<?php
// Configuración de la base de datos
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "clase1"; // 

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Capturar los datos enviados por el formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$edad = $_POST['edad'];
$ciudad = $_POST['ciudad'];
$celular = $_POST['celular'];
$usuario = $_POST['usuario'];
$password = $_POST['password'];

// Asegurarse de que no haya inyección SQL
$nombre = $conn->real_escape_string($nombre);
$apellido = $conn->real_escape_string($apellido);
$edad = (int)$conn->real_escape_string($edad); // Asegurarse de que sea un número
$ciudad = $conn->real_escape_string($ciudad);
$celular = $conn->real_escape_string($celular);
$usuario = $conn->real_escape_string($usuario);
$password = password_hash($conn->real_escape_string($password), PASSWORD_BCRYPT); // Encriptar la contraseña

// Query para insertar los datos en la tabla
$sql = "INSERT INTO registro (nombre, apellido, edad, ciudad, celular, usuario, contrasena) VALUES ('$nombre', '$apellido', $edad, '$ciudad', '$celular', '$usuario', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Registro exitoso!";
} else {
    echo "Error al registrar: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
