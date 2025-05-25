<?php
session_start();
include_once "../includes/conexion.php"; 
include_once "../includes/reacciones_model.php";

$conexion = new Connection();
$db = $conexion->connect(); 

if (!isset($_SESSION['usuario_id'])) {
    // header("Location: login.php");
    // exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - PostClick</title>
    <link rel="stylesheet" href="../css/inicio.css">
    <link rel="stylesheet" href="../css/publicaciones.css">
    <link rel="stylesheet" href="../css/filtros.css">
</head>
<body>
    <div class="contenedor-feed">
        <?php include_once "../includes/navbar.php"; ?>

        <!-- Sección de filtros -->
        <section class="filtros-publicaciones" style="padding: 1rem;">
            <select id="filtro-categoria">
                <option value="">Todas las categorías</option>
            </select>

            <select id="filtro-orden">
                <option value="reciente">Más reciente</option>
                <option value="antiguo">Más antiguo</option>
            </select>

            <input type="text" id="filtro-busqueda" placeholder="Buscar...">

            <button id="btn-filtrar">Filtrar</button>
        </section>

        <!-- Sección de publicaciones -->
        <section class="nueva-publicacion">
            <section id="publicaciones" class="publicaciones">
                <!-- Aquí se cargarán las publicaciones -->
            </section>
        </section>
    </div>

    <script src="../js/categorias.js"></script>
    <script src="../js/cargarpublis.js"></script>
    <script src="../js/comentarios.js"></script>
    <script src="../js/reacciones.js"></script>
    <script src="../js/filtros.js"></script>
</body>
</html>

