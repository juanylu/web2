<?php
// En el futuro aquí conectamos para traer los datos de la BD.
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
            <form class="form-consulta">
                <input type="text" placeholder="Buscar usuario por nombre..." required>
                <button type="submit">Buscar</button>
            </form>
        </section>

        <section class="resumen">
            <h2>Resumen general</h2>
            <div class="tarjetas">
                <div class="tarjeta">
                    <h3>Total de Usuarios</h3>
                    <p>120</p>
                </div>
                <div class="tarjeta">
                    <h3>Total de Publicaciones</h3>
                    <p>345</p>
                </div>
                
                </div>
            </div>
        </section>
    </div>
</body>
</html>
