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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="container">
  <h2>Editar Colegio</h2>
  
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

      
      if ($result ->num_rows > 0) {
          $row = $result->fetch_assoc();
          // Mostrar el formulario para editar los datos
          echo '<form action="../actualizar-icfes.php" method="POST" enctype="multipart/form-data">';
          echo '<input type="hidden" name="id_colegios" value="' . $row['id_colegios'] . '">';
          echo '<div class="form-group">';
          echo '<label for="nombre">Nombre:</label>';
          echo '<input type="text" class="form-control" id="nombre" name="nombre" value="' . $row['nombre'] . '">';
          echo '<label for="nombre">Direccion:</label>';
          echo '<input type="text" class="form-control" id="direccion" name="direccion" value="' . $row['direccion'] . '">';
          echo '<label for="nombre">Total Estudiantes:</label>';
          echo '<input type="number" class="form-control" id="total_estudiantes" name="total_estudiantes" value="' . $row['total_estudiantes'] . '">';
          echo '<br>';

        //  inicio funcion select 

        echo '<label for="nombre">Selecciona un tipo de colegio:</label>';
echo '<br>';
echo '<select class="form-select" aria-label="Default select example" id="tipo_de_colegio" name="tipo_de_colegio" required>';

// Opción por defecto
echo '<option value="" disabled>SELECCIONA UN TIPO DE COLEGIO</option>';

// Opciones de tipo de colegio
$options = array("OFICIAL", "NO OFICIAL");
foreach ($options as $option) {
    $selected = ($row['tipo_de_colegio'] === $option) ? 'selected' : '';
    echo '<option value="' . $option . '" ' . $selected . '>' . $option . '</option>';
}

echo '</select> <br> <br>';

        // fin

        echo '<label for="logo">Logo:</label>';
        echo '<input type="file" class="form-control" id="nuevo_logo" name="nuevo_logo" accept="image/*">';

          echo '<br>';
          echo '<label for="nombre">Promedio Global:</label>';
          echo '<input type="number" class="form-control" id="colegios_icfes_prom_global" name="colegios_icfes_prom_global" value="' . $row['promedio_global'] . '" required>';  

          echo '<label for="nombre">Promedio de matematicas:</label>';
          echo '<input type="number" class="form-control" id="colegios_icfes_prom_matematicas" name="colegios_icfes_prom_matematicas" value="' . $row['promedio_matematicas'] . '"required>';  

          echo '<label for="nombre">Promedio de lectura critica:</label>';
          echo '<input type="number" class="form-control" id="colegios_icfes_prom_lectura" name="colegios_icfes_prom_lectura" value="' . $row['promedio_lectura'] . '"required>';  
          
          echo '<label for="nombre">Promedio de ciencias sociales:</label>';
          echo '<input type="number" class="form-control" id="colegios_icfes_prom_sociales" name="colegios_icfes_prom_sociales" value="' . $row['promedio_ciencias_sociales'] . '"required>';  
          
          echo '<label for="nombre">Promedio de ciencias naturales:</label>';
          echo '<input type="number" class="form-control" id="colegios_icfes_prom_cienciasn" name="colegios_icfes_prom_cienciasn" value="' . $row['promedio_ciencias_naturales'] . '"required>';  
          
          echo '<label for="nombre">Promedio de ingles :</label>';
          echo '<input type="number" class="form-control" id="colegios_icfes_prom_ingles" name="colegios_icfes_prom_ingles" value="' . $row['promedio_ingles'] . '"required>';  

          echo '</div>';
 
          echo '<button type="submit" class="btn btn-primary">Actualizar</button>';
          echo '    <a type="button" href="../Tabla-Colegios-Icfes.php" class="btn btn-success">Volver</a>';
          echo '</form>';
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

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
