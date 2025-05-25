<?php
session_start();
error_reporting(0);
ini_set('display_errors', 0);
header('Access-Control-Allow-Origin: *');

require_once __DIR__ . '/../middleware/AdminOnly.php';
require_once __DIR__ . '/../middleware/Middleware.php';
use Middleware\Middleware;
Middleware::resolve('admin');

require_once '../Controller/categoriasadmin_controller.php'; // aquí va la lógica
?>

<!DOCTYPE html>
<html>
<head>
    <title>Administrar Categorías</title>
    <link rel="stylesheet" href="../css/categorias.css">
</head>
<body>
    <?php include_once "../includes/navbar.php"; ?>

    <h2>Crear nueva categoría</h2>

    <?php if (!empty($mensaje)) echo "<p>$mensaje</p>"; ?>

    <form method="POST">
        <input type="text" name="nombre" placeholder="Nombre de la categoría" required>
        <button type="submit">Crear</button>
    </form>

    <h3>Categorías existentes:</h3>
    <ul>
        <?php foreach ($categorias as $cat): ?>
            <li><?= htmlspecialchars($cat['nombre']) ?> - <?= $cat['fecha_creacion'] ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
