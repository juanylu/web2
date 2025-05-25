<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/conexion.php';
$conn = new Connection();
$dbh = $conn->connect();

$usuario_id = $_SESSION['usuario']['id'];
$cancion_actual = "../audio/Charlie_s-Here.mp3"; // por defecto

$stmt = $dbh->prepare("SELECT cancion FROM musica_usuario WHERE usuario_id = ?");
$stmt->execute([$usuario_id]);
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

if ($resultado) {
    $cancion_actual = $resultado['cancion'];
}
?>

<link rel="stylesheet" href="../css/repmusica.css">
<div class="music-player">
    <div class="header">
        <div class="cover"></div>
        <div class="song-info">
            <h4 id="song-title">Mi canción</h4>
            <p id="song-subtitle">Artista</p>
        </div>
    </div>

    <audio id="audioFondo" autoplay loop>
        <source id="sourceAudio" src="<?= htmlspecialchars($cancion_actual) ?>" type="audio/mpeg">
    </audio>

    <div class="progress-container">
        <input type="range" id="progress" value="0" step="1">
    </div>

    <div class="controls">
        <button id="prev" aria-label="Anterior">&#9664;&#9664;</button>
        <button id="toggleAudio" aria-label="Reproducir o Pausar">⏸️</button>
        <button id="next" aria-label="Siguiente">&#9654;&#9654;</button>
    </div>

    <div class="volume-container">
        <input type="range" id="volumen" min="0" max="1" step="0.01" value="0.5">
    </div>

    <select id="cancion" style="width: 100%; margin-top: 10px;">
        <option value="../audio/Charlie_s-Here.mp3">Charlie's Here</option>
        <option value="../audio/CP-Cart Surfer.mp3">Cart Sufer</option>
        <option value="../audio/CP-Bean Counters.mp3">Bean Counters</option>
        <option value="../audio/CP-Coffee Shop.mp3">Coffe Shop</option>
    </select>
</div>
<script src="../js/repmusica.js" defer></script>
