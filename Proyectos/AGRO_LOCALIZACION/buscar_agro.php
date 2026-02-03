<?php
header('Content-Type: application/json');

$host = "localhost"; 
$usuario = "root"; 
$contrasena = ""; 
$base_datos = "agro_localizacion";

$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

if ($conexion->connect_error) {
    die(json_encode([
        "estado" => "error",
        "mensaje" => "Error de conexión: " . $conexion->connect_error
    ]));
}

$nombreLugar = isset($_GET['nombre_agro']) ? $_GET['nombre_agro'] : '';

if ($nombreLugar == '') {
    die(json_encode([
        "estado" => "error",
        "mensaje" => "Debe proporcionar el nombre del agromercado."
    ]));
}

$query = "SELECT nombre, ST_AsText(ubicacion) AS ubicacion FROM lugares WHERE nombre LIKE ?";
$stmt = $conexion->prepare($query);
$nombreLugarLike = "%" . $nombreLugar . "%";
$stmt->bind_param("s", $nombreLugarLike);
$stmt->execute();
$resultado = $stmt->get_result();

$lugares = [];
while ($fila = $resultado->fetch_assoc()) {
    preg_match('/POINT\((-?\d+\.\d+) (-?\d+\.\d+)\)/', $fila['ubicacion'], $coordenadas);
    if ($coordenadas) {
        $lugares[] = [
            'nombre' => $fila['nombre'],
            'latitud' => floatval($coordenadas[2]),
            'longitud' => floatval($coordenadas[1])
        ];
    }
}

$stmt->close();
$conexion->close();

echo json_encode([
    "estado" => "ok",
    "lugares" => $lugares
]);
?>

