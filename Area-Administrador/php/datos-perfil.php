<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");  // Redirige a la página de inicio de sesión si no está autenticado
    exit();
}

// Obtener el resto de los datos del usuario desde la base de datos
if (isset($_SESSION['id_usuario'])) {
    $idUsuario = $_SESSION['id_usuario'];
    
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

    // Consulta para obtener los datos del usuario
    $sql = "SELECT nombre, correo, cedula, telefono FROM usuarios WHERE id_usuario = $idUsuario";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombreUsuario = $row['nombre'];
        $correoUsuario = $row['correo'];
        $cedulaUsuario = $row['cedula'];
        $telefonoUsuario = $row['telefono'];
    } else {
        // Manejo de error si no se encuentra el usuario
        $nombreUsuario = 'Usuario no encontrado';
        $correoUsuario = 'Correo no encontrado';
        $cedulaUsuario = 'Cédula no encontrada';
        $telefonoUsuario = 'Teléfono no encontrado';
    }

    // Consulta para obtener la ruta de la imagen de perfil
$sqlFotoPerfil = "SELECT foto_de_perfil FROM usuarios WHERE id_usuario = $idUsuario";
$resultFotoPerfil = $conn->query($sqlFotoPerfil);

if ($resultFotoPerfil) {
    // Verifica si hay resultados
    if ($resultFotoPerfil->num_rows > 0) {
        $rowFotoPerfil = $resultFotoPerfil->fetch_assoc();
        $rutaImagenPerfil = $rowFotoPerfil['foto_de_perfil'];
    } else {
        $rutaImagenPerfil = 'ruta_por_defecto_perfil.jpg';  // Si no hay una imagen de perfil definida, puedes usar una imagen por defecto
    }
} else {
    // Manejo de errores en la consulta
    $rutaImagenPerfil = '../img/logo_usuario_defecto.png';  // Puedes definir una imagen por defecto
    echo "Error en la consulta: " . $conn->error;
}

    $conn->close();
} else {
    // Si no hay sesión iniciada, mostrar datos predeterminados
    $nombreUsuario = 'usuarioejemplo';
    $correoUsuario = 'usuario@example.com';
    $cedulaUsuario = '123456789';
    $telefonoUsuario = '123-456-7890';
}



?>