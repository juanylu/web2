function mostrarVistaPrevia(event) {
    const reader = new FileReader();
    reader.onload = function () {
        const output = document.getElementById('fotoPreview');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}

function actualizarPerfil() {
    const id = document.getElementById('id').value; // Esto viene de un campo oculto en perfil.php
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
            alert("Debe contener una letra minúscula.");
            return;
        }
        if (!/[A-Z]/.test(password)) {
            alert("Debe contener una letra mayúscula.");
            return;
        }
        if (!/\d/.test(password)) {
            alert("Debe contener un número.");
            return;
        }
        if (!/[^A-Za-z0-9]/.test(password)) {
            alert("Debe contener un carácter especial (!@#$...).");
            return;
        }
    }

    const formData = new FormData();
    formData.append('modificarUsuario', '');
    formData.append('id', id);
    formData.append('nombre', nombre);
    formData.append('email', email);
    formData.append('fecha_nacimiento', fechaNacimiento);

    if (password !== "") {
        formData.append('password', password);
    }

    if (fotoPerfil) {
        formData.append('foto_perfil', fotoPerfil);
    }

    fetch('/postclick/Controller/usuarios_controller.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.text())
        .then(res => {
            console.log("Respuesta del backend:", res);
            alert("Perfil actualizado con éxito.");
            // Opcional: recargar la página para ver los cambios
            location.reload();
        })
        .catch(err => {
            console.error("Error:", err);
            alert("Hubo un error al actualizar el perfil.");
        });
}
