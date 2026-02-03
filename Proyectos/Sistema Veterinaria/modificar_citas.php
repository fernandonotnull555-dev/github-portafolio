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
$id_cita = $_POST['id_cita'];
$id_paciente = $_POST['id_paciente'];
$fecha_cita = $_POST['fecha_cita'];
$motivo = $_POST['motivo'];

// Preparar y ejecutar la consulta SQL
$sql = "UPDATE citas SET id_paciente = ?, fecha_cita = ?, motivo = ? WHERE id_cita = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("issi", $id_paciente, $fecha_cita, $motivo, $id_cita);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo "Cita modificada correctamente.";
    } else {
        echo "No se encontró ninguna cita con ese ID.";
    }
} else {
    echo "Error al modificar la cita: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
