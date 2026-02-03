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

// Inicializar la variable $stmt para evitar errores
$stmt = null;

// Obtener los valores enviados desde el formulario
$id_cita = isset($_POST['id_cita']) ? $_POST['id_cita'] : ''; 
$id_paciente = isset($_POST['id_paciente']) ? $_POST['id_paciente'] : ''; 

// Verificar si se ha proporcionado un ID de cita o un ID de paciente
if (!empty($id_cita)) {
    // Búsqueda por ID de cita
    echo "Buscando por ID de cita: " . $id_cita . "<br>";
    $sql = "SELECT * FROM citas WHERE id_cita = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_cita); // Vincula el parámetro del ID de cita
} elseif (!empty($id_paciente)) {
    // Búsqueda por ID de paciente
    echo "Buscando por ID de paciente: " . $id_paciente . "<br>";
    $sql = "SELECT * FROM citas WHERE id_paciente = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_paciente); // Vincula el parámetro del ID de paciente
} else {
    echo "No se ha proporcionado ni ID de cita ni ID de paciente.<br>";
    $resultado = false;
}

// Ejecutar la consulta si se preparó una declaración
if ($stmt) {
    $stmt->execute();
    $resultado = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Cita</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e9ecef;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #4CAF50;
        }
        th {
            background-color: #4CAF50;
            color: white;
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
if ($resultado && $resultado->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID cita</th><th>ID paciente</th><th>Fecha cita</th><th>Motivo</th></tr>";
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($fila['id_cita']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['id_paciente']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['fecha_cita']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['motivo']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No se encontraron resultados para los criterios proporcionados.</p>";
}

// Cerrar la conexión
if ($stmt !== null) {
    $stmt->close();
}
$conexion->close();
?>

<!-- Enlace para regresar -->
<button onclick="window.location.href='buscar_cita.html'">Regresar a la búsqueda</button>

</body>
</html>
