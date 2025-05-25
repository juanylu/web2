document.addEventListener('DOMContentLoaded', () => {
    const audio = document.getElementById('audioFondo');
    const volumen = document.getElementById('volumen');
    const cancion = document.getElementById('cancion');
    const toggleBtn = document.getElementById('toggleAudio');
    const source = document.getElementById('sourceAudio');
    const progress = document.getElementById('progress');
    const songTitle = document.getElementById('song-title');

    audio.volume = volumen.value;

    // Volumen
    volumen.addEventListener('input', () => {
        audio.volume = volumen.value;
        localStorage.setItem('volumenMusica', volumen.value);
    });

    
    const savedVol = localStorage.getItem('volumenMusica');
    if (savedVol !== null) {
        volumen.value = savedVol;
        audio.volume = savedVol;
    }

    // Play/pause
    toggleBtn.addEventListener('click', () => {
        if (audio.paused) {
            audio.play();
            toggleBtn.textContent = '⏸️';
        } else {
            audio.pause();
            toggleBtn.textContent = '▶️';
        }
    });

    cancion.addEventListener('change', () => {
        const nueva = cancion.value;
        source.src = nueva;
        audio.load();
        audio.play();
        toggleBtn.textContent = '⏸️';
        songTitle.textContent = cancion.options[cancion.selectedIndex].text;

        fetch('../includes/guardar_musica.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'cancion=' + encodeURIComponent(nueva)
        }).catch(err => console.error('Error al guardar música:', err));
    });


    audio.addEventListener('timeupdate', () => {
        progress.max = audio.duration;
        progress.value = audio.currentTime;
    });

    progress.addEventListener('input', () => {
        audio.currentTime = progress.value;
    });

    // Botones 
    const lista = Array.from(cancion.options);
    document.getElementById('next').addEventListener('click', () => {
        let i = cancion.selectedIndex;
        if (i < lista.length - 1) cancion.selectedIndex = i + 1;
        cancion.dispatchEvent(new Event('change'));
    });

    document.getElementById('prev').addEventListener('click', () => {
        let i = cancion.selectedIndex;
        if (i > 0) cancion.selectedIndex = i - 1;
        cancion.dispatchEvent(new Event('change'));
    });
});
