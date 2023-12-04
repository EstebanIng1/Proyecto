<!DOCTYPE html>
<html lang="en">
<head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="ruta/a/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/style-perfil.css">
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark custom-navbar fixed-top">
        <a class="navbar-brand" href="#">
            <img src="img/ESCUDO-COLOR-H.png" alt="Logo" height="55">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <ul class="navbar-nav">
                <!-- Elementos para el menu -->
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-circle user-icon"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="perfil.php"><i class="fas fa-user"></i> Perfil</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Configuraciones</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div id="toggleSidebarButton" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </div>

<!-- Barra de navegación izquierda -->
<nav class="sidebar">
        <!-- <a class="sidebar-item" href="#">
            <i class="fas fa-home"></i> Inicio
        </a> -->
        <a class="sidebar-item" href="#">
            <i class="fas fa-user"></i> Perfil
        </a>
        <a class="sidebar-item" href="Tabla-Colegios.php">
            <i class="fas fa-table"></i> Tabla Colegios
        </a>
        <a class="sidebar-item" href="Tabla-Colegios-Icfes.php">
            <i class="fas fa-table"></i> Tabla Colegios ICFES
        </a>
        <a class="sidebar-item" href="#">
            <i class="fas fa-cog"></i> Configuración
        </a>
        <a class="sidebar-item" href="#">
            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
        </a>
    </nav>

<div class="profile-container">
    <div class="username">WILLIAM ARLEY GOMEZ</div>
    <div class="profile-circle">
        <img src="logos/COLEGIO_LOGO_LEYDER.png" alt="Profile Image">
    </div>
    <div class="edit-icon">
            <i class="fas fa-edit"></i>
    </div>
</div>


<div class="profile-info">
    <div class="details">
        <div class="title">Perfil</div>
        <div class="info-item">
            <span class="label">Nombre:</span>
            <span class="value">Nombre del Usuario</span>
        </div>
        <div class="info-item">
            <span class="label">Correo Electrónico:</span>
            <span class="value">usuario@example.com</span>
        </div>
        <div class="info-item">
            <span class="label">Cédula:</span>
            <span class="value">123456789</span>
        </div>
        <div class="info-item">
            <span class="label">Celular:</span>
            <span class="value">123-456-7890</span>
        </div>
        <div class="text-center">
            <button class="btn btn-primary mt-3">Actualizar</button>
        </div>
    </div>
</div>




<script src="scripts/script.js"></script>

<script>
    const toggleSidebarButton = document.getElementById('toggleSidebarButton');
    const sidebar = document.querySelector('.sidebar');

    function toggleSidebar() {
        sidebar.classList.toggle('d-none');
    }

    // Ocultar la barra de navegación al cargar en pantallas pequeñas y al cambiar el tamaño
    function hideSidebarOnSmallScreen() {
        if (window.innerWidth <= 767) {
            sidebar.classList.add('d-none');
        } else {
            sidebar.classList.remove('d-none');
        }
    }

    // Llamar a la función para ocultar en carga y en cambio de tamaño
    window.addEventListener('resize', hideSidebarOnSmallScreen);
    window.addEventListener('load', hideSidebarOnSmallScreen);
</script>


</body>
</html>
