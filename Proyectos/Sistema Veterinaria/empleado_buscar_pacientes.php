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

// Preparar los campos enviados desde el formulario
$id_paciente = isset($_POST['id_paciente']) ? $_POST['id_paciente'] : null;
$id_cita = isset($_POST['id_cita']) ? $_POST['id_cita'] : null;
$id_prop = isset($_POST['id_prop']) ? $_POST['id_prop'] : null;
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
$especie = isset($_POST['especie']) ? $_POST['especie'] : null;
$sexo = isset($_POST['sexo']) ? $_POST['sexo'] : null;
$peso = isset($_POST['peso']) ? $_POST['peso'] : null;
$edad = isset($_POST['edad']) ? $_POST['edad'] : null;

// Construir la consulta SQL dinámicamente
$sql = "SELECT * FROM pacientes WHERE 1=1";
if (!empty($id_paciente)) {
    $sql .= " AND id_paciente = ?";
}
if (!empty($id_cita)) {
    $sql .= " AND id_cita = ?";
}
if (!empty($id_prop)) {
    $sql .= " AND id_prop  ?";
}
if (!empty($nombre)) {
    $sql .= " AND Nombre LIKE ?";
}
if (!empty($especie)) {
    $sql .= " AND Especie LIKE ?";
}
if (!empty($sexo)) {
    $sql .= " AND Sexo = ?";
}
if (!empty($peso)) {
    $sql .= " AND Peso LIKE ?";
}
if (!empty($edad)) {
    $sql .= " AND Edad LIKE ?";
}

$stmt = $conexion->prepare($sql);

// Vincular parámetros dinámicamente
$parametros = [];
$tipos = ""; // Aquí almacenamos los tipos de datos de los parámetros

if (!empty($id_paciente)) {
    $tipos .= "i"; // Tipo entero
    $parametros[] = $id_paciente;
}
if (!empty($id_cita)) {
    $tipos .= "i";
    $parametros[] = $id_cita;
}
if (!empty($nombre_propietario)) {
    $tipos .= "i"; // Tipo string
    $parametros[] =  $id_prop;
}
if (!empty($nombre)) {
    $tipos .= "s";
    $parametros[] = "%" . $nombre . "%";
}
if (!empty($especie)) {
    $tipos .= "s";
    $parametros[] = "%" . $especie . "%";
}
if (!empty($sexo)) {
    $tipos .= "s";
    $parametros[] = $sexo;
}
if (!empty($peso)) {
    $tipos .= "s";
    $parametros[] = "%" . $peso . "%";
}
if (!empty($edad)) {
    $tipos .= "s";
    $parametros[] = "%" . $edad . "%";
}

if (!empty($parametros)) {
    $stmt->bind_param($tipos, ...$parametros); // Vincular los parámetros
}

$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar pacientes</title>
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
if ($resultado->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID del paciente</th><th>ID de la cita</th><th>ID del propietario</th><th>Nombre</th><th>Especie</th><th>Sexo</th><th>Peso</th><th>Edad</th></tr>";
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($fila['id_paciente']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['id_cita']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['id_prop']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['Nombre']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['Especie']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['Sexo']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['Peso']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['Edad']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No se encontraron resultados.</p>";
}

$stmt->close();
$conexion->close();
?>

<!-- Botón para regresar -->
<button onclick="window.location.href='empleado_buscar_pacientes.html'">Regresar a la búsqueda</button>

</body>
</html>
