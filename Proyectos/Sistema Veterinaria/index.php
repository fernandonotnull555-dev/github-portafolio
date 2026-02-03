<?php
// Configuración de conexión a la base de datos
$servidor = 'localhost'; // Dirección del servidor de la base de datos
$usuario = 'root';       // Nombre de usuario para acceder a la base de datos
$contraseña = '';        // Contraseña para el usuario (dejar vacío si no hay)
$base_de_datos = 'veterinaria'; // Nombre de la base de datos a la que se desea conectar

// Creación de una nueva conexión a la base de datos usando mysqli
$conexion = new mysqli($servidor, $usuario, $contraseña, $base_de_datos);

// Verificación de si la conexión fue exitosa
if ($conexion->connect_error) {
    // Si hay un error en la conexión, se detiene la ejecución y se muestra un mensaje de error
    die("Error de conexión: " . $conexion->connect_error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> <!-- Establece la codificación de caracteres del documento -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsivo para dispositivos móviles -->
    <title>Pantalla de Bienvenida - Veterinaria</title> <!-- Título de la pestaña del navegador -->
    <style>
        /* Estilos CSS para el cuerpo de la página */
        body {
            font-family: Arial, sans-serif; /* Tipo de fuente */
            background-color: #e9ecef; /* Color de fondo de la página */
            color: #343a40; /* Color del texto */
            display: flex; /* Utiliza Flexbox para centrar el contenido */
            flex-direction: column; /* Organiza los elementos en columna */
            justify-content: center; /* Centra verticalmente el contenido */
            align-items: center; /* Centra horizontalmente el contenido */
            height: 100vh; /* Altura total de la ventana del navegador */
            margin: 0; /* Elimina el margen por defecto */
        }
        /* Estilos para el encabezado */
        h1 {
            margin-bottom: 20px; /* Espacio debajo del encabezado */
            color: #5cb85c; /* Color verde para el encabezado */
        }
        /* Estilos para los enlaces */
        a {
            text-decoration: none; /* Elimina el subrayado del enlace */
            color: white; /* Color del texto del enlace */
            background-color: #5cb85c; /* Color de fondo del botón */
            padding: 10px 20px; /* Espaciado interno del botón */
            border-radius: 5px; /* Bordes redondeados del botón */
            transition: background-color 0.3s; /* Suaviza la transición del color de fondo */
        }
        /* Estilos para el efecto hover del enlace */
        a:hover {
            background-color: #4cae4c; /* Cambia el color de fondo al pasar el mouse */
        }
        /* Estilos para el contenedor principal */
        .container {
            text-align: center; /* Centra el texto dentro del contenedor */
            padding: 20px; /* Espaciado interno del contenedor */
            background: white; /* Color de fondo del contenedor */
            border-radius: 10px; /* Bordes redondeados del contenedor */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sombra para dar profundidad */
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Bienvenido/as</h1> <!-- Título principal de la página -->
    <p>Bienvenido/as a la base de datos de Veterinaria "La Mascota".</p> <!-- Mensaje de bienvenida adicional -->
    <a href="login.html">Ir a Login</a> <!-- Enlace a la página de inicio de sesión -->
</div>

<?php
$conexion->close(); // Cierre de la conexión a la base de datos
?>

</body>
</html>
