<?php
include "php/datos-perfil.php";
include "php/conexion.php";
$sqlFotoPerfil = "SELECT foto_de_perfil FROM usuarios WHERE id_usuario = $idUsuario";
$resultFotoPerfil = $conn->query($sqlFotoPerfil);

if ($resultFotoPerfil) {
    // Verifica si hay resultados
    if ($resultFotoPerfil->num_rows > 0) {
        $rowFotoPerfil = $resultFotoPerfil->fetch_assoc();
        $rutaImagenPerfil = $rowFotoPerfil['foto_de_perfil'];
    } else {
        $rutaImagenPerfil = '../img/logo_usuario_defecto.png';  // Si no hay una imagen de perfil definida, puedes usar una imagen por defecto
    }
} else {
    // Manejo de errores en la consulta
    $rutaImagenPerfil = '../img/logo_usuario_defecto.png';  // Puedes definir una imagen por defecto
    echo "Error en la consulta: " . $conn->error;
}
?>

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
        <link rel="shortcut icon" href="../Imagenes/icono.png" />
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
                        <a class="dropdown-item" href="configuraciones.php"><i class="fas fa-cog"></i> Configuraciones</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="php/cerrar_sesion.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
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
        <a class="sidebar-item" href="#">
            <i class="fas fa-user"></i> Perfil
        </a>
        <a class="sidebar-item" href="Tabla-Colegios.php">
            <i class="fas fa-table"></i> Tabla Colegios
        </a>
        <a class="sidebar-item" href="Tabla-Colegios-Icfes.php">
            <i class="fas fa-table"></i> Tabla Colegios ICFES
        </a>
        <a class="sidebar-item" href="configuraciones.php">
            <i class="fas fa-cog"></i> Configuración
        </a>
        <a class="sidebar-item" href="php/cerrar_sesion.php">
            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
        </a>
    </nav>

    <div class="profile-container">
        <div class="username"><?php echo $nombreUsuario; ?></div>
        <div class="profile-circle">
            <img src="<?php echo $rutaImagenPerfil; ?>" alt="Profile Image">
        </div>
    </div>




    <div class="profile-info">
        <div class="details">
            <div class="title">Perfil</div>
            <div class="info-item">
                <span class="label">Nombre:</span>
                <span class="value"><?php echo $nombreUsuario; ?></span>
            </div>
            <div class="info-item">
                <span class="label">Correo Electrónico:</span>
                <span class="value"><?php echo $correoUsuario; ?></span>
            </div>
            <div class="info-item">
                <span class="label">Cédula:</span>
                <span class="value"><?php echo $cedulaUsuario; ?></span>
            </div>
            <div class="info-item">
                <span class="label">Celular:</span>
                <span class="value"><?php echo $telefonoUsuario; ?></span>
            </div>
            <div class="text-center">
                <a href="php/perfil-editar.php" type="button" class="btn btn-primary mt-3">Editar</a>
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