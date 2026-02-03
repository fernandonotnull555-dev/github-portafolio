<?php
// Configuración de la base de datos
$servername = "localhost"; // Cambia esto si tu servidor es diferente
$username = "root"; // Cambia si es necesario
$password = ""; // Deja en blanco si no hay contraseña
$dbname = "veterinaria"; // Nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$id_usuario = $_POST['id_usuario'];
$nombre_completo = $_POST['nombre_completo'];
$correo_electronico = $_POST['correo'];
$contrasena = $_POST['contrasena'];
$rol_usuario = $_POST['rol_usuario'];

// Preparar y ejecutar la consulta SQL para modificar el usuario
$sql = "UPDATE usuarios SET nombre_completo = ?, correo_electronico= ?, contrasena = SHA2(?, 256), rol_usuario = ? WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $nombre_completo, $correo_electronico, $contrasena, $rol_usuario, $id_usuario);

if ($stmt->execute()) {
    echo "Usuario modificado correctamente.";
} else {
    echo "Error al modificar el usuario: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
