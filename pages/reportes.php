<?php
session_start();
error_reporting(0);
ini_set('display_errors', 0);
header('Access-Control-Allow-Origin: *');

require_once __DIR__ . '/../middleware/AdminOnly.php';
require_once __DIR__ . '/../middleware/Middleware.php';
use Middleware\Middleware;
Middleware::resolve('admin');

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes y Consultas - PostClick</title>
    <link rel="stylesheet" href="../css/reportes.css">
</head>
<body>
    <div class="contenedor-reportes">
        
         <?php
         include_once "../includes/navbar.php";
         ?>

            <section class="consultas">
                <h2>Consultar información</h2>

                
                <form class="form-consulta" id="formBuscarUsuario">
                    <input type="text" id="nombreUsuario" placeholder="Buscar usuario por nombre..." required>
                    <button type="submit">Buscar</button>
                </form>

                
                <p id="contador_usuario_publicaciones"></p>
            </section>

                
                <script>
                    document.getElementById('formBuscarUsuario').addEventListener('submit', function(e) {
                        e.preventDefault(); // Evita recargar la página
                        contarPublicacionesPorNombre();
                    });
                </script>

        

        <section class="resumen">
            <h2>Resumen general</h2>
            <div class="tarjetas">
                <div class="tarjeta">
                    <h3>Total de Usuarios</h3>
                    <p id="contador_usuarios"> </p>
                    <button onclick="contarUsuarios()">Contar Usuarios</button>
                </div>
                <div class="tarjeta">
                    <h3>Total de Publicaciones</h3>
                    <p id="contador_publicaciones"></p>
                    <button onclick="contarPublicaciones()">Contar Publicaciones</button>
                    
                </div>
                
                </div>
            </div>
        </section>
    </div>
</body>
<script src="reportes.js"></script>
</html>
