
let idUsuarioActual;  
let idUsuarioConversacion;
let nombreUsuarioConversacion;
let actualiza = false;

setInterval(function () {
    if (!actualiza) return;

    let request = new XMLHttpRequest();
    request.open('POST', '/postclick/Controller/chat_controller.php');

    let formData = new FormData();
    formData.append('obtenerMensajes', '');
    formData.append('idSegundoUsuario', idUsuarioConversacion);

    request.send(formData);

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let mensajesJson = JSON.parse(request.responseText);

            document.getElementById('mensajes').innerHTML = '';

            mensajesJson.forEach(element => {
                if (idUsuarioActual == element.Id) {
                    document.getElementById('mensajes').innerHTML += `
                        <div class="mensaje-contenedor emisor">
                            <img class="foto-usuario" src="data:image/jpg;base64, ${element.FotoPerfil}">
                            <div class="mensaje">
                                <h4 class="nombre-usuario">${element.Nombre}</h4>
                                <p>${element.Mensaje}</p>
                            </div>
                        </div>
                    `;
                } else {
                    document.getElementById('mensajes').innerHTML += `
                        <div class="mensaje-contenedor receptor">
                            <img class="foto-usuario" src="data:image/jpg;base64, ${element.FotoPerfil}">
                            <div class="mensaje">
                                <h4 class="nombre-usuario">${element.Nombre}</h4>
                                <p>${element.Mensaje}</p>
                            </div>
                        </div>
                    `;
                }
            });
        }
    };
}, 1000);

function buscarUsuarioPorNombre() {
    let request = new XMLHttpRequest();
    request.open('POST', '/postclick/Controller/usuarios_controller.php');

    let formData = new FormData();
    formData.append('obtenerUsuarioPorNombre', '');
    formData.append('nombre', document.getElementById('inputNombre').value);

    request.send(formData);

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let usuariosJson = JSON.parse(request.responseText);

            if (usuariosJson.length == 0) {
                alert('Usuario no encontrado');
                return;
            }

            idUsuarioConversacion = usuariosJson[0].Id;
            nombreUsuarioConversacion = usuariosJson[0].Nombre;

            alert('Usted está conversando con el usuario cuyo id es igual a: ' + idUsuarioConversacion + ' y su nombre es ' + nombreUsuarioConversacion);

            actualiza = true;
        }
    };
}

function insertarMensaje() {
    let request = new XMLHttpRequest();
    request.open('POST', '/postclick/Controller/chat_controller.php');

    let formData = new FormData();
    formData.append('insertarMensaje', '');
    formData.append('mensaje', document.getElementById('inputMensaje').value);
    formData.append('idSegundoUsuario', idUsuarioConversacion);

    request.send(formData);

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('inputMensaje').value = '';
        }
    };
}


function obtenerMensajes() {
    if (!actualiza) return;

    let request = new XMLHttpRequest();
    request.open('POST', '/postclick/Controller/chat_controller.php');

    let formData = new FormData();
    formData.append('obtenerMensajes', '');
    formData.append('idSegundoUsuario', idUsuarioConversacion);

    request.send(formData);

    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let mensajesJson = JSON.parse(request.responseText);

            if (mensajesJson.length == 0) {
                alert('No has conversado con este usuario aún');
                return;
            }

            document.getElementById('mensajes').innerHTML = '';

            mensajesJson.forEach(element => {
                document.getElementById('mensajes').innerHTML += `
                    <div style="margin-top: 15px;">
                        <strong>${element.Nombre}</strong>
                        <p>${element.Mensaje}</p>
                    </div>
                `;
            });
        }
    };
}
