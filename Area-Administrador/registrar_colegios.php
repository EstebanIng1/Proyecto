<?php


include "php/conexion.php";

// Verifica si se reciben los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén los datos del formulario
    $nombre = $_POST['nombreColegio'];
    $totalEstudiantes = $_POST['totalEstudiantes'];
    $tipoColegio = $_POST['tipoColegio'];
    $direccion = $_POST['direccion'];

    // Verifica si el colegio ya está registrado por su nombre
    $sql_verificar_colegio = "SELECT COUNT(*) as count FROM colegios WHERE nombre = '$nombre'";
    $result_verificar_colegio = $conn->query($sql_verificar_colegio);
    $row_verificar_colegio = $result_verificar_colegio->fetch_assoc();

    if ($row_verificar_colegio['count'] > 0) {
?>
        <script>
            alert("El colegio <?php echo "$nombre"; ?> ya se encuentra registrado");
            window.location.href = "Tabla-Colegios.php";
        </script>
    <?php
        exit(); // Detiene el proceso de inserción
    }

    // SECCION LOGOS 

    // Logo del colegio (carga de archivo)
    $logo_nombre = $_FILES['logo']['name'];
    $logo_tmp = $_FILES['logo']['tmp_name'];

    // Generar un nuevo nombre para el archivo del logo
    $nuevo_nombre_logo = "COLEGIO_LOGO_$nombre";  // Aquí generamos el nuevo nombre

    // Obtener la extensión del archivo
    $extension = pathinfo($logo_nombre, PATHINFO_EXTENSION);

    // Ruta con el nuevo nombre y extensión
    $logo_ruta = "logos/$nuevo_nombre_logo.$extension";

    // Mueve el archivo cargado a la ubicación deseada
    move_uploaded_file($logo_tmp, $logo_ruta);



    // FIN        
    // Inserta los datos en la tabla colegios
    $sql_colegios = "INSERT INTO colegios (nombre, total_estudiantes, tipo_de_colegio, direccion, logo)
                        VALUES ('$nombre', '$totalEstudiantes', '$tipoColegio', '$direccion', '$logo_ruta')";
    if ($conn->query($sql_colegios) === TRUE) {
    ?>
        <script type="text/javascript">
            alert("Colegio Registrado Correctamente");
            window.location.href = "Tabla-Colegios.php";
        </script>
    <?php
        $id_colegio = $conn->insert_id;
    } else {
        // echo "Error al registrar en la tabla colegios: " . $conn->error;
    ?>
        <script type="text/javascript">
            alert(<?php "Error al registrar en la tabla colegios: " . $conn->error; ?>);
            window.location.href = "Tabla-Colegios.php";
        </script>
<?php
    }

    if (isset($_POST['estudiantes_manana'])) {
        $estudiantes_manana = $_POST['estudiantes_manana'];
    } else {
        $estudiantes_manana = 0; // Establece un valor predeterminado o maneja el caso de que no se haya establecido en el formulario
    }

    // Obtener el valor de estudiantes_tarde (si se estableció en el formulario)
    if (isset($_POST['estudiantes_tarde'])) {
        $estudiantes_tarde = $_POST['estudiantes_tarde'];
    } else {
        $estudiantes_tarde = 0; // Establece un valor predeterminado o maneja el caso de que no se haya establecido en el formulario
    }

    // Obtener el valor de estudiantes_completa (si se estableció en el formulario)
    if (isset($_POST['estudiantes_completa'])) {
        $estudiantes_completa = $_POST['estudiantes_completa'];
    } else {
        $estudiantes_completa = 0; // Establece un valor predeterminado o maneja el caso de que no se haya establecido en el formulario
    }

    // Obtener el valor de estudiantes_noche (si se estableció en el formulario)
    if (isset($_POST['estudiantes_noche'])) {
        $estudiantes_noche = $_POST['estudiantes_noche'];
    } else {
        $estudiantes_noche = 0; // Establece un valor predeterminado o maneja el caso de que no se haya establecido en el formulario
    }

    // Obtener el valor de estudiantes_sabatina (si se estableció en el formulario)
    if (isset($_POST['estudiantes_sabatina'])) {
        $estudiantes_sabatina = $_POST['estudiantes_sabatina'];
    } else {
        $estudiantes_sabatina = 0; // Establece un valor predeterminado o maneja el caso de que no se haya establecido en el formulario
    }

    // Inserta los datos de las jornadas en las tablas respectivas
    $sql_insert_jornada_manana = "INSERT INTO jornada_manana (id_colegios, estudiantes_manana) VALUES ($id_colegio, $estudiantes_manana)";
    $sql_insert_jornada_tarde = "INSERT INTO jornada_tarde (id_colegios, estudiantes_tarde) VALUES ($id_colegio, $estudiantes_tarde)";
    $sql_insert_jornada_completa = "INSERT INTO jornada_completa (id_colegios, estudiantes_completa) VALUES ($id_colegio, $estudiantes_completa)";
    $sql_insert_jornada_noche = "INSERT INTO jornada_noche (id_colegios, estudiantes_noche) VALUES ($id_colegio, $estudiantes_noche)";
    $sql_insert_jornada_sabatina = "INSERT INTO jornada_sabatina (id_colegios, estudiantes_sabatina) VALUES ($id_colegio, $estudiantes_sabatina)";

    // Inserta datos en las tablas de jornadas
    $conn->query($sql_insert_jornada_manana);
    $conn->query($sql_insert_jornada_tarde);
    $conn->query($sql_insert_jornada_completa);
    $conn->query($sql_insert_jornada_noche);
    $conn->query($sql_insert_jornada_sabatina);

    exit();
}
?>