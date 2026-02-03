<?php
header('Content-Type: application/json');

// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agro_localizacion";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode([
        "estado" => "error",
        "mensaje" => "Error de conexión: " . $conn->connect_error
    ]));
}

// Obtener datos del formulario
$nombre = $_POST['nombre'] ?? '';
$direccion = $_POST['direccion'] ?? '';
$coordenadas = $_POST['coordenadas'] ?? '';

// Validar campos obligatorios
if (!$nombre || !$direccion || !$coordenadas) {
    die(json_encode([
        "estado" => "error",
        "mensaje" => "Datos incompletos"
    ]));
}

// Validar formato de coordenadas con una regex más flexible
if (!preg_match('/^POINT\s*\(\s*(-?\d+(\.\d+)?)\s+(-?\d+(\.\d+)?)\s*\)$/i', $coordenadas)) {
    die(json_encode([
        "estado" => "error",
        "mensaje" => "Formato de coordenadas inválido"
    ]));
}

// Preparar consulta SQL
$sql = "INSERT INTO lugares (nombre, direccion, ubicacion) VALUES (?, ?, ST_GeomFromText(?))";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die(json_encode([
        "estado" => "error",
        "mensaje" => "Error al preparar la consulta: " . $conn->error
    ]));
}

$stmt->bind_param("sss", $nombre, $direccion, $coordenadas);

if ($stmt->execute()) {
    echo json_encode([
        "estado" => "ok",
        "mensaje" => "Agromercado creado correctamente",
        "id" => $conn->insert_id
    ]);
} else {
    echo json_encode([
        "estado" => "error",
        "mensaje" => "Error al crear el agromercado: " . $stmt->error
    ]);
}

$stmt->close();
$conn->close();
?>