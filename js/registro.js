function validarFormulario() {
    const nombre = document.getElementById('inputNombre').value.trim();
    const email = document.getElementById('inputEmail').value.trim();
    const password = document.getElementById('inputPassword').value.trim();
    const fechaNacimiento = document.getElementById('inputFechaNacimiento').value;
    const fotoPerfil = document.getElementById('inputFotoPerfil').files[0];

    if (!nombre || !email || !password || !fechaNacimiento || !fotoPerfil) {
        alert("Por favor completa todos los campos.");
        return false;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert("Correo electrónico no válido.");
        return false;
    }

    const passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{6,}$/;
    if (!passwordRegex.test(password)) {
        alert("La contraseña debe tener al menos 6 caracteres, al menos una mayúscula, una minuscula, un numero y un caracter especial...");
        return false;
    }

    const fechaHoy = new Date().toISOString().split("T")[0];
    if (fechaNacimiento > fechaHoy) {
        alert("La fecha de nacimiento no puede ser posterior a hoy.");
        return false;
    }

    insertarUsuario();
}

function insertarUsuario() {
    let request = new XMLHttpRequest();
    request.open('POST', '/ponclick/Controller/usuarios_controller.php');

    let formData = new FormData();
    formData.append('insertarUsuarios', '');
    formData.append('nombre', document.getElementById('inputNombre').value);
    formData.append('email', document.getElementById('inputEmail').value);
    formData.append('password', document.getElementById('inputPassword').value);
    formData.append('fecha_nacimiento', document.getElementById('inputFechaNacimiento').value);
    formData.append('foto_perfil', document.getElementById('inputFotoPerfil').files[0]);

    request.send(formData);

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert('¡Usuario registrado exitosamente!');
            
            document.getElementById('inputNombre').value = '';
            document.getElementById('inputEmail').value = '';
            document.getElementById('inputPassword').value = '';
            document.getElementById('inputFechaNacimiento').value = '';
            document.getElementById('inputFotoPerfil').value = '';

            window.location.href = "/ponclick/pages/login.php";
        }
    }
}
