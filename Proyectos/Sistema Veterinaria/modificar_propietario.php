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

// Obtener datos del formulario con validaciones básicas
$id_prop = isset($_POST['id_prop']) ? (int)$_POST['id_prop'] : 0;
$id_paciente = isset($_POST['id_paciente']) ? (int)$_POST['id_paciente'] : 0;
$Nombre_Completo = isset($_POST['Nombre_Completo']) ? trim($_POST['Nombre_Completo']) : '';
$telefono = isset($_POST['telefono']) ? (int)$_POST['telefono'] : 0;
$correo_electronico = isset($_POST['correo_electronico']) ? trim($_POST['correo_electronico']) : '';

// Validación de campos vacíos o incorrectos
if ($id_prop > 0 && $id_paciente > 0 && !empty($Nombre_Completo) && $telefono > 0 && !empty($correo_electronico)) {

    // Preparar la consulta SQL
    $sql = "UPDATE propietarios SET id_paciente=?, Nombre_Completo=?, telefono=?, correo_electronico=? WHERE id_prop=?";
    
    // Preparar la sentencia
    if ($stmt = $conn->prepare($sql)) {
        // Enlazar parámetros
        $stmt->bind_param("isisi", $id_paciente, $Nombre_Completo, $telefono, $correo_electronico, $id_prop);
        
        // Ejecutar la sentencia
        if ($stmt->execute()) {
            echo "Propietario modificado correctamente."; // Mensaje de éxito
        } else {
            echo "Error al modificar el propietario: " . $stmt->error; // Mensaje de error
        }
        
        // Cerrar la sentencia
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }
} else {
    echo "Error: Datos inválidos o faltantes.";
}

// Cerrar la conexión
$conn->close();

// Redirigir a otra página o mostrar un mensaje de éxito
//header("Location: modificar_bd.html"); // Cambia a la página que desees redirigir
exit;
?>
