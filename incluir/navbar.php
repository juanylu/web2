<style>
    
    .navbar {
        width: 100%;
        background: #5c2d7a;
        padding: 15px 30px;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
    }

    .navbar-contenido {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: #fff;
    }

    .navbar .logo {
        font-size: 24px;
        font-weight: bold;
    }

    .navbar .menu a {
        margin-left: 20px;
        text-decoration: none;
        color: #fff;
        font-weight: bold;
        transition: color 0.3s ease;
    }

    .navbar .menu a:hover {
        color: #ffdd59;
    }

    /* Ajuste para que el contenido no quede oculto detrás del navbar */
    body {
        padding-top: 70px; /* Altura del navbar */
    }
</style>

<nav class="navbar">
    <div class="navbar-contenido">
        <div class="logo">PonClick!</div>
        <div class="menu">
            <a href="../pages/inicio.php">Inicio</a>
            <a href="../pages/crear.php">Crear</a>
            <a href="../pages/chat.php">Chat</a>
            <a href="../pages/perfil.php">Perfil</a>
            <a href="../pages/login.php">Salir</a>
        </div>
    </div>
</nav>
