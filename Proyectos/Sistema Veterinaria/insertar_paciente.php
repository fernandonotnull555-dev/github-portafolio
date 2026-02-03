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

// Verificar si ya existe un paciente con el mismo nombre y propietario
$check_duplicate = "SELECT * FROM pacientes WHERE nombre = ? AND id_prop = ?";
$stmt_duplicate = $conn->prepare($check_duplicate);
$stmt_duplicate->bind_param("si", $nombre, $id_prop);
$stmt_duplicate->execute();
$stmt_duplicate->store_result();

if ($stmt_duplicate->num_rows > 0) {
    echo "Error: Ya existe un paciente con el mismo nombre y propietario.";
} else {
    // Preparar y ejecutar la consulta SQL para insertar el paciente
    $sql = "INSERT INTO pacientes (id_prop, nombre, especie, sexo, peso, edad) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssi", $id_prop, $nombre, $especie, $sexo, $peso, $edad); // Asegúrate de que los tipos de datos sean correctos

    if ($stmt->execute()) {
        // Obtener el ID del paciente recién insertado
        $id_nuevo_paciente = $conn->insert_id;
        // Mostrar mensaje con el ID del paciente
        echo "<script>alert('Paciente insertado correctamente. El ID del paciente es: " . $id_nuevo_paciente . "');</script>";
        echo "<script>window.location.href = 'menu_insertarbd.html';</script>"; // Redirige después de mostrar el mensaje
    } else {
        echo "Error al insertar paciente: " . $stmt->error;
    }

    $stmt->close();
}

$stmt_duplicate->close();
$conn->close();
?>
