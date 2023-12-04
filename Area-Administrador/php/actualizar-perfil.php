<?php
session_start();

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyectodb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Obtén el ID de usuario de la sesión
$idUsuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && $idUsuario) {
    // Recupera los datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $cedula = $_POST['cedula'];
    $telefono = $_POST['telefono'];

    // Actualiza los datos en la base de datos
    $sqlUpdate = "UPDATE usuarios SET nombre='$nombre', correo='$correo', cedula='$cedula', telefono='$telefono' WHERE id_usuario=$idUsuario";

    if ($conn->query($sqlUpdate) === TRUE) {
        ?>
        <script type="text/javascript">alert("Datos actualizados correctamente..");window.location.href = "../perfil.php";</script>
        <?php
    } else {
        echo "Error al actualizar los datos: " . $conn->error;
    }

    // Subir la nueva foto de perfil si se proporcionó
    if ($_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
        $nombreArchivo = $_FILES['foto_perfil']['name'];
        $rutaArchivo = '../logos-perfil/' . $nombreArchivo;
        move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $rutaArchivo);

        // Actualiza la ruta de la foto de perfil en la base de datos
        $sqlFoto = "UPDATE usuarios SET foto_de_perfil='$rutaArchivo' WHERE id_usuario=$idUsuario";
        $conn->query($sqlFoto);
    } elseif ($_FILES['foto_perfil']['error'] !== UPLOAD_ERR_NO_FILE) {
        echo "Error al subir la foto de perfil.";
    }
} else {
    echo "Acceso no permitido.";
}

$conn->close();
?>
