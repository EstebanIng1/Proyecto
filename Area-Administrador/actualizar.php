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
    $total_2021 = isset($_POST['total_2021']) ? $_POST['total_2021'] : '';
    $total_2020 = isset($_POST['total_2020']) ? $_POST['total_2020'] : '';
    $total_2019 = isset($_POST['total_2019']) ? $_POST['total_2019'] : '';
    $total_2018 = isset($_POST['total_2018']) ? $_POST['total_2018'] : '';
    $total_2017 = isset($_POST['total_2017']) ? $_POST['total_2017'] : '';

    $manana_2021 = isset($_POST['manana_2021']) ? $_POST['manana_2021'] : '';
    $manana_2020 = isset($_POST['manana_2020']) ? $_POST['manana_2020'] : '';
    $manana_2019 = isset($_POST['manana_2019']) ? $_POST['manana_2019'] : '';
    $manana_2018 = isset($_POST['manana_2018']) ? $_POST['manana_2018'] : '';
    $manana_2017 = isset($_POST['manana_2017']) ? $_POST['manana_2017'] : '';

    $tarde_2021 = isset($_POST['tarde_2021']) ? $_POST['tarde_2021'] : '';
    $tarde_2020 = isset($_POST['tarde_2020']) ? $_POST['tarde_2020'] : '';
    $tarde_2019 = isset($_POST['tarde_2019']) ? $_POST['tarde_2019'] : '';
    $tarde_2018 = isset($_POST['tarde_2018']) ? $_POST['tarde_2018'] : '';
    $tarde_2017 = isset($_POST['tarde_2017']) ? $_POST['tarde_2017'] : '';

    $completa_2021 = isset($_POST['completa_2021']) ? $_POST['completa_2021'] : '';
    $completa_2020 = isset($_POST['completa_2020']) ? $_POST['completa_2020'] : '';
    $completa_2019 = isset($_POST['completa_2019']) ? $_POST['completa_2019'] : '';
    $completa_2018 = isset($_POST['completa_2018']) ? $_POST['completa_2018'] : '';
    $completa_2017 = isset($_POST['completa_2017']) ? $_POST['completa_2017'] : '';

    $noche_2021 = isset($_POST['noche_2021']) ? $_POST['noche_2021'] : '';
    $noche_2020 = isset($_POST['noche_2020']) ? $_POST['noche_2020'] : '';
    $noche_2019 = isset($_POST['noche_2019']) ? $_POST['noche_2019'] : '';
    $noche_2018 = isset($_POST['noche_2018']) ? $_POST['noche_2018'] : '';
    $noche_2017 = isset($_POST['noche_2017']) ? $_POST['noche_2017'] : '';
    
    $sabatina_2021 = isset($_POST['sabatina_2021']) ? $_POST['sabatina_2021'] : '';
    $sabatina_2020 = isset($_POST['sabatina_2020']) ? $_POST['sabatina_2020'] : '';
    $sabatina_2019 = isset($_POST['sabatina_2019']) ? $_POST['sabatina_2019'] : '';
    $sabatina_2018 = isset($_POST['sabatina_2018']) ? $_POST['sabatina_2018'] : '';
    $sabatina_2017 = isset($_POST['sabatina_2017']) ? $_POST['sabatina_2017'] : '';
    

// Zona colegio repetido


 // Obtén el nombre actual del colegio de la base de datos
 $sql_obtener_nombre_actual = "SELECT nombre FROM colegios WHERE id_colegios = $id_colegios";
 $resultado_nombre_actual = $conn->query($sql_obtener_nombre_actual);
 $fila_nombre_actual = $resultado_nombre_actual->fetch_assoc();
 $nombre_actual = $fila_nombre_actual['nombre'];

 // Verifica si el nombre ha cambiado antes de verificar si ya está registrado
 if ($nombre !== $nombre_actual) {
     // Verifica si el colegio ya está registrado por su nombre
     $sql_verificar_colegio = "SELECT COUNT(*) as count FROM colegios WHERE nombre = '$nombre'";
     $result_verificar_colegio = $conn->query($sql_verificar_colegio);
     $row_verificar_colegio = $result_verificar_colegio->fetch_assoc();

     if ($row_verificar_colegio['count'] > 0) {
         ?>
         <script>alert("ERROR AL ACTUALIZAR EL COLEGIO! Ya existe un colegio registrado con ese nombre: <?php echo "$nombre"; ?>");window.location.href = "Tabla-Colegios.php";</script>
         <?php
         exit(); // Detiene el proceso de actualización
     }
 }


// fin



// zona logo

if ($_FILES['nuevo_logo']['name']) {
    // Obtener el nuevo nombre del archivo del logo
    $nuevo_logo_nombre = "COLEGIO_LOGO_" . str_replace(' ', '_', $nombre) . '.' . pathinfo($_FILES['nuevo_logo']['name'], PATHINFO_EXTENSION);
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
    if (move_uploaded_file($_FILES['nuevo_logo']['tmp_name'], $nuevo_logo_ruta)) {
        // Actualizar la ruta del logo en la base de datos con el nuevo nombre
        $sql_actualizar_logo = "UPDATE colegios SET logo='$nuevo_logo_ruta' WHERE id_colegios=$id_colegios";

        if ($conn->query($sql_actualizar_logo) === TRUE) {
            echo "Logo actualizado correctamente.";
        } else {
            echo "Error al actualizar el logo: " . $conn->error;
        }
    } else {
        echo "Error al mover el archivo del logo.";
    }
}

//FIN



    // Actualizar los datos en la tabla "colegios"
    $sql = "UPDATE colegios SET 
                nombre='$nombre', 
                direccion='$direccion', 
                total_estudiantes='$total_estudiantes', 
                tipo_de_colegio='$tipo_de_colegio' 
            WHERE id_colegios=$id_colegios";
    
    if ($conn->query($sql) === TRUE) {
        ?>
        <script type="text/javascript">alert("Datos del colegio actualizados correctamente.");window.location.href = "Tabla-Colegios.php";</script>
        <?php
    } else {
        echo "Error al actualizar los datos del colegio: " . $conn->error;
    }

    // Actualizar los datos en la tabla "jornada_tarde"
    if (!empty($jornada_tarde)) {
        $sql_check = "SELECT * FROM jornada_tarde WHERE id_colegios = $id_colegios";
        $result = $conn->query($sql_check);
        if ($result->num_rows > 0) {
            $sql_jornada_tarde = "UPDATE jornada_tarde SET estudiantes_tarde='$jornada_tarde' WHERE id_colegios=$id_colegios";
        } else {
            $sql_jornada_tarde = "INSERT INTO jornada_tarde (id_colegios, estudiantes_tarde) VALUES ('$id_colegios', '$jornada_tarde')";
        }

        if ($conn->query($sql_jornada_tarde) === TRUE) {
            // echo "Datos de jornada tarde actualizados correctamente.";
        } else {
            echo "Error al actualizar los datos de la jornada tarde: " . $conn->error;
        }
    }

    // Actualizar los datos en la tabla "jornada_manana"
    if (!empty($jornada_manana)) {
        $sql_check = "SELECT * FROM jornada_manana WHERE id_colegios = $id_colegios";
        $result = $conn->query($sql_check);
        if ($result->num_rows > 0) {
            $sql_jornada_manana = "UPDATE jornada_manana SET estudiantes_manana='$jornada_manana' WHERE id_colegios=$id_colegios";
        } else {
            $sql_jornada_manana = "INSERT INTO jornada_manana (id_colegios, estudiantes_manana) VALUES ('$id_colegios', '$jornada_manana')";
        }

        if ($conn->query($sql_jornada_manana) === TRUE) {
            // echo "Datos de jornada mañana actualizados correctamente.";
        } else {
            echo "Error al actualizar los datos de la jornada mañana: " . $conn->error;
        }
    }
    // Actualizar los datos en la tabla "jornada_completa"
    if (!empty($jornada_completa)) {
        $sql_check = "SELECT * FROM jornada_completa WHERE id_colegios = $id_colegios";
        $result = $conn->query($sql_check);
        if ($result->num_rows > 0) {
            $sql_jornada_completa = "UPDATE jornada_completa SET estudiantes_completa='$jornada_completa' WHERE id_colegios=$id_colegios";
        } else {
            $sql_jornada_completa = "INSERT INTO jornada_completa (id_colegios, estudiantes_completa) VALUES ('$id_colegios', '$jornada_completa')";
        }

        if ($conn->query($sql_jornada_completa) === TRUE) {
            // echo "Datos de jornada completa actualizados correctamente.";
        } else {
            echo "Error al actualizar los datos de la jornada completa: " . $conn->error;
        }
    }
    // Actualizar los datos en la tabla "jornada_noche"
    if (!empty($jornada_noche)) {
        $sql_check = "SELECT * FROM jornada_noche WHERE id_colegios = $id_colegios";
        $result = $conn->query($sql_check);
        if ($result->num_rows > 0) {
            $sql_jornada_noche = "UPDATE jornada_noche SET estudiantes_noche='$jornada_noche' WHERE id_colegios=$id_colegios";
        } else {
            $sql_jornada_noche = "INSERT INTO jornada_noche (id_colegios, estudiantes_noche) VALUES ('$id_colegios', '$jornada_noche')";
        }

        if ($conn->query($sql_jornada_noche) === TRUE) {
            // echo "Datos de jornada noche actualizados correctamente.";
        } else {
            echo "Error al actualizar los datos de la jornada noche: " . $conn->error;
        }
    }
    // Actualizar los datos en la tabla "jornada_sabatina"
    if (!empty($jornada_sabatina)) {
        $sql_check = "SELECT * FROM jornada_sabatina WHERE id_colegios = $id_colegios";
        $result = $conn->query($sql_check);
        if ($result->num_rows > 0) {
            $sql_jornada_sabatina = "UPDATE jornada_sabatina SET estudiantes_sabatina='$jornada_sabatina' WHERE id_colegios=$id_colegios";
        } else {
            $sql_jornada_sabatina = "INSERT INTO jornada_sabatina (id_colegios, estudiantes_sabatina) VALUES ('$id_colegios', '$jornada_sabatina')";
        }

        if ($conn->query($sql_jornada_sabatina) === TRUE) {
            // echo "Datos de jornada sabatina actualizados correctamente.";
        } else {
            echo "Error al actualizar los datos de la jornada sabatina: " . $conn->error;
        }
    }

    // Actualizar datos del total de estudiantes de los ultimos 5 años

    if (!empty($total_2021 || $total_2020 || $total_2019 || $total_2018 || $total_2017)) {
        $sql_check = "SELECT * FROM total_estudiantes_5_años WHERE id_colegios = $id_colegios";
        $result = $conn->query($sql_check);
        if ($result->num_rows > 0) {
            $sql_total_5_años = "UPDATE total_estudiantes_5_años SET total_2021='$total_2021', total_2020='$total_2020', total_2019='$total_2019', total_2018='$total_2018', total_2017='$total_2017' WHERE id_colegios=$id_colegios";
        } else {
            $sql_total_5_años = "INSERT INTO total_estudiantes_5_años (id_colegios, total_2021, total_2020, total_2019, total_2018, total_2017) VALUES ('$id_colegios', '$total_2021', '$total_2020', '$total_2019', '$total_2018', '$total_2017')";
        }

        if ($conn->query($sql_total_5_años) === TRUE) {
            echo "Datos de jornada sabatina actualizados correctamente.";
        } else {
            echo "Error al actualizar los datos de la jornada sabatina: " . $conn->error;
        }
    }

    // Actualizar datos de la jornada mañana de los ultimos 5 años

    if (!empty($manana_2021 || $manana_2020 || $manana_2019 || $manana_2018 || $manana_2017)) {
        $sql_check = "SELECT * FROM jornada_manana_5_años WHERE id_colegios = $id_colegios";
        $result = $conn->query($sql_check);
        if ($result->num_rows > 0) {
            $sql_manana_5_años = "UPDATE jornada_manana_5_años SET manana_2021='$manana_2021', manana_2020='$manana_2020', manana_2019='$manana_2019', manana_2018='$manana_2018', manana_2017='$manana_2017' WHERE id_colegios=$id_colegios";
        } else {
            $sql_manana_5_años = "INSERT INTO jornada_manana_5_años (id_colegios, manana_2021, manana_2020, manana_2019, manana_2018, manana_2017) VALUES ('$id_colegios', '$manana_2021', '$manana_2020', '$manana_2019', '$manana_2018', '$manana_2017')";
        }

        if ($conn->query($sql_manana_5_años) === TRUE) {
            echo "Datos de jornada sabatina actualizados correctamente.";
        } else {
            echo "Error al actualizar los datos de la jornada sabatina: " . $conn->error;
        }
    }
    
    // Actualizar datos de la jornada tarde de los ultimos 5 años
    
    if (!empty($tarde_2021 || $tarde_2020 || $tarde_2019 || $tarde_2018 || $tarde_2017)) {
        $sql_check = "SELECT * FROM jornada_tarde_5_años WHERE id_colegios = $id_colegios";
        $result = $conn->query($sql_check);
        if ($result->num_rows > 0) {
            $sql_tarde_5_años = "UPDATE jornada_tarde_5_años SET tarde_2021='$tarde_2021', tarde_2020='$tarde_2020', tarde_2019='$tarde_2019', tarde_2018='$tarde_2018', tarde_2017='$tarde_2017' WHERE id_colegios=$id_colegios";
        } else {
            $sql_tarde_5_años = "INSERT INTO jornada_tarde_5_años (id_colegios, tarde_2021, tarde_2020, tarde_2019, tarde_2018, tarde_2017) VALUES ('$id_colegios', '$tarde_2021', '$tarde_2020', '$tarde_2019', '$tarde_2018', '$tarde_2017')";
        }

        if ($conn->query($sql_tarde_5_años) === TRUE) {
            echo "Datos de jornada sabatina actualizados correctamente.";
        } else {
            echo "Error al actualizar los datos de la jornada sabatina: " . $conn->error;
        }
    }

    // Actualizar datos de la jornada completa de los ultimos 5 años

    if (!empty($completa_2021 || $completa_2020 || $completa_2019 || $completa_2018 || $completa_2017)) {
        $sql_check = "SELECT * FROM jornada_completa_5_años WHERE id_colegios = $id_colegios";
        $result = $conn->query($sql_check);
        if ($result->num_rows > 0) {
            $sql_completa_5_años = "UPDATE jornada_completa_5_años SET completa_2021='$completa_2021', completa_2020='$completa_2020', completa_2019='$completa_2019', completa_2018='$completa_2018', completa_2017='$completa_2017' WHERE id_colegios=$id_colegios";
        } else {
            $sql_completa_5_años = "INSERT INTO jornada_completa_5_años (id_colegios, completa_2021, completa_2020, completa_2019, completa_2018, completa_2017) VALUES ('$id_colegios', '$completa_2021', '$completa_2020', '$completa_2019', '$completa_2018', '$completa_2017')";
        }

        if ($conn->query($sql_completa_5_años) === TRUE) {
            echo "Datos de jornada sabatina actualizados correctamente.";
        } else {
            echo "Error al actualizar los datos de la jornada sabatina: ". $conn->error;
        }
    }

    // Actualizar datos de la jornada noche de los ultimos 5 años

    if (!empty($noche_2021 || $noche_2020 || $noche_2019 || $noche_2018 || $noche_2017)) {
        $sql_check = "SELECT * FROM jornada_noche_5_años WHERE id_colegios = $id_colegios";
        $result = $conn->query($sql_check);
        if ($result->num_rows > 0) {
            $sql_noche_5_años = "UPDATE jornada_noche_5_años SET noche_2021='$noche_2021', noche_2020='$noche_2020', noche_2019='$noche_2019', noche_2018='$noche_2018', noche_2017='$noche_2017' WHERE id_colegios=$id_colegios";
        } else {
            $sql_noche_5_años = "INSERT INTO jornada_noche_5_años (id_colegios, noche_2021, noche_2020, noche_2019, noche_2018, noche_2017) VALUES ('$id_colegios', '$noche_2021', '$noche_2020', '$noche_2019', '$noche_2018', '$noche_2017')";
        }

        if ($conn->query($sql_noche_5_años) === TRUE) {
            echo "Datos de jornada sabatina actualizados correctamente.";
        } else {
            echo "Error al actualizar los datos de la jornada sabatina: " . $conn->error;
        }
    }

    // Actualizar datos de la jornada sabatina de los ultimos 5 años 

    if (!empty($sabatina_2021 || $sabatina_2020 || $sabatina_2019 || $sabatina_2018 || $sabatina_2017)) {
        $sql_check = "SELECT * FROM  jornada_sabatina_5_años WHERE id_colegios = $id_colegios";
        $result = $conn->query($sql_check);
        if ($result->num_rows > 0) {
            $sql_sabatina_5_años = "UPDATE  jornada_sabatina_5_años SET sabatina_2021='$sabatina_2021', sabatina_2020='$sabatina_2020', sabatina_2019='$sabatina_2019', sabatina_2018='$sabatina_2018', sabatina_2017='$sabatina_2017' WHERE id_colegios=$id_colegios";
        } else {
            $sql_sabatina_5_años = "INSERT INTO  jornada_sabatina_5_años (id_colegios, sabatina_2021, sabatina_2020, sabatina_2019, sabatina_2018, sabatina_2017) VALUES ('$id_colegios', '$sabatina_2021', '$sabatina_2020', '$sabatina_2019', '$sabatina_2018', '$sabatina_2017')";
        }

        if ($conn->query($sql_sabatina_5_años) === TRUE) {
            echo "Datos de jornada sabatina actualizados correctamente.";
        } else {
            echo "Error al actualizar los datos de la jornada sabatina: " . $conn->error;
        }
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
}
?>
