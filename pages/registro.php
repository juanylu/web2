
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - PostClick</title>
    <link rel="stylesheet" href="../css/estilos.css">
    
</head>
<body>
    <div class="contenedor">
        <div class="formulario">
            <h2>Crear Cuenta</h2>
            
            

            <div class="formDes">
           
                <label style="display:block; margin-top:10px;">Nombre(s):</label>
                <input id="inputNombre" type="text" name="nombre" placeholder="Nombre completo" required>

                <label style="display:block; margin-top:10px;">Correo electrónico:</label>
                <input id="inputEmail" type="email" name="email" placeholder="ejemplo@correo.com" required>

                <label style="display:block; margin-top:10px;">Contraseña</label>
                <input id="inputPassword" type="password" name="password" placeholder="Mantenla segura" required>

                <label style="display:block; margin-top:10px;">Fecha de nacimiento:</label>
                <input id="inputFechaNacimiento" type="date" name="fecha_nacimiento" required>

                <label style="display:block; margin-top:10px;">Foto de perfil:</label>
                <input id="inputFotoPerfil" type="file" name="foto_perfil" accept="image/*">
                
                <button type="button" onclick="validarFormulario()">Registrarse</button>
                <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
            </div>
            
        </div>
    </div>

</body>
<script src="../js/registro.js"></script>

</html>

