<?php
// Configuración de la base de datos
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "veterinaria"; 

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$id_prop = isset($_POST['id_prop']) ? $_POST['id_prop'] : null;
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
$especie = isset($_POST['especie']) ? $_POST['especie'] : null;
$sexo = isset($_POST['sexo']) ? $_POST['sexo'] : null;
$peso = isset($_POST['peso']) ? $_POST['peso'] : null;
$edad = isset($_POST['edad']) ? $_POST['edad'] : null;
$id_paciente = isset($_POST['id_paciente']) ? $_POST['id_paciente'] : null;

// Verifica si el valor de sexo se está capturando correctamente
echo "Sexo recibido: " . $sexo . "<br>"; // Para verificar que el valor de sexo llega correctamente

// Verifica que id_prop y otros campos obligatorios no sean nulos
if ($id_prop === null || $id_paciente === null) {
    echo "Error: Los campos 'id_prop' y 'id_paciente' son obligatorios.";
    exit;
}

// Preparar y ejecutar la consulta SQL para modificar el paciente
$sql = "UPDATE pacientes SET id_prop = ?, Nombre = ?, Especie = ?, Sexo = ?, Peso = ?, Edad = ? WHERE id_paciente = ?";
$stmt = $conn->prepare($sql);

// Asegúrate de que los tipos de datos en bind_param sean correctos
$stmt->bind_param("ssssssi", $id_prop, $nombre, $especie, $sexo, $peso, $edad, $id_paciente);

if ($stmt->execute()) {
    echo "Paciente modificado correctamente.";
} else {
    echo "Error al modificar el paciente: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
