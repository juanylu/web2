function iniciarSesion() {
    let nombre = document.getElementById('inputEmail').value;
    let contrasenia = document.getElementById('inputPassword').value;

    let request = new XMLHttpRequest();
    request.open('POST', '/postclick/Controller/usuarios_controller.php');

    let formData = new FormData();
    formData.append('iniciarSesion', '');
    formData.append('email', nombre);
    formData.append('password', contrasenia);

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(request.responseText);

            try {
                let respuesta = JSON.parse(request.responseText);

                if (!respuesta.success) {
                    alert('Credenciales incorrectas');
                    return;
                }

                // Éxito: redirigir al usuario
                window.location.href = "/postclick/pages/publicaciones.php";
            } catch (e) {
                console.error("Error al procesar respuesta JSON:", e);
                alert("Ocurrió un error inesperado.");
            }
        }
    }

    request.send(formData);
}