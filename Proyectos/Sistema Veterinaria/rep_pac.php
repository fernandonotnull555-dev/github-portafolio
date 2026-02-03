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

        // Definir la consulta SQL para obtener todos los usuarios
        $sql = "SELECT id_paciente, id_prop, Nombre, Especie, Sexo, Peso, Edad FROM pacientes";
        
        // Preparar la consulta
        $stmt = $pdo->prepare($sql);

        // Verificar si la preparación fue exitosa
        if (!$stmt) {
            throw new Exception("Error al preparar la consulta SQL.");
        }

        // Ejecutar la consulta (sin parámetros porque queremos todos los pacientes)
        $stmt->execute();

        // Generar el HTML de salida
        $html = '
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Reporte de Pacientes</title>
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
        
            <h1>Reporte de Todos los pacientes</h1>
            <table>
                <tr>
                    <th>Id paciente</th>
                    <th>Id propietario</th>
                    <th>Nombre</th>
                    <th>Especie</th>
                    <th>Sexo</th>
                    <th>Peso</th>
                    <th>Edad</th>
                </tr>';
    
                


        // Verificar si la consulta devuelve resultados
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $html .= '
                <tr>
                    <td>' . htmlspecialchars($row['id_paciente']) . '</td>
                    <td>' . htmlspecialchars($row['id_prop']) . '</td>
                    <td>' . htmlspecialchars($row['Nombre']) . '</td>
                    <td>' . htmlspecialchars($row['Especie']) . '</td>
                    <td>' . htmlspecialchars($row['Sexo']) . '</td>
                    <td>' . htmlspecialchars($row['Peso']) . '</td>
                    <td>' . htmlspecialchars($row['Edad']) . '</td>

                
                </tr>';
            }
        } else {
            $html .= '<tr><td colspan="4">No se encontraron pacientes en el sistema.</td></tr>';
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
