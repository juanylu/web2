<?php include_once("../incluir/conexion.php"); ?> 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - PonClick</title>
    <link rel="stylesheet" href="../css/estilos.css">
    
</head>
<body>
<?php include_once("../incluir/navbarRL.php"); ?>


    <div class="contenedor">
        <div class="formulario">
            <h2>Crear Cuenta</h2>
            
            <?php if (isset($_GET['mensaje'])): ?>
                <div class="mensaje">
                    <?php echo htmlspecialchars($_GET['mensaje']); ?>
                </div>
            <?php endif; ?>

            <form action="../procesos/registro_procesar.php" method="POST" enctype="multipart/form-data" onsubmit="return validarFormulario()">
                <label style="display:block; margin-top:10px;">Nombre(s):</label>
                <input type="text" name="nombre" placeholder="Nombre completo" required>

                <label style="display:block; margin-top:10px;">Correo electrónico:</label>
                <input type="email" name="email" placeholder="ejemplo@correo.com" required>

                <label style="display:block; margin-top:10px;">Contraseña</label>
                <input type="password" name="password" placeholder="Mantenla segura" required>

                <label style="display:block; margin-top:10px;">Fecha de nacimiento:</label>
                <input type="date" name="fecha_nacimiento" required>

                <label style="display:block; margin-top:10px;">Foto de perfil:</label>
                <input type="file" name="foto_perfil" accept="image/*">
                
                <button type="submit">Registrarse</button>
                <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
            </form>
        </div>
    </div>

    <script>
    function validarFormulario() {
        const email = document.querySelector('input[name="email"]').value;
        const password = document.querySelector('input[name="password"]').value;
        const fechaNacimiento = document.querySelector('input[name="fecha_nacimiento"]').value;

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert("Por favor, ingresa un correo electrónico válido.");
            return false;
        }

        const passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/;
        if (!passwordRegex.test(password)) {
            alert("La contraseña debe tener al menos 6 caracteres, incluyendo 1 número, 1 mayúscula y 1 minúscula.");
            return false;
        }

        const fechaHoy = new Date().toISOString().split("T")[0];
        if (fechaNacimiento > fechaHoy) {
            alert("La fecha de nacimiento no puede ser posterior a hoy.");
            return false;
        }

       
        return true;
    }
    </script>

</body>
</html>
