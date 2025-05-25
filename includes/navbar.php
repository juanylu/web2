<header class="navbar">
    <h1>PostClick</h1>
    <nav>
        <a href="../pages/inicio.php">Inicio</a>
        <a href="../pages/publicaciones.php">Publi</a>
        <a href="../pages/crear_categoria.php">Categorias</a>
        <a href="../pages/perfil.php">Perfil</a>
        <a href="../pages/chat2usuarios.php">Chat</a>
        <a href="../pages/mensajes.php">PrivChat</a>
        <a href="../pages/reportes.php">Admin</a>
        <a href="../pages/logout.php">Cerrar sesión</a>
    </nav>
</header>

<style>
    .navbar {
        width: 100%;
        background:rgb(76, 3, 85); 
        padding: 15px 0;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
        display: flex;
        justify-content: space-around; 
        align-items: center;
    }

    .navbar h1 {
        margin: 0;
        color:#ffff;
        font-size: 24px;
    }

    .navbar nav {
        display: flex;
        gap: 20px;
    }

    .navbar a {
        text-decoration: none;
        color: #ffdd59; 
        font-weight: normal;
    }

    body {
        padding-top: 50px; 
    }
</style>
