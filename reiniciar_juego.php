<?php
session_start();
session_destroy(); // Destruir la sesión actual
header("Location: juego_adivinar.php"); // Redirigir de vuelta al juego
exit();
?>
