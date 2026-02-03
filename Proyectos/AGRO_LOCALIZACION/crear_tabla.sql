-- Crear la base de datos si no existe
CREATE DATABASE IF NOT EXISTS agro_localizacion;

-- Usar la base de datos
USE agro_localizacion;

-- Crear la tabla lugares
CREATE TABLE IF NOT EXISTS lugares (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    ubicacion POINT NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    SPATIAL INDEX(ubicacion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4; 