<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar a la base de datos
    $conn = new mysqli('localhost', 'root', '', 'proyectodb');
    
    // Verifica la conexión
    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }
    
    $id_colegios = $_POST['id_colegios'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion']; 
    $total_estudiantes = $_POST['total_estudiantes']; 
    $tipo_de_colegio = $_POST['tipo_de_colegio'];
    $jornada_completa = isset($_POST['jornada_completa']) ? $_POST['jornada_completa'] : '';
    $jornada_tarde = isset($_POST['jornada_tarde']) ? $_POST['jornada_tarde'] : '';
    $jornada_manana = isset($_POST['jornada_manana']) ? $_POST['jornada_manana'] : '';
    $jornada_noche = isset($_POST['jornada_noche']) ? $_POST['jornada_noche'] : '';
    $jornada_sabatina = isset($_POST['jornada_sabatina']) ? $_POST['jornada_sabatina'] : '';
    
    $colegios_icfes_prom_global = isset($_POST['colegios_icfes_prom_global']) ? $_POST['colegios_icfes_prom_global'] : '';
    $colegios_icfes_prom_matematicas = isset($_POST['colegios_icfes_prom_matematicas']) ? $_POST['colegios_icfes_prom_matematicas'] : '';
    $colegios_icfes_prom_lectura = isset($_POST['colegios_icfes_prom_lectura']) ? $_POST['colegios_icfes_prom_lectura'] : '';
    $colegios_icfes_prom_sociales = isset($_POST['colegios_icfes_prom_sociales']) ? $_POST['colegios_icfes_prom_sociales'] : '';
    $colegios_icfes_prom_cienciasn = isset($_POST['colegios_icfes_prom_cienciasn']) ? $_POST['colegios_icfes_prom_cienciasn'] : '';
    $colegios_icfes_prom_ingles = isset($_POST['colegios_icfes_prom_ingles']) ? $_POST['colegios_icfes_prom_ingles'] : '';
    

    
// zona logo

if ($_FILES['nuevo_logo']['name']) {
    $nuevo_logo_nombre = $_FILES['nuevo_logo']['name'];
    $nuevo_logo_tmp = $_FILES['nuevo_logo']['tmp_name'];
    $nuevo_logo_ruta = "logos/" . $nuevo_logo_nombre;

    // Obtener la ruta del logo actual
    $sql_obtener_logo_actual = "SELECT logo FROM colegios WHERE id_colegios=$id_colegios";
    $resultado_logo_actual = $conn->query($sql_obtener_logo_actual);

    if ($resultado_logo_actual->num_rows > 0) {
        $fila_logo_actual = $resultado_logo_actual->fetch_assoc();
        $logo_actual = $fila_logo_actual['logo'];

        // Eliminar el logo actual de la carpeta
        if (file_exists($logo_actual)) {
            unlink($logo_actual);
        }
    }

    // Mover el nuevo archivo cargado a la ubicación deseada
    move_uploaded_file($nuevo_logo_tmp, $nuevo_logo_ruta);

    // Actualizar la ruta del logo en la base de datos
    $sql_actualizar_logo = "UPDATE colegios SET logo='$nuevo_logo_ruta' WHERE id_colegios=$id_colegios";

    if ($conn->query($sql_actualizar_logo) === TRUE) {
        echo "Logo actualizado correctamente.";
    } else {
        echo "Error al actualizar el logo: " . $conn->error;
    }
}


// fin


    // Actualizar los datos en la tabla "colegios"
    $sql = "UPDATE colegios SET 
                nombre='$nombre', 
                direccion='$direccion', 
                total_estudiantes='$total_estudiantes', 
                tipo_de_colegio='$tipo_de_colegio' 
            WHERE id_colegios=$id_colegios";
    
    if ($conn->query($sql) === TRUE) {
        ?>
        <script type="text/javascript">alert("Datos del colegio actualizados correctamente.");window.location.href = "Tabla-Colegios-Icfes.php";</script>
        <?php
    } else {
        echo "Error al actualizar los datos del colegio: " . $conn->error;
    }


    
    // Actualizar los datos en la tabla "promedio global"
    if (!empty($colegios_icfes_prom_global)) {
        $sql_check = "SELECT * FROM colegios_icfes_prom_global WHERE id_colegios = $id_colegios";
        $result = $conn->query($sql_check);
        if ($result->num_rows > 0) {
            $sql_colegios_icfes_prom_global = "UPDATE colegios_icfes_prom_global SET promedio_global='$colegios_icfes_prom_global' WHERE id_colegios=$id_colegios";
        } else {
            $sql_colegios_icfes_prom_global = "INSERT INTO colegios_icfes_prom_global (id_colegios, promedio_global) VALUES ('$id_colegios', '$colegios_icfes_prom_global')";
        }

        if ($conn->query($sql_colegios_icfes_prom_global) === TRUE) {
            // echo "Datos del promedio globlal actualizados correctamente.";
        } else {
            echo "Error al actualizar los datos del promedio globlal: " . $conn->error;
        }
    }

    // Actualizar los datos en la tabla "promedio matematicas"
    if (!empty($colegios_icfes_prom_matematicas)) {
        $sql_check = "SELECT * FROM colegios_icfes_prom_matematicas WHERE id_colegios = $id_colegios";
        $result = $conn->query($sql_check);
        if ($result->num_rows > 0) {
            $sql_colegios_icfes_prom_matematicas = "UPDATE colegios_icfes_prom_matematicas SET promedio_matematicas='$colegios_icfes_prom_matematicas' WHERE id_colegios=$id_colegios";
        } else {
            $sql_colegios_icfes_prom_matematicas = "INSERT INTO colegios_icfes_prom_matematicas (id_colegios, promedio_matematicas) VALUES ('$id_colegios', '$colegios_icfes_prom_matematicas')";
        }

        if ($conn->query($sql_colegios_icfes_prom_matematicas) === TRUE) {
            // echo "Datos del promedio de matematicas correctamente.";
        } else {
            echo "Error al actualizar los datos del promedio de matematicas: " . $conn->error;
        }
    }

    // Actualizar los datos en la tabla "lectura critica"
    if (!empty($colegios_icfes_prom_lectura)) {
        $sql_check = "SELECT * FROM colegios_icfes_prom_lectura WHERE id_colegios = $id_colegios";
        $result = $conn->query($sql_check);
        if ($result->num_rows > 0) {
            $sql_colegios_icfes_prom_lectura = "UPDATE colegios_icfes_prom_lectura SET promedio_lectura='$colegios_icfes_prom_lectura' WHERE id_colegios=$id_colegios";
        } else {
            $sql_colegios_icfes_prom_lectura = "INSERT INTO colegios_icfes_prom_lectura (id_colegios, promedio_lectura) VALUES ('$id_colegios', '$colegios_icfes_prom_lectura')";
        }

        if ($conn->query($sql_colegios_icfes_prom_lectura) === TRUE) {
            // echo "Datos del promedio de lectura critica actualizados correctamente.";
        } else {
            echo "Error al actualizar los datos del promedio de lectura critica: " . $conn->error;
        }
    }
    // Actualizar los datos en la tabla "ciencias sociales"
    if (!empty($colegios_icfes_prom_sociales)) {
        $sql_check = "SELECT * FROM colegios_icfes_prom_sociales WHERE id_colegios = $id_colegios";
        $result = $conn->query($sql_check);
        if ($result->num_rows > 0) {
            $sql_colegios_icfes_prom_sociales = "UPDATE colegios_icfes_prom_sociales SET promedio_ciencias_sociales='$colegios_icfes_prom_sociales' WHERE id_colegios=$id_colegios";
        } else {
            $sql_colegios_icfes_prom_sociales = "INSERT INTO colegios_icfes_prom_sociales (id_colegios, promedio_ciencias_sociales) VALUES ('$id_colegios', '$colegios_icfes_prom_sociales')";
        }

        if ($conn->query($sql_colegios_icfes_prom_sociales) === TRUE) {
            // echo "Datos del promedio de ciencias sociales actualizados correctamente.";
        } else {
            echo "Error al actualizar los datos del promedio de ciencias sociales: " . $conn->error;
        }
    }

    // Actualizar los datos en la tabla "Ciencias naturales"
    if (!empty($colegios_icfes_prom_cienciasn)) {
        $sql_check = "SELECT * FROM colegios_icfes_prom_cienciasn WHERE id_colegios = $id_colegios";
        $result = $conn->query($sql_check);
        if ($result->num_rows > 0) {
            $sql_colegios_icfes_prom_cienciasn = "UPDATE colegios_icfes_prom_cienciasn SET promedio_ciencias_naturales='$colegios_icfes_prom_cienciasn' WHERE id_colegios=$id_colegios";
        } else {
            $sql_colegios_icfes_prom_cienciasn = "INSERT INTO colegios_icfes_prom_cienciasn (id_colegios, promedio_ciencias_naturales) VALUES ('$id_colegios', '$colegios_icfes_prom_cienciasn')";
        }

        if ($conn->query($sql_colegios_icfes_prom_cienciasn) === TRUE) {
            // echo "Datos del promedio de ciencias naturales actualizados correctamente.";
        } else {
            echo "Error al actualizar los datos del promedio de ciencias naturales: " . $conn->error;
        }
    }

    // Actualizar los datos en la tabla "ingles"
    if (!empty($colegios_icfes_prom_ingles)) {
        $sql_check = "SELECT * FROM colegios_icfes_prom_ingles WHERE id_colegios = $id_colegios";
        $result = $conn->query($sql_check);
        if ($result->num_rows > 0) {
            $sql_colegios_icfes_prom_ingles = "UPDATE colegios_icfes_prom_ingles SET promedio_ingles='$colegios_icfes_prom_ingles' WHERE id_colegios=$id_colegios";
        } else {
            $sql_colegios_icfes_prom_ingles = "INSERT INTO colegios_icfes_prom_ingles (id_colegios, promedio_ingles) VALUES ('$id_colegios', '$colegios_icfes_prom_ingles')";
        }

        if ($conn->query($sql_colegios_icfes_prom_ingles) === TRUE) {
            // echo "Datos del promedio de ingles actualizados correctamente.";
        } else {
            echo "Error al actualizar los datos del promedio de ingles: " . $conn->error;
        }
    }


    // Cerrar la conexión a la base de datos
    $conn->close();
}
?>
