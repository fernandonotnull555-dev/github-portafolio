<?php
require_once 'C:/XAMPPP/htdocs/HTMLveterinaria/dompdf/autoload.inc.php'; // Ruta actualizada para DomPDF
use Dompdf\Dompdf;

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

        // Ejecutar la consulta
        $stmt->execute();

        // Inicializar variable para sumar los precios totales
        $total_precio = 0;

        // Generar el HTML de salida con todo el texto en color negro
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
                    background-color: #f8f9fa;
                    padding: 20px;
                    color: #000; /* Texto en negro */
                }
                h1 {
                    color: #000; /* Título en negro */
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
                    color: #000; /* Color negro para todo el texto */
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
                
                // Sumar el precio de cada producto al total
                $total_precio += $row['precio'];
            }

            // Agregar la fila del total al final de la tabla
            $html .= '
                <tr>
                    <td colspan="3" style="text-align:right; font-weight:bold;">Total</td>
                    <td colspan="2" style="text-align:center; font-weight:bold;">$' . number_format($total_precio, 2) . '</td>
                </tr>';
        } else {
            $html .= '<tr><td colspan="5">No se encontraron productos en el sistema.</td></tr>';
        }

        $html .= '
            </table>
        </body>
        </html>';

        // Generar PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();
        
        // Enviar el PDF al navegador
        header("Content-type: application/pdf");
        header("Content-Disposition: inline; filename=reporte_productos.pdf");
        echo $dompdf->output();

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
