function iniciarSesion() {
    
    
    let nombre = document.getElementById('inputEmail').value;
    let contrasenia = document.getElementById('inputPassword').value;

    let request = new XMLHttpRequest();
    request.open('POST', '/ponclick/Controller/usuarios_controller.php');

    let formData = new FormData();
    formData.append('iniciarSesion', '');
    formData.append('email', nombre);
    formData.append('password', contrasenia);

    request.send(formData);

    request.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            console.log(request.responseText);
            
            let usuariosJson = JSON.parse(request.responseText);
            

            if(usuariosJson.length == 0){
                alert('Credenciales incorrectas');
                return;
            }
            else{
                let idUsuario = usuariosJson[0].Id;
                window.location.href = "/ponclick/pages/publicaciones.php"
                localStorage.setItem('IdUsuario', idUsuario);
                
            }
        }
    }
}