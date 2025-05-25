const receptorId = parseInt(document.body.dataset.receptorId);
const emisorId = parseInt(document.body.dataset.emisorId);
let ultimoContenido = '';

function cargarMensajes() {
    fetch(`../Controller/chat2_controller.php?receptor_id=${receptorId}`)
        .then(response => response.json())
        .then(data => {
            let nuevoContenido = '';

            data.forEach((msg) => {
                const clase = msg.emisor_id == emisorId ? 'mio' : 'otro';
                let contenido = msg.mensaje;

                if (contenido.startsWith("GEO:")) {
                    const [lat, lng] = contenido.replace("GEO:", "").split(",").map(parseFloat);
                    const mapa = `
                        <iframe class="mapa"
                            src="https://maps.google.com/maps?q=${lat},${lng}&z=15&output=embed">
                        </iframe>
                        <a href="https://www.google.com/maps?q=${lat},${lng}" target="_blank">
                            Ver en Google Maps
                        </a>
                    `;
                    nuevoContenido += `<div class="${clase}">${mapa}</div>`;
                } else if (contenido.startsWith("CAT:")) {
                    const url = contenido.replace("CAT:", "").trim();
                    nuevoContenido += `<div class="${clase}"><img src="${url}" alt="Gato" style="max-width:200px; border-radius:10px;"></div>`;
                } else {
                    nuevoContenido += `<div class="${clase}">${contenido}</div>`;
                }
            });

            if (nuevoContenido !== ultimoContenido) {
                const contenedor = document.getElementById('mensajes');
                contenedor.innerHTML = nuevoContenido;
                contenedor.scrollTop = contenedor.scrollHeight;
                ultimoContenido = nuevoContenido;
            }
        });
}

document.getElementById('formMensaje').addEventListener('submit', function(e) {
    e.preventDefault();
    const mensaje = document.getElementById('mensaje').value.trim();
    if (mensaje === '') return;

    fetch('../Controller/chat2_controller.php', {
        method: 'POST',
        body: new URLSearchParams({
            receptor_id: receptorId,
            mensaje: mensaje
        })
    }).then(() => {
        document.getElementById('mensaje').value = '';
        cargarMensajes();
    });
});

document.getElementById('btnUbicacion').addEventListener('click', function () {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;

            console.log("Precisión aproximada:", position.coords.accuracy, "metros");

            const geoMensaje = `GEO:${lat},${lng}`;

            fetch('../Controller/chat2_controller.php', {
                method: 'POST',
                body: new URLSearchParams({
                    receptor_id: receptorId,
                    mensaje: geoMensaje
                })
            }).then(() => {
                cargarMensajes();
            });
        }, function () {
            alert('No se pudo obtener tu ubicación.');
        }, {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0
        });
    } else {
        alert('Tu navegador no soporta geolocalización.');
    }
});

document.getElementById('btnGato').addEventListener('click', function () {
    const texto = prompt("¿Qué quieres que diga el gato?");
    if (!texto) return;

    const urlApi = `https://cataas.com/cat/says/${encodeURIComponent(texto)}?size=50&color=white&json=true`;

    fetch(urlApi)
        .then(res => res.json())
        .then(data => {
            const urlFinal = data.url.startsWith('http') ? data.url : `https://cataas.com${data.url}`;

            fetch('../Controller/chat2_controller.php', {
                method: 'POST',
                body: new URLSearchParams({
                    receptor_id: receptorId,
                    mensaje: `CAT:${urlFinal}`
                })
            }).then(() => {
                cargarMensajes();
            });
        })
        .catch(() => {
            alert("Error al obtener la imagen del gato.");
        });
});

setInterval(cargarMensajes, 2000);
cargarMensajes();
