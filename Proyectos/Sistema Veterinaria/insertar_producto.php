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
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$cantidad_exist = $_POST['existencia']; // Cambiado a "cantidad_exist"

// Preparar y ejecutar la consulta SQL
$sql = "INSERT INTO productos (nombre, descripcion, precio, cantidad_exist) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdi", $nombre, $descripcion, $precio, $cantidad_exist);

if ($stmt->execute()) {
    // Obtener el ID del producto recién insertado
    $id_nuevo_producto = $conn->insert_id;
    
    // Mostrar mensaje con el ID del producto
    echo "<script>alert('Producto insertado correctamente. El ID del producto es: " . $id_nuevo_producto . "');</script>";
    echo "<script>window.location.href = 'menu_insertarbd.html';</script>"; // Redirige después de mostrar el mensaje
} else {
    echo "Error al insertar el producto: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
