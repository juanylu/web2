<?php include_once("../incluir/conexion.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PonClick</title>
    <link rel="stylesheet" href="../css/estilos.css">
    
</head>
<body>
<?php include_once("../incluir/navbarRL.php"); ?>



    <div class="contenedor">
        <div class="formulario">
            <h2>Iniciar Sesión</h2>

            <?php if (isset($_GET['mensaje'])): ?>
                <div class="mensaje">
                    <?php echo htmlspecialchars($_GET['mensaje']); ?>
                </div>
            <?php endif; ?>

            <form action="../procesos/login_procesar.php" method="POST">
                <input type="email" name="email" placeholder="Correo electrónico" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <button type="submit">Entrar</button>
                <p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
            </form>
        </div>
    </div>
</body>
</html>