<?php
$servername = "localhost"; // Cambia esto si tu servidor es diferente
$username = "root"; // Tu nombre de usuario
$password = ""; // Tu contraseña
$dbname = "tienda_artesanal"; // El nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}