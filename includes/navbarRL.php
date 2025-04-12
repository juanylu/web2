<header class="navbar">
    <h1>PonClick!</h1>
    <nav>
        <a href="../pages/registro.php">Registrarse</a>
        <a href="../pages/login.php">Iniciar sesion</a>

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
