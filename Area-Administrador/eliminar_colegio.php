<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "proyectodb";

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Obtener el ID del colegio a eliminar desde la URL
if (isset($_GET['id'])) {
    $id_colegio = $_GET['id'];

    // Obtener la ruta del logo
    $sql_logo = "SELECT logo FROM colegios WHERE id_colegios = $id_colegio";
    $result_logo = $conn->query($sql_logo);
    if ($result_logo->num_rows > 0) {
        $row_logo = $result_logo->fetch_assoc();
        $logo_path = $row_logo['logo'];

        // Eliminar el colegio de la base de datos
        $sql_eliminar_colegio = "DELETE FROM colegios WHERE id_colegios = $id_colegio";
        if ($conn->query($sql_eliminar_colegio) === TRUE) {
            // Eliminar el logo de la carpeta
            if (file_exists($logo_path)) {
                unlink($logo_path);
                ?>
                <script type="text/javascript">alert("Colegio y Logo Borrado Correctamente "); window.location.href = "Tabla-Colegios.php";</script>
                <?php
            } else {
                ?>
                <script type="text/javascript">alert("Colegio eliminado, pero el logo no pudo ser encontrado para eliminar."); window.location.href = "Tabla-Colegios.php";</script>
                <?php
            }
        } else {
            echo "Error al eliminar el colegio: " . $conn->error;
        }
    } else {
        echo "No se encontró un logo asociado al colegio.";
    }
} else {
    echo "ID de colegio no proporcionado.";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
