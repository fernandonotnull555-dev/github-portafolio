<?php
// Iniciar sesión
session_start();

// Destruir todas las variables de sesión
session_destroy();

// Redirigir al formulario de login
header("Location: login_agro.html");
exit();  // Asegurarse de que el script no siga ejecutándose
?>
