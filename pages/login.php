
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PostClick</title>
    <link rel="stylesheet" href="../css/estilos.css">
    
</head>
<body>
    <div class="contenedor">
        <div class="formulario">
            <h2>Iniciar Sesión</h2>


            <div class="formDes">
                <input id="inputEmail" type="email" name="email" placeholder="Correo electrónico" required>
                <input  id="inputPassword" type="password" name="password" placeholder="Contraseña" required>
                <button onclick="iniciarSesion()">Entrar</button>
                <p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
            </div>
        </div>
    </div>
</body>

<script src="Prueba_InicioSesion.js"></script>
</html>
