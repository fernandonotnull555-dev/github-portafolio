<?php
// Configuración de conexión a la base de datos
$servidor = 'localhost'; // Dirección del servidor de la base de datos
$usuario = 'root';       // Nombre de usuario para acceder a la base de datos
$contraseña = '';        // Contraseña para el usuario (dejar vacío si no hay)
$base_de_datos = 'agro_localizacion'; // Nombre de la base de datos a la que se desea conectar

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido al Sistema de Agromercados</title>
    <link rel="icon" type="image/png" href="https://img.icons8.com/color/48/000000/farm.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2e7d32;
            --secondary-color: #1b5e20;
            --text-color: #333;
            --background-color: #f1f8e9;
            --card-background: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            line-height: 1.6;
        }

        .welcome-container {
            text-align: center;
            padding: 40px;
            background-color: var(--card-background);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
            transform: translateY(0);
            transition: transform 0.3s ease;
        }

        .welcome-container:hover {
            transform: translateY(-5px);
        }

        .welcome-container h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            color: var(--primary-color);
            font-weight: 600;
        }

        .welcome-container p {
            font-size: 1.1em;
            margin-bottom: 25px;
            color: var(--text-color);
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }

        .feature-item {
            padding: 20px;
            background-color: var(--background-color);
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .feature-item:hover {
            transform: scale(1.05);
        }

        .btn-container {
            margin-top: 30px;
        }

        .btn {
            padding: 15px 40px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 1.1em;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(46, 125, 50, 0.3);
        }

        .btn:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(46, 125, 50, 0.4);
        }

        @media (max-width: 768px) {
            .welcome-container {
                padding: 30px 20px;
            }

            .welcome-container h1 {
                font-size: 2em;
            }

            .features {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="welcome-container">
        <h1>Bienvenido al Sistema de Agromercados</h1>
        <p>Descubre los mejores agromercados en tu zona, conoce los productos disponibles, horarios de atención y más.</p>
        
        <div class="features">
            <div class="feature-item">
                <h3>Geolocalización</h3>
                <p>Encuentra los agromercados más cercanos a tu ubicación</p>
            </div>
            <div class="feature-item">
                <h3>Productos Frescos</h3>
                <p>Accede a información sobre productos disponibles y precios</p>
            </div>
            <div class="feature-item">
                <h3>Horarios</h3>
                <p>Conoce los horarios de atención de cada establecimiento</p>
            </div>
        </div>

        <div class="btn-container">
            <a href="login_agro.html" class="btn">Entrar al Sistema</a>
        </div>
    </div>
</body>

</html>
