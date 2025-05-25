<?php
session_start(); // Inicia la sesión
session_unset(); // Limpia todas las variables de sesión
session_destroy(); // Destruye la sesión

// Redirige al login o a la página de inicio
header("Location: login.php"); 
exit();
?>
