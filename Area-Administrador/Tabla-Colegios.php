<?php
session_start();

// Verifica si el usuario está autenticado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");  // Redirige a la página de inicio de sesión si no está autenticado
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Colegios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="ruta/a/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="../Imagenes/icono.png" />
    <link rel="stylesheet" href="styles/style.css">
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
                        <a class="dropdown-item" href="#"><i class="fas fa-user"></i> Perfil</a>
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
        <!-- <a class="sidebar-item" href="#">
            <i class="fas fa-home"></i> Inicio
        </a> -->
        <a class="sidebar-item" href="perfil.php">
            <i class="fas fa-user"></i> Perfil
        </a>
        <a class="sidebar-item" href="#">
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

<div class="container mt-5">
    <br><br>
        <h1 class="text-center">Tabla de Colegios</h1>
        <div class="row justify-content-center mb-4">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="input-group">
                    <input type="text" class="form-control" id="searchInput" placeholder="Buscar..." oninput="this.value = this.value.toUpperCase()">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" onclick="abrirModal()">
                            <i class="fa-solid fa-school-circle-check"></i>
                            <span class="ml-2">Registrar Colegio</span>
                        </button>
                    </div>
                </div>
                <br>
        <div class="pagination justify-content-center">
            <button id="prevPage" class="btn btn-secondary" disabled>Anterior</button>
            <span id="currentPage" class="mx-2">Página 1</span>
            <button id="nextPage" class="btn btn-secondary">Siguiente</button>
        </div>
            </div>
        </div>

        <div id="modalContainer"></div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="tablaColegios">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Tipo de Colegio</th>
                        <th>Total Estudiantes</th>
                        <th>Jornada Mañana</th>
                        <th>Jornada Tarde</th>
                        <th>Jornada Completa</th>
                        <th>Jornada Noche</th>
                        <th>Jornada Sabatina</th>
                        <th>Logo</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include "php/tabla.php"
                    ?>
                </tbody>
            </table>
        </div>


    </div>




    <!-- Modal para confirmar la eliminación -->
<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEliminarLabel">Confirmar eliminación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que quieres eliminar este colegio?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" onclick="eliminarColegio()">Eliminar</button>
            </div>
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
