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
$id_producto = $_POST['id_producto']; // ID del producto, asegurate de tener este campo en tu formulario
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$cantidad_exist = $_POST['existencia']; // Asegúrate de que este campo existe en tu formulario

// Preparar y ejecutar la consulta SQL
$sql = "UPDATE productos SET nombre=?, descripcion=?, precio=?, cantidad_exist=? WHERE id=?"; // Corregido
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdii", $nombre, $descripcion, $precio, $cantidad_exist, $id_producto); // Asegúrate de que los tipos sean correctos

if ($stmt->execute()) {
    echo "Producto modificado correctamente."; // Mensaje de éxito
} else {
    echo "Error al modificar el producto: " . $stmt->error; // Mensaje de error
}

// Cerrar la conexión
$stmt->close();
$conn->close();

// Redirigir a otra página o mostrar un mensaje de éxito
//echo "Producto Actualizado Correctamente";
//header("Location: modificar_bd.html"); // Cambia a la página que desees redirigir
exit;
?>
