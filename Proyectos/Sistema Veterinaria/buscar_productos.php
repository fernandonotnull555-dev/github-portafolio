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

// Obtener el ID del usuario enviado desde el formulario
$id = isset($_POST['id']) ? $_POST['id'] : ''; 

// Preparar la consulta SQL para buscar en la tabla 'productos'
$sql = "SELECT * FROM productos WHERE id = ?";
$stmt = $conexion->prepare($sql); // Prepara la consulta
$stmt->bind_param("i", $id); // Vincula el parámetro

// Ejecutar la consulta
$stmt->execute(); // Ejecuta la consulta
$resultado = $stmt->get_result(); // Obtiene el resultado
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Productos</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e9ecef;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse; /* Evitar doble borde */
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            /*border: 1px solid white; /* Cambiar el borde a negro */
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        td.cantidad-exist {
            width: 100px; /* Fija el ancho de la columna cantidad_exist */
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            transition: background-color 0.3s;
            margin-top: 20px;
        }
        button:hover {
            background-color: #388E3C;
        }
    </style>
</head>
<body>

<?php
if ($resultado->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>nombre</th><th>descripcion</th><th>precio</th><th>cantidad_exist</th></tr>"; // Encabezado corregido
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($fila['id']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['nombre']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['descripcion']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['precio']) . "</td>";
        echo "<td class='cantidad-exist'>" . htmlspecialchars($fila['cantidad_exist']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No se encontraron resultados.</p>";
}

// Cerrar la conexión
$stmt->close();
$conexion->close();
?>

<!-- Enlace para regresar -->
<button onclick="window.location.href='buscar_productos.html'">Regresar a la búsqueda</button>

</body>
</html>
