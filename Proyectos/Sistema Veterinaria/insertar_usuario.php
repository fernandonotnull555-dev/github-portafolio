<?php
$servidor = 'localhost'; // Nombre del servidor de la base de datos
$usuario = 'root'; // Nombre de usuario para la conexión
$contraseña = ''; // Contraseña para la conexión
$base_de_datos = 'veterinaria'; // Nombre de la base de datos

// Crear conexión a la base de datos
$conexion = new mysqli($servidor, $usuario, $contraseña, $base_de_datos);

// Verificar si hubo un error en la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verificar si se han enviado los datos del formulario
if (isset($_POST['nombre_completo'], $_POST['correo'], $_POST['contrasena'], $_POST['rol_usuario'])) {
    $nombre_completo = $_POST['nombre_completo']; // Captura el nombre completo
    $correo = $_POST['correo']; // Captura el correo
    $contrasena = $_POST['contrasena']; // Captura la contraseña
    $rol_usuario = $_POST['rol_usuario']; // Captura el rol de usuario

    // Consulta SQL para insertar los datos del nuevo usuario
    //$query = "INSERT INTO usuarios (nombre_completo, correo, contraseña, rol_usuario) VALUES (?, ?, ?, ?)";
    $query = "INSERT INTO usuarios (nombre_completo,  correo_electronico, contrasena, rol_usuario) VALUES (?, ?, SHA2(?, 256), ?)";
    // Preparar la consulta
    $stmt = $conexion->prepare($query);

    // Verificar si la preparación fue exitosa
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }

    // Vincular parámetros a la consulta
    $stmt->bind_param('ssss', $nombre_completo, $correo, $contrasena, $rol_usuario);

    // Ejecutar la consulta y verificar si tuvo éxito
    if ($stmt->execute()) {
        echo "Usuario registrado exitosamente.";
    } else {
        echo "Error al registrar el usuario: " . $stmt->error; 
    }

    // Cerrar la declaración
    $stmt->close(); 
} else {
    echo "Por favor, completa todos los campos."; 
}

// Cerrar la conexión a la base de datos
$conexion->close(); 
?>
