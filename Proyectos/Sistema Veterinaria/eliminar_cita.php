<?php
// Configuración de conexión a la base de datos
$host = "localhost"; 
$usuario = "root";   
$contraseña = "";   
$base_de_datos = "veterinaria"; 

// Crear conexión
$conexion = new mysqli($host, $usuario, $contraseña, $base_de_datos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener el ID de la cita enviado desde el formulario
$id_cita = isset($_POST['id_cita']) ? $_POST['id_cita'] : '';

if (!empty($id_cita)) {
    // Primero, actualizar el id_cita en la tabla pacientes a NULL
    $sql_update_pacientes = "UPDATE pacientes SET id_cita = NULL WHERE id_cita = ?";
    $stmt_pacientes = $conexion->prepare($sql_update_pacientes);
    $stmt_pacientes->bind_param("i", $id_cita);
    $stmt_pacientes->execute();
    $stmt_pacientes->close();

    // Ahora eliminar la cita
    $sql = "DELETE FROM citas WHERE id_cita = ?";
    $stmt = $conexion->prepare($sql); // Prepara la consulta
    $stmt->bind_param("i", $id_cita); // Vincula el parámetro

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Verifica si se eliminó alguna fila
        if ($stmt->affected_rows > 0) {
            // Redirigir a menu_eliminar.html si la cita se eliminó con éxito
            header("Location: menu_eliminar.html");
            exit; // Asegúrate de salir después de la redirección
        } else {
            echo "<p>No se encontró ninguna cita con ese ID.</p>";
        }
    } else {
        echo "<p>Error al eliminar la cita: " . $conexion->error . "</p>";
    }

    // Cerrar la declaración
    $stmt->close();
} else {
    echo "<p>Por favor, ingrese un ID de cita válido.</p>";
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>

