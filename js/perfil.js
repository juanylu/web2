document.addEventListener('DOMContentLoaded', function () {
    const idUsuario = localStorage.getItem('IdUsuario');

    const formData = new FormData();
    formData.append('obtenerUsuarioPorId', '');
    formData.append('id', idUsuario);

    fetch('/ponclick/Controller/usuarios_controller.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.length > 0) {
                const usuario = data[0];
                document.getElementById('nombre').value = usuario.Nombre;
                document.getElementById('email').value = usuario.Email;
                document.getElementById('fecha_nacimiento').value = usuario.FechaNacimiento;

                if (usuario.FotoPerfil) {
                    document.getElementById('fotoPreview').src = 'data:image/jpeg;base64,' + usuario.FotoPerfil;
                }
            }
        });
});

function mostrarVistaPrevia(event) {
    const reader = new FileReader();
    reader.onload = function () {
        const output = document.getElementById('fotoPreview');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}

function actualizarPerfil() {
    const idUsuario = localStorage.getItem('IdUsuario');

    const nombre = document.getElementById('nombre').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();
    const fechaNacimiento = document.getElementById('fecha_nacimiento').value;
    const fotoPerfilInput = document.querySelector('input[name="foto_perfil"]');
    const fotoPerfil = fotoPerfilInput.files.length > 0 ? fotoPerfilInput.files[0] : null;

    // Validaciones de contraseña (solo si se quiere modificar)
    if (password !== "") {
        if (password.length < 6) {
            alert("La contraseña debe tener al menos 6 caracteres.");
            return;
        }

        if (!/[a-z]/.test(password)) {
            alert("La contraseña debe contener al menos una letra minúscula.");
            return;
        }

        if (!/[A-Z]/.test(password)) {
            alert("La contraseña debe contener al menos una letra mayúscula.");
            return;
        }

        if (!/\d/.test(password)) {
            alert("La contraseña debe contener al menos un número.");
            return;
        }

        if (!/[^A-Za-z0-9]/.test(password)) {
            alert("La contraseña debe contener al menos un carácter especial (como !@#$%).");
            return;
        }
    }

    const formData = new FormData();
    formData.append('modificarUsuario', '');
    formData.append('id', idUsuario);
    formData.append('nombre', nombre);
    formData.append('email', email);
    formData.append('fecha_nacimiento', fechaNacimiento);

    // Solo enviar la contraseña si fue modificada
    if (password !== "") {
        formData.append('password', password);
    }

    // Solo enviar la foto si fue seleccionada una nueva
    if (fotoPerfil) {
        formData.append('foto_perfil', fotoPerfil);
    }

    fetch('/ponclick/Controller/usuarios_controller.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.text())
        .then(res => {
            console.log("Respuesta del backend:", res);
            alert("Perfil actualizado con éxito.");
        })
        .catch(err => {
            console.error("Error:", err);
            alert("Hubo un error al actualizar el perfil.");
        });
}
