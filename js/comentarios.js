document.addEventListener('DOMContentLoaded', () => {
    const publicacionId = window.publicacionId;

    fetch(`../Controller/comentarios_controller.php?publicacion_id=${publicacionId}`)
        .then(response => response.json())
        .then(data => {
         
            const contenedor = document.getElementById("contenido-publicacion");
            if (data.publicacion) {
                const pub = data.publicacion;
                contenedor.innerHTML = `
                    <h2>Publicación de ${pub.usuario}</h2>
                    <p>${pub.contenido}</p>
                    ${pub.imagen ? `<img src="data:image/jpeg;base64,${pub.imagen}" alt="Imagen">` : ''}
                    <hr>
                `;
            } else {
                contenedor.innerHTML = "<p>No se encontró la publicación.</p>";
            }

            const lista = document.getElementById("lista-comentarios");
            if (data.comentarios && data.comentarios.length > 0) {
                lista.innerHTML = data.comentarios.map(com => `
                    <div class="comentario">
                        <strong>${com.usuario}</strong>
                        <p>${com.contenido}</p>
                        <small>${com.fecha_comentario}</small>
                    </div>
                `).join('');
            } else {
                lista.innerHTML = "<p>No hay comentarios todavía.</p>";
            }
        })
        .catch(err => {
            console.error("Error al cargar comentarios:", err);
        });
});


document.getElementById("form-comentario").addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch("../Controller/comentarios_controller.php", {
        method: "POST",
        body: formData
    })
    .then(resp => resp.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert("Error al comentar: " + (data.message || ''));
        }
    })
    .catch(err => {
        console.error("Error al enviar comentario:", err);
    });
});
