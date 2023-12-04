<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Obtén los datos del formulario
    $correo = isset($_POST['correo']) ? $_POST['correo'] : null;
    $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : null;

    // Consulta para verificar las credenciales
    $sql = "SELECT id_usuario, nombre FROM usuarios WHERE correo = '$correo' AND contraseña = '$contrasena'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Inicio de sesión exitoso
        $row = $result->fetch_assoc();
        $_SESSION['id_usuario'] = $row['id_usuario'];
        $_SESSION['nombre'] = $row['nombre'];
        header("Location: ../Tabla-Colegios.php"); // Reemplaza 'otra_pagina.php' con la página a la que deseas redirigir
        exit();
    } else {
        echo "Credenciales incorrectas. <a href='../login.php'>Volver al inicio de sesión</a>";
    }

    $conn->close();
} 
// else {
//     echo "Acceso no permitido.";
// }
?>
