<?php
session_start(); // Iniciar la sesión

// Configuración de la base de datos
$servidor = 'localhost'; 
$usuario = 'root'; 
$contraseña = ''; 
$base_de_datos = 'veterinaria'; 

// Crear la conexión
$conexion = new mysqli($servidor, $usuario, $contraseña, $base_de_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Recibir y sanitizar los datos del formulario
$correo = trim($_POST['correo']); // Sanitizar el correo
$contraseña = trim($_POST['contrasena']); // Sanitizar la contraseña

// Preparar la consulta SQL
$query = "SELECT * FROM usuarios WHERE correo_electronico = ? AND contrasena = SHA2(?, 256)";
$stmt = $conexion->prepare($query);
$stmt->bind_param('ss', $correo, $contraseña);
$stmt->execute();
$resultado = $stmt->get_result();

// Verificar si hay algún resultado (usuario encontrado)
if ($resultado->num_rows > 0) {
    // Inicio de sesión exitoso
    $usuario = $resultado->fetch_assoc(); // Obtener datos del usuario

    $_SESSION['correo'] = $correo; // Guardar el correo en la sesión
    $_SESSION['rol'] = $usuario['rol_usuario']; // Guardar el rol del usuario en la sesión

    // Redirigir según el rol del usuario
    if ($usuario['rol_usuario'] == 'Administrador') {
        header('Location: menu.html'); // Redirigir al menú de administrador
    } else {
        header('Location: menu2.html'); // Redirigir al menú de empleado
    }
    exit(); // Detener la ejecución del script después de la redirección
} else {
    // Si el inicio de sesión falla
    echo "Correo o contraseña incorrectos."; // Mensaje de error
}

// Cerrar la sentencia y la conexión
$stmt->close();
$conexion->close();
?>
