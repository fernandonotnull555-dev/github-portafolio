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
$id_paciente = $_POST['id_paciente'];
$nombre_completo = $_POST['nombre_completo'];
$telefono = $_POST['telefono'];
$correo_electronico = $_POST['correo_electronico'];

// Preparar y ejecutar la consulta SQL
$sql = "INSERT INTO propietarios (id_paciente, Nombre_Completo, telefono, correo_electronico) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isis", $id_paciente, $nombre_completo, $telefono, $correo_electronico);

if ($stmt->execute()) {
    echo "Propietario insertado correctamente.";
} else {
    echo "Error al insertar el propietario: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
