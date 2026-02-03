<?php
class  propietario{

private $conexion;

public function __construct($host = "localhost", $usuario = "root", $contraseña = "", $bd = "veterinaria") {
    $this->conexion = new mysqli($host, $usuario, $contraseña, $bd);
    if ($this->conexion->connect_error) {
        die("Error de conexión: " . $this->conexion->connect_error);
    }
}

public function insertarPropietario($nombre, $apellido, $salario1, $salario2, $comision) {
    $sql = "INSERT INTO empleados (nombre, apellido, salario1, salario2, comision) VALUES (?, ?, ?, ?, ?)";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bind_param("ssddd", $nombre, $apellido, $salario1, $salario2, $comision);
    return $stmt->execute();
}

}

?>