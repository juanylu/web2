document.addEventListener('DOMContentLoaded', function () {
    fetch('../Controller/publicaciones_controller.php?obtener_publicaciones=1')
        .then(response => response.json())
        .then(data => {
            const contenedor = document.getElementById('publicaciones');

            if (!contenedor) {
                console.error('No se encontró el contenedor de publicaciones.');
                return;
            }

            if (!data.length) {
                contenedor.innerHTML = "<p>No hay publicaciones todavía.</p>";
                return;
            }

            data.forEach(pub => {
                const publicacion = document.createElement('div');
                publicacion.classList.add('publicacion');

                const imagenUsuario = pub.foto_perfil
                    ? `<img src="data:image/jpeg;base64,${pub.foto_perfil}" alt="Usuario">`
                    : `<img src="../img/default.jpg" alt="Usuario">`;

                const imagenPublicacion = pub.imagen
                    ? `<img src="data:image/jpeg;base64,${pub.imagen}" alt="Imagen de la publicación">`
                    : '';

                publicacion.innerHTML = `
                    <div class="usuario">
                        ${imagenUsuario}
                        <span>${pub.usuario}</span>
                    </div>
                    <p>${pub.contenido}</p>
                    ${imagenPublicacion}
                    <div class="fecha">Publicado el ${pub.fecha_publicacion}</div>
                    <div class="categoria">Categoría: ${pub.categoria}</div>
<div class="reacciones">
    <button class="icono like" id="btn-like-${pub.id}" onclick="reaccionar(${pub.id}, 'like')">👍</button>
    <span id="likes-${pub.id}">0</span>

    <button class="icono dislike" id="btn-dislike-${pub.id}" onclick="reaccionar(${pub.id}, 'dislike')">👎</button>
    <span id="dislikes-${pub.id}">0</span>

   
                        <button class="comentar-btn" onclick="window.location.href='comentarios.php?publicacion_id=${pub.id}'">Comentar</button>

                    </div>
                    
                `;

                contenedor.appendChild(publicacion);

                // Cargar reacciones actuales
                fetch(`../Controller/get_reacciones.php?publicacion_id=${pub.id}`)
                    .then(res => res.json())
                    .then(rData => {
                        if (rData.success) {
                            actualizarReacciones(pub.id, rData.likes, rData.dislikes, rData.reaccionUsuario);
                        }
                    });
            });
        })
        .catch(error => {
            console.error('Error al cargar publicaciones:', error);
        });
});
