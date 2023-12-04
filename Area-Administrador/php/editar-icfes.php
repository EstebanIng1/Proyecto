<?php
session_start();

// Verifica si el usuario está autenticado
if (!isset($_SESSION['id_usuario'])) {
  header("Location: ../login.php");  // Redirige a la página de inicio de sesión si no está autenticado
  exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Colegio</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="shortcut icon" href="../../Imagenes/icono.png" />
  <link rel="stylesheet" href="../styles/style.css">
</head>

<style>
  .form-container {
    margin-top: 133px;
    max-height: 500px;
    /* Altura máxima del contenedor */
    overflow-y: auto;
    /* Desplazamiento vertical automático si se excede la altura */
    padding: 20px;
    /* Espaciado interno */
    border: 1px solid #ccc;
    /* Borde para el contenedor */
  }
</style>

<body>
  <nav class="navbar navbar-expand-md navbar-dark custom-navbar fixed-top">
    <a class="navbar-brand" href="#">
      <img src="../img/ESCUDO-COLOR-H.png" alt="Logo" height="55">
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
            <a class="dropdown-item" href="../perfil.php"><i class="fas fa-user"></i> Perfil</a>
            <a class="dropdown-item" href="../configuraciones.php"><i class="fas fa-cog"></i> Configuraciones</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="cerrar_sesion.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
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

    <a class="sidebar-item" href="../perfil.php">
      <i class="fas fa-user"></i> Perfil
    </a>
    <a class="sidebar-item" href="../Tabla-Colegios.php">
      <i class="fas fa-table"></i> Tabla Colegios
    </a>
    <a class="sidebar-item" href="../Tabla-Colegios-Icfes.php">
      <i class="fas fa-table"></i> Tabla Colegios ICFES
    </a>
    <a class="sidebar-item" href="../configuraciones.php">
      <i class="fas fa-cog"></i> Configuración
    </a>
    <a class="sidebar-item" href="cerrar_sesion.php">
      <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
    </a>
  </nav>


  <div class="container">

    <?php
    // Verifica si se ha pasado un ID válido por la URL
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
      $id = $_GET['id'];

      include "conexion.php";

      // Consulta para obtener los datos del colegio con el ID dado
      $sql = "SELECT colegios.id_colegios, colegios.nombre, colegios.direccion, colegios.tipo_de_colegio, colegios.total_estudiantes, colegios.logo, 

            colegios_icfes_prom_global.promedio_global,
            colegios_icfes_prom_matematicas.promedio_matematicas,
            colegios_icfes_prom_lectura.promedio_lectura,
            colegios_icfes_prom_sociales.promedio_ciencias_sociales,
            colegios_icfes_prom_cienciasn.promedio_ciencias_naturales,
            colegios_icfes_prom_ingles.promedio_ingles
    
           FROM colegios
           LEFT JOIN colegios_icfes_prom_cienciasn ON colegios.id_colegios = colegios_icfes_prom_cienciasn.id_colegios
           LEFT JOIN colegios_icfes_prom_global ON colegios.id_colegios = colegios_icfes_prom_global.id_colegios
           LEFT JOIN colegios_icfes_prom_ingles ON colegios.id_colegios = colegios_icfes_prom_ingles.id_colegios
           LEFT JOIN colegios_icfes_prom_matematicas ON colegios.id_colegios =  colegios_icfes_prom_matematicas.id_colegios
           LEFT JOIN colegios_icfes_prom_sociales ON colegios.id_colegios = colegios_icfes_prom_sociales.id_colegios
           LEFT JOIN colegios_icfes_prom_lectura ON colegios.id_colegios = colegios_icfes_prom_lectura.id_colegios
                WHERE colegios.id_colegios = $id";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    ?>
        <div class="form-container">
          <form action="../actualizar-icfes.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_colegios" value="<?php echo $row['id_colegios']; ?>">
            <div class="form-group">

              <div class="row">

                <div class="col-md-6">
                  <label for="nombre">Nombre:</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>">
                </div>
                <div class="col-md-6">
                  <label for="nombre">Total de estudiantes:</label>
                  <input type="text" class="form-control" id="nombre" name="total_estudiantes" value="<?php echo $row['total_estudiantes']; ?>">
                </div>
                <!-- Dirección -->
                <div class="col-md-6">
                  <label for="direccion">Dirección:</label>
                  <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $row['direccion']; ?>">
                </div>


                <div class="col-md-6">
                  <label for="tipo_de_colegio">Selecciona un tipo de colegio:</label>
                  <br>
                  <select class="form-select" id="tipo_de_colegio" name="tipo_de_colegio" required>
                    <option value="" disabled>SELECCIONA UN TIPO DE COLEGIO</option>
                    <?php
                    $options = array("OFICIAL", "NO OFICIAL");
                    foreach ($options as $option) {
                      $selected = ($row['tipo_de_colegio'] === $option) ? 'selected' : '';
                      echo '<option value="' . $option . '" ' . $selected . '>' . $option . '</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="nuevo_logo">Logo:</label>
                  <input type="file" class="form-control" id="nuevo_logo" name="nuevo_logo" accept="image/*">
                </div>

                <div class="col-md-6">
                  <label for="jornada_manana">Promedio Global:</label>
                  <input type="number" class="form-control" id="colegios_icfes_prom_global" name="colegios_icfes_prom_global" value="<?php echo $row['promedio_global']; ?>">
                </div>
                <div class="col-md-6">
                  <label for="jornada_tarde">Promedio de matematicas:</label>
                  <input type="number" class="form-control" id="colegios_icfes_prom_matematicas" name="colegios_icfes_prom_matematicas" value="<?php echo $row['promedio_matematicas']; ?>">
                </div>
                <div class="col-md-6">
                  <label for="jornada_completa">Promedio de lectura critica:</label>
                  <input type="number" class="form-control" id="colegios_icfes_prom_lectura" name="colegios_icfes_prom_lectura" value="<?php echo $row['promedio_lectura']; ?>">
                </div>
                <div class="col-md-6">
                  <label for="jornada_noche">Promedio de ciencias sociales:</label>
                  <input type="number" class="form-control" id="colegios_icfes_prom_sociales" name="colegios_icfes_prom_sociales" value="<?php echo $row['promedio_ciencias_sociales']; ?>">
                </div>
                <div class="col-md-6">
                  <label for="jornada_sabatina">Promedio de ciencias naturales:</label>
                  <input type="number" class="form-control" id="colegios_icfes_prom_cienciasn" name="colegios_icfes_prom_cienciasn" value="<?php echo $row['promedio_ciencias_naturales']; ?>">
                </div>
                <div class="col-md-6">
                  <label for="jornada_sabatina">Promedio de ingles:</label>
                  <input type="number" class="form-control" id="colegios_icfes_prom_ingles" name="colegios_icfes_prom_ingles" value="<?php echo $row['promedio_ingles']; ?>">
                  <br>
                </div>


                <div class="col-md-12">
                  <button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#collapseForm1" aria-expanded="false" aria-controls="collapseForm1" id="toggleButton">
                    <span style="float: left;">Promedio global de los ultimos 5 años:</span> <span id="toggleIcon" style="float: right;">+</span>
                  </button>
                </div>
                <!-- Collapse con 5 inputs -->
                <div class="col-md-12">
                  <div class="collapse" id="collapseForm1">
                    <div class="row">
                      <div class="col-md-2">
                        <label for="extra_input1">Año 2021:</label>
                        <input type="text" class="form-control" id="extra_input1" name="extra_input1">
                      </div>
                      <div class="col-md-2">
                        <label for="extra_input2">Año 2020:</label>
                        <input type="text" class="form-control" id="extra_input2" name="extra_input2">
                      </div>
                      <div class="col-md-2">
                        <label for="extra_input3">Año 2019:</label>
                        <input type="text" class="form-control" id="extra_input3" name="extra_input3">
                      </div>
                      <div class="col-md-2">
                        <label for="extra_input4">Año 2018:</label>
                        <input type="text" class="form-control" id="extra_input4" name="extra_input4">
                      </div>
                      <div class="col-md-2">
                        <label for="extra_input4">Año 2018:</label>
                        <input type="text" class="form-control" id="extra_input4" name="extra_input4">
                      </div>
                    </div>
                  </div>
                  <br>
                </div>
                <br>
                <div class="col-md-12">
                  <button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#collapseForm2" aria-expanded="false" aria-controls="collapseForm2" id="toggleButton">
                    <span style="float: left;">Promedio de matematicas de los ultimos 5 años:</span> <span id="toggleIcon" style="float: right;">+</span>
                  </button>
                </div>

                <!-- Collapse con 5 inputs -->
                <div class="col-md-12">
                  <div class="collapse" id="collapseForm2">
                    <div class="row">
                      <div class="col-md-2">
                        <label for="extra_input1">Año 2021:</label>
                        <input type="text" class="form-control" id="extra_input1" name="extra_input1">
                      </div>
                      <div class="col-md-2">
                        <label for="extra_input2">Año 2020:</label>
                        <input type="text" class="form-control" id="extra_input2" name="extra_input2">
                      </div>
                      <div class="col-md-2">
                        <label for="extra_input3">Año 2019:</label>
                        <input type="text" class="form-control" id="extra_input3" name="extra_input3">
                      </div>
                      <div class="col-md-2">
                        <label for="extra_input4">Año 2018:</label>
                        <input type="text" class="form-control" id="extra_input4" name="extra_input4">
                      </div>
                      <div class="col-md-2">
                        <label for="extra_input4">Año 2018:</label>
                        <input type="text" class="form-control" id="extra_input4" name="extra_input4">
                      </div>
                    </div>
                  </div>
                  <br>
                </div>
                <br>
                <div class="col-md-12">
                  <button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#collapseForm3" aria-expanded="false" aria-controls="collapseForm3" id="toggleButton">
                    <span style="float: left;">Promedio de lectura critica de los ultimos 5 años:</span> <span id="toggleIcon" style="float: right;">+</span>
                  </button>
                </div>

                <!-- Collapse con 5 inputs -->
                <div class="col-md-12">
                  <div class="collapse" id="collapseForm3">
                    <div class="row">
                      <div class="col-md-2">
                        <label for="extra_input1">Año 2021:</label>
                        <input type="text" class="form-control" id="extra_input1" name="extra_input1">
                      </div>
                      <div class="col-md-2">
                        <label for="extra_input2">Año 2020:</label>
                        <input type="text" class="form-control" id="extra_input2" name="extra_input2">
                      </div>
                      <div class="col-md-2">
                        <label for="extra_input3">Año 2019:</label>
                        <input type="text" class="form-control" id="extra_input3" name="extra_input3">
                      </div>
                      <div class="col-md-2">
                        <label for="extra_input4">Año 2018:</label>
                        <input type="text" class="form-control" id="extra_input4" name="extra_input4">
                      </div>
                      <div class="col-md-2">
                        <label for="extra_input4">Año 2018:</label>
                        <input type="text" class="form-control" id="extra_input4" name="extra_input4">
                      </div>
                    </div>
                  </div>
                  <br>
                </div>
                <br>
                <div class="col-md-12">
                  <button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#collapseForm4" aria-expanded="false" aria-controls="collapseForm4" id="toggleButton">
                    <span style="float: left;">Promedio de ciencias sociales de los ultimos 5 años:</span> <span id="toggleIcon" style="float: right;">+</span>
                  </button>
                </div>

                <!-- Collapse con 5 inputs -->
                <div class="col-md-12">
                  <div class="collapse" id="collapseForm4">
                    <div class="row">
                      <div class="col-md-2">
                        <label for="extra_input1">Año 2021:</label>
                        <input type="text" class="form-control" id="extra_input1" name="extra_input1">
                      </div>
                      <div class="col-md-2">
                        <label for="extra_input2">Año 2020:</label>
                        <input type="text" class="form-control" id="extra_input2" name="extra_input2">
                      </div>
                      <div class="col-md-2">
                        <label for="extra_input3">Año 2019:</label>
                        <input type="text" class="form-control" id="extra_input3" name="extra_input3">
                      </div>
                      <div class="col-md-2">
                        <label for="extra_input4">Año 2018:</label>
                        <input type="text" class="form-control" id="extra_input4" name="extra_input4">
                      </div>
                      <div class="col-md-2">
                        <label for="extra_input4">Año 2018:</label>
                        <input type="text" class="form-control" id="extra_input4" name="extra_input4">
                      </div>
                    </div>
                  </div>
                  <br>
                </div>
                <br>
                <div class="col-md-12">
                  <button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#collapseForm5" aria-expanded="false" aria-controls="collapseForm5" id="toggleButton">
                    <span style="float: left;">Promedio de ciencias naturales de los ultimos 5 años:</span> <span id="toggleIcon" style="float: right;">+</span>
                  </button>
                </div>

                <!-- Collapse con 5 inputs -->
                <div class="col-md-12">
                  <div class="collapse" id="collapseForm5">
                    <div class="row">
                      <div class="col-md-2">
                        <label for="extra_input1">Año 2021:</label>
                        <input type="text" class="form-control" id="extra_input1" name="extra_input1">
                      </div>
                      <div class="col-md-2">
                        <label for="extra_input2">Año 2020:</label>
                        <input type="text" class="form-control" id="extra_input2" name="extra_input2">
                      </div>
                      <div class="col-md-2">
                        <label for="extra_input3">Año 2019:</label>
                        <input type="text" class="form-control" id="extra_input3" name="extra_input3">
                      </div>
                      <div class="col-md-2">
                        <label for="extra_input4">Año 2018:</label>
                        <input type="text" class="form-control" id="extra_input4" name="extra_input4">
                      </div>
                      <div class="col-md-2">
                        <label for="extra_input4">Año 2018:</label>
                        <input type="text" class="form-control" id="extra_input4" name="extra_input4">
                      </div>
                    </div>
                  </div>
                  <br>
                </div>
                <br>
                <div class="col-md-12">
                  <button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#collapseForm6" aria-expanded="false" aria-controls="collapseForm6" id="toggleButton">
                    <span style="float: left;">Promedio de ingles de los ultimos 5 años:</span> <span id="toggleIcon" style="float: right;">+</span>
                  </button>
                </div>

                <!-- Collapse con 5 inputs -->
                <div class="col-md-12">
                  <div class="collapse" id="collapseForm6">
                    <div class="row">
                      <div class="col-md-2">
                        <label for="extra_input1">Año 2021:</label>
                        <input type="text" class="form-control" id="extra_input1" name="extra_input1">
                      </div>
                      <div class="col-md-2">
                        <label for="extra_input2">Año 2020:</label>
                        <input type="text" class="form-control" id="extra_input2" name="extra_input2">
                      </div>
                      <div class="col-md-2">
                        <label for="extra_input3">Año 2019:</label>
                        <input type="text" class="form-control" id="extra_input3" name="extra_input3">
                      </div>
                      <div class="col-md-2">
                        <label for="extra_input4">Año 2018:</label>
                        <input type="text" class="form-control" id="extra_input4" name="extra_input4">
                      </div>
                      <div class="col-md-2">
                        <label for="extra_input4">Año 2018:</label>
                        <input type="text" class="form-control" id="extra_input4" name="extra_input4">
                      </div>
                    </div>
                  </div>
                  <br>
                </div>
              </div>
              <br>
              <button type="submit" class="btn btn-primary">Actualizar</button>
              <a type="button" href="../Tabla-Colegios.php" class="btn btn-success">Volver</a>
          </form>
        </div>

    <?php
      } else {
        echo 'No se encontró ningún colegio con ese ID.';
      }

      // Cerrar la conexión a la base de datos
      $conn->close();
    } else {
      echo 'ID no válido.';
    }
    ?>
  </div>
  <script>
    // Obtener referencias al botón y al ícono
    const toggleButton = document.getElementById('toggleButton');
    const toggleIcon = document.getElementById('toggleIcon');

    // Agregar un event listener para cambiar el ícono
    toggleButton.addEventListener('click', function() {
      if (toggleIcon.innerText === '+') {
        toggleIcon.innerText = '-';
      } else {
        toggleIcon.innerText = '+';
      }
    });

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

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>