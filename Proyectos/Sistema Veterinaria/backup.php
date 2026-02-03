<?php
// Configuración de conexión a la base de datos
$host = "localhost";
$usuario = "root";
$contraseña = "";
$base_de_datos = "veterinaria";

// Ruta de mysqldump.exe en XAMPP
$mysqldump = "C:\\XAMPPP\\mysql\\bin\\mysqldump.exe";

// Directorio y nombre del archivo de respaldo
$directorioRespaldo = 'C:\\respaldo_sistema_veterinaria';
$backupFile = $directorioRespaldo . '\\backup_sistema_2' . date('Y-m-d_H-i-s') . '.sql';

// Crear el directorio de respaldo si no existe
if (!file_exists($directorioRespaldo)) {
    mkdir($directorioRespaldo, 0777, true);
}

// Comprobar si ya existe un respaldo y eliminarlo
$archivoAnterior = $directorioRespaldo . '\\backup_sistema.sql';
if (file_exists($archivoAnterior)) {
    unlink($archivoAnterior); // Elimina el archivo anterior
}

// Comando para ejecutar el respaldo
$command = "\"{$mysqldump}\" -h {$host} -u {$usuario} --password=\"{$contraseña}\" {$base_de_datos} > \"{$archivoAnterior}\" 2>&1";

// Ejecutar el comando usando shell_exec
$output = shell_exec($command);

// Verificar si el archivo de respaldo fue creado con datos
if (file_exists($archivoAnterior) && filesize($archivoAnterior) > 0) {
    echo "Copia de respaldo creada exitosamente en: " . $archivoAnterior;
} else {
    echo "Error al crear la copia de respaldo o el archivo está vacío.";
    echo "<pre>" . htmlspecialchars($output) . "</pre>";
}
?>

