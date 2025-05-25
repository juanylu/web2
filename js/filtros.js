document.addEventListener('DOMContentLoaded', function () {
    const selectCategoria = document.getElementById('filtro-categoria');
    const selectOrden = document.getElementById('filtro-orden');
    const inputBusqueda = document.getElementById('filtro-busqueda');
    const btnFiltrar = document.getElementById('btn-filtrar');

    // Cargar categorías en el select
    fetch('../Controller/categoriasfiltros_controller.php')
        .then(res => res.json())
        .then(data => {
            data.forEach(cat => {
                const option = document.createElement('option');
                option.value = cat.id;
                option.textContent = cat.nombre;
                selectCategoria.appendChild(option);
            });
        });

    // Función para cargar publicaciones con filtros
    function cargarPublicaciones() {
        const categoria = selectCategoria.value;
        const orden = selectOrden.value;
        const busqueda = inputBusqueda.value;

        const url = `../Controller/filtros_controller.php?categoria=${categoria}&orden=${orden}&busqueda=${busqueda}`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                const contenedor = document.getElementById('publicaciones');
                contenedor.innerHTML = '';

                if (!data.length) {
                    contenedor.innerHTML = "<p>No hay publicaciones con esos filtros.</p>";
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

                    // Obtener reacciones actuales
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
    }

    // Cargar publicaciones al inicio
    cargarPublicaciones();

    // Filtrar al hacer clic
    btnFiltrar.addEventListener('click', cargarPublicaciones);
});
