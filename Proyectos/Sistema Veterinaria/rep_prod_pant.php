<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Datos de conexión a la base de datos
    $host = 'localhost';  
    $dbname = 'veterinaria';  
    $username = 'root';   
    $password = '';       

    try {
        // Establecer conexión a la base de datos utilizando PDO
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Definir la consulta SQL para obtener todos los productos
        $sql = "SELECT id, nombre, descripcion, precio, cantidad_exist FROM productos";
        
        // Preparar la consulta
        $stmt = $pdo->prepare($sql);

        // Verificar si la preparación fue exitosa
        if (!$stmt) {
            throw new Exception("Error al preparar la consulta SQL.");
        }

        // Ejecutar la consulta (sin parámetros porque queremos todos los productos)
        $stmt->execute();

        // Generar el HTML de salida
        $html = '
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Reporte de Productos</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f8f9fa; /* Fondo claro */
                    padding: 20px;
                }
                h1 {
                    color: #007BFF;
                    text-align: center;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin: 20px 0;
                }
                th, td {
                    border: 1px solid #ddd;
                    padding: 8px;
                    text-align: center;
                }
                th {
                    background-color: #4CAF50;
                    color: white;
                }
                tr:nth-child(even) {
                    background-color: #f2f2f2;
                }
            </style>
        </head>
        <body>
            <h1>Reporte de Todos los Productos</h1>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Cantidad en Existencia</th>
                </tr>';

        // Verificar si la consulta devuelve resultados
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $html .= '
                <tr>
                    <td>' . htmlspecialchars($row['id']) . '</td>
                    <td>' . htmlspecialchars($row['nombre']) . '</td>
                    <td>' . htmlspecialchars($row['descripcion']) . '</td>
                    <td>$' . number_format($row['precio'], 2) . '</td>
                    <td>' . htmlspecialchars($row['cantidad_exist']) . '</td>
                </tr>';
            }
        } else {
            $html .= '<tr><td colspan="5">No se encontraron productos en el sistema.</td></tr>';
        }

        $html .= '
            </table>
        </body>
        </html>';

        // Mostrar el HTML generado
        echo $html;

    } catch (PDOException $e) {
        // Mostrar error si hay problemas con la conexión a la base de datos
        die("Error al conectar a la base de datos: " . $e->getMessage());
    } catch (Exception $e) {
        // Mostrar cualquier otro error
        die("Error: " . $e->getMessage());
    }
} else {
    // Si no se envió ningún formulario, mostrar mensaje
    echo "Por favor, utiliza el formulario para generar el reporte.";
}
?>
