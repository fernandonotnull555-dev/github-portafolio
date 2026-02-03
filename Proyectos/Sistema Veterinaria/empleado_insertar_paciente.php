<?php
// insertar_paciente.php

// Establecer conexión a la base de datos
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
$id_prop = $_POST['id_prop'];
$nombre = $_POST['nombre'];
$especie = $_POST['especie'];
$sexo = $_POST['sexo'];
$peso = $_POST['peso'];
$edad = $_POST['edad'];
$id_cita = $_POST['id_cita']; // Añadimos id_cita del formulario

// Verificar que el id_cita existe en la tabla citas
$query = "SELECT id_cita FROM citas WHERE id_cita = ?";
$stmt_check = $conn->prepare($query);
$stmt_check->bind_param("i", $id_cita);
$stmt_check->execute();
$stmt_check->store_result();

if ($stmt_check->num_rows > 0) {
    // Verificar si ya existe un paciente con el mismo nombre y propietario
    $check_duplicate = "SELECT * FROM pacientes WHERE nombre = ? AND id_prop = ?";
    $stmt_duplicate = $conn->prepare($check_duplicate);
    $stmt_duplicate->bind_param("ss", $nombre, $nombre_propietario);
    $stmt_duplicate->execute();
    $stmt_duplicate->store_result();

    if ($stmt_duplicate->num_rows > 0) {
        echo "Error: Ya existe un paciente con el mismo nombre y propietario.";
    } else {
        // Preparar y ejecutar la consulta SQL para insertar el paciente
        $sql = "INSERT INTO pacientes (id_prop, nombre, especie, sexo, peso, edad, id_cita) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $id_prop, $nombre, $especie, $sexo, $peso, $edad, $id_cita);

        if ($stmt->execute()) {
            echo "Paciente insertado correctamente";
        } else {
            echo "Error al insertar paciente: " . $stmt->error;
        }

        $stmt->close();
    }

    $stmt_duplicate->close();
} else {
    echo "Error: La cita seleccionada no existe.";
}

$stmt_check->close();
$conn->close();
?>
