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

// Obtener el id_prop del formulario
$id_prop = isset($_POST['id_prop']) ? $_POST['id_prop'] : '';

// Preparar y ejecutar la consulta SQL para buscar propietario por id_prop
$sql = "SELECT * FROM propietarios WHERE id_prop = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_prop); // "i" indica que es un entero
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Propietario</title>
    <style>
        body {
            font-family: Arial, sans-serif; /* Tipo de fuente para el cuerpo */
            background-color: #e6f9e6; /* Color de fondo verde claro */
            margin: 0; /* Elimina el margen por defecto */
            padding: 20px; /* Espaciado interno del cuerpo */
        }
        h1 {
            color: #4CAF50; /* Color verde oscuro para el título */
            text-align: center; /* Centra el título */
            margin-bottom: 20px; /* Espacio debajo del título */
        }
        table {
            width: 100%; /* Ancho completo de la tabla */
            border-collapse: collapse; /* Colapsa los bordes de la tabla */
            margin-top: 20px; /* Espacio superior para la tabla */
            background-color: #fff; /* Color de fondo blanco para la tabla */
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* Sombra para dar profundidad */
        }
        th, td {
            padding: 12px; /* Espaciado interno para celdas */
            text-align: left; /* Alineación de texto a la izquierda */
            border-bottom: 1px solid #4CAF50; /* Borde inferior verde para las celdas */
        }
        th {
            background-color: #4CAF50; /* Color de fondo verde para los encabezados */
            color: white; /* Color del texto en los encabezados */
        }
        tr:hover {
            background-color: #f1f1f1; /* Color de fondo al pasar el mouse sobre la fila */
        }
        button {
            padding: 10px 20px; /* Espaciado interno del botón */
            border: none; /* Sin borde */
            border-radius: 4px; /* Bordes redondeados */
            cursor: pointer; /* Cambiar el cursor al pasar sobre el botón */
            background-color: #4CAF50; /* Color de fondo verde */
            color: white; /* Color del texto del botón */
            font-size: 16px; /* Tamaño de fuente */
            transition: background-color 0.3s; /* Transición suave para el cambio de color */
            display: block; /* Hace que el botón ocupe toda la línea */
            width: 100%; /* Ancho completo del botón */
            margin-top: 20px; /* Espacio superior para el botón */
        }
        button:hover {
            background-color: #388E3C; /* Color de fondo al pasar el mouse sobre el botón */
        }
    </style>
</head>
<body>

<h1>Resultados de la Búsqueda de Propietario</h1>

<?php if ($result->num_rows > 0): ?>
    <table>
        <tr>
            <th>ID del Propietario</th>
            <th>Nombre Completo</th>
            <th>Teléfono</th>
            <th>Correo Electrónico</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id_prop']); ?></td>
                <td><?php echo htmlspecialchars($row['Nombre_Completo']); ?></td>
                <td><?php echo htmlspecialchars($row['telefono']); ?></td>
                <td><?php echo htmlspecialchars($row['correo_electronico']); ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>No se encontró ningún propietario con el ID: <?php echo htmlspecialchars($id_prop); ?></p>
<?php endif; ?>

<!-- Botón para regresar -->
<button onclick="window.location.href='buscar_propietario.html'">Regresar a la búsqueda</button>

<?php
// Cerrar la conexión
$stmt->close();
$conn->close();
?>

</body>
</html>
