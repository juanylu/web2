function contarUsuarios() {
    let request = new XMLHttpRequest();
    request.open('POST', '/postclick/Controller/reportes_controller.php');

    let formData = new FormData();
    formData.append('contarUsuarios', ''); 

    request.send(formData); 

    request.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            //console.log( request.responseText);
            let respuesta = JSON.parse(request.responseText);

            
            document.getElementById('contador_usuarios').innerText =
                `${respuesta.TotalUsuarios}`;
        }
    }
}


function contarPublicaciones() {
    let request = new XMLHttpRequest();
    request.open('POST', '/postclick/Controller/reportes_controller.php');

    let formData = new FormData();
    formData.append('contarPublicaciones', '');

    request.send(formData);

    request.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            //console.log("Response Text:", this.responseText); 

            let respuesta = JSON.parse(this.responseText);
            document.getElementById('contador_publicaciones').innerText =
                `${respuesta.TotalPublicaciones}`;
        }
    }
}

function contarPublicacionesPorNombre() {
    const nombreUsuario = document.getElementById('nombreUsuario').value.trim();

    if (nombreUsuario === '') {
        alert("Por favor ingresa un nombre de usuario.");
        return;
    }

    let request = new XMLHttpRequest();
    request.open('POST', '/postclick/Controller/reportes_controller.php');

    let formData = new FormData();
    formData.append('contarPublicacionesPorNombre', ''); 
    formData.append('nombreUsuario', nombreUsuario); 

    request.send(formData);

    request.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            //console.log("Response:", this.responseText);

            let respuesta = JSON.parse(this.responseText);

            // ✅ usa la variable que definiste arriba
            if (respuesta.TotalPublicaciones == 0) {
                document.getElementById('contador_usuario_publicaciones').innerText =
                    `El usuario "${nombreUsuario}" no tiene publicaciones registradas (o no existe).`;
            } else {
                document.getElementById('contador_usuario_publicaciones').innerText =
                    `Total de publicaciones de ${nombreUsuario}: 
                    ${respuesta.TotalPublicaciones}`;
            }
        }
    }
}





