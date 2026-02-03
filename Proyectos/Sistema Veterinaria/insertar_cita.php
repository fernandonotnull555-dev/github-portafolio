<?php
// Configuración de la base de datos
$servername = "localhost"; // Cambia esto si tu servidor es diferente
$username = "root"; // Reemplaza con tu usuario de MySQL
$password = ""; // Reemplaza con tu contraseña de MySQL
$dbname = "veterinaria"; // Nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$id_paciente = $_POST['id_paciente'];
$fecha_cita = $_POST['fecha_cita'];
$motivo = $_POST['motivo'];

// Preparar y ejecutar la consulta SQL
$sql = "INSERT INTO citas (id_paciente, fecha_cita, motivo) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $id_paciente, $fecha_cita, $motivo);

if ($stmt->execute()) {
    // Obtener el ID de la cita recién insertada
    $id_nueva_cita = $conn->insert_id;
    
    // Mostrar mensaje con el ID de la cita
    echo "<script>alert('Cita insertada correctamente. El ID de la cita es: " . $id_nueva_cita . "');</script>";
    echo "<script>window.location.href = 'menu_insertarbd.html';</script>"; // Redirige después de mostrar el mensaje
} else {
    echo "Error al insertar la cita: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
