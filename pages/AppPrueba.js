

//obtenerUsuarios();
let idUsuario = localStorage.getItem('IdUsuario');
alert('Este es el Id del usuario Actual ' + idUsuario);

function obtenerUsuarios() {
    let request = new XMLHttpRequest();
    request.open('POST', '/postclick/Controller/usuarios_controller.php');

    let formData = new FormData();
    formData.append('obtenerUsuarios', '');
    
    request.send(formData); // -> manda la petición a la api

    // asincornía

    request.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            let usuariosJson = JSON.parse(request.responseText);

            document.getElementById('usuarios_placeholder').innerHTML = ''

            usuariosJson.forEach(element => {
                document.getElementById('usuarios_placeholder').innerHTML +=
                `
                <p>Nombre:  ${element.Nombre}</p>
                <p>Email: ${element.Email}</p>
                <p>Password: ${element.Password}</p>
                <p>FechaNacimiento: ${element.FechaNacimiento}</p>
                <img src="data:image/jpg;base64, ${element.FotoPerfil}" height='250' width='250'>
                `
            });
            
        }

    }

}



function insertarUsuario() {

    // instanciamos un objeto de la clase que nos ayuda a usar AJAX para las peticiones
    let request = new XMLHttpRequest();
    request.open('POST', '/postclick/Controller/usuarios_controller.php');

    // instanciar el form data pára transportar los datos
    let formData = new FormData();
    formData.append('insertarUsuarios', '');
    formData.append('nombre', document.getElementById('inputNombre').value);
    formData.append('email', document.getElementById('inputEmail').value);
    formData.append('password', document.getElementById('inputPassword').value);
    formData.append('fecha_nacimiento', document.getElementById('inputFechaNacimiento').value);
    formData.append('foto_perfil', document.getElementById('inputFotoPerfil').files[0]);

    // hace la petición a la API
    request.send(formData);

    request.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            alert('Nuevo usuario agregado');
            document.getElementById('inputNombre').value = '';
            document.getElementById('inputEmail').value = '';
            document.getElementById('inputPassword').value = '';
            document.getElementById('inputFechaNacimiento').value = '';
            document.getElementById('inputFotoPerfil').value = null;
            

            obtenerUsuarios();
        }
    }
}

function editarUsuario() {
    let request = new XMLHttpRequest();
    request.open('POST', '/postclick/Controller/usuarios_controller.php');

    let formData = new FormData();
    formData.append('modificarUsuario', '');
    formData.append('id', document.getElementById('inputId').value);
    formData.append('nombre', document.getElementById('inputNombre').value);
    formData.append('email', document.getElementById('inputEmail').value);
    formData.append('password', document.getElementById('inputPassword').value);
    formData.append('fecha_nacimiento', document.getElementById('inputFechaNacimiento').value);
    formData.append('foto_perfil', document.getElementById('inputFotoPerfil').files[0]);

    request.send(formData);

    request.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            alert('Usuario modificado');
            document.getElementById('inputId').value = ''
            document.getElementById('inputNombre').value = ''
            document.getElementById('inputPassword').value = '';
            document.getElementById('inputFechaNacimiento').value = '';
            document.getElementById('inputFotoPerfil').value = null;

            obtenerUsuarios();
        }
    }
}

function eliminarUsuario() {
    let request = new XMLHttpRequest();
    request.open('POST', '/postclick/Controller/usuarios_controller.php');

    let formData = new FormData();
    formData.append('eliminarUsuario', '');
    formData.append('id', document.getElementById('inputId').value);

    request.send(formData);

    request.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            alert('Usuario eliminado');
            document.getElementById('inputId').value = ''

            obtenerUsuarios();
        }
    }
}


function buscarUsuario() {
    let request = new XMLHttpRequest();
    request.open('POST', '/postclick/Controller/usuarios_controller.php');

    let formData = new FormData();
    formData.append('obtenerUsuarioPorId', '');
    formData.append('id', document.getElementById('inputId').value);

    request.send(formData);

    request.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {

            
            let usuariosJson = JSON.parse(request.responseText);
            
            document.getElementById('usuarios_placeholder').innerHTML = ''

            if(usuariosJson.length == 0){
                alert('Usuario no encontrado');
                return;
            }

            usuariosJson.forEach(element => {
                document.getElementById('usuarios_placeholder').innerHTML +=
                `
                <p>Nombre:  ${element.Nombre}</p>
                <p>Email: ${element.Email}</p>
                <p>Password: ${element.Password}</p>
                <p>FechaNacimiento: ${element.FechaNacimiento}</p>
                <img src="data:image/jpg;base64, ${element.FotoPerfil}" height='250' width='250'>
                `
            });
        }
    }
}