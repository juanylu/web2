function reaccionar(publicacionId, tipo) {
    const formData = new FormData();
    formData.append('publicacion_id', publicacionId);
    formData.append('tipo', tipo);

    fetch('/postclick/Controller/reacciones_controller.php', {
        method: 'POST',
        body: formData
    })
    .then(resp => resp.json())
    .then(data => {
        if (data.success) {
            actualizarReacciones(publicacionId, data.likes, data.dislikes, data.reaccion_usuario);
        }
    });
}

function actualizarReacciones(publicacionId, likes, dislikes, reaccionUsuario) {
    const likeCount = document.querySelector(`#likes-${publicacionId}`);
    const dislikeCount = document.querySelector(`#dislikes-${publicacionId}`);
    const likeBtn = document.querySelector(`#btn-like-${publicacionId}`);
    const dislikeBtn = document.querySelector(`#btn-dislike-${publicacionId}`);

    likeCount.textContent = likes;
    dislikeCount.textContent = dislikes;

    likeBtn.style.color = reaccionUsuario === 'like' ? 'green' : '';
    dislikeBtn.style.color = reaccionUsuario === 'dislike' ? 'red' : '';
}
