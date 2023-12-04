<?php

include "conexion.php";

session_start();

if (isset($_POST['update_password'])) {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    // Validar que las contraseñas coincidan
    if ($new_password !== $confirm_new_password) {
        echo "Las contraseñas no coinciden. Por favor, inténtelo de nuevo.";
    } else {
        // Validar la contraseña antigua
        $user_id = $_SESSION['id_usuario'];
        $old_password_hashed = hash('sha256', $old_password);  // Hashear la contraseña antigua

        // Consultar la contraseña actual del usuario en la base de datos
        $sql = "SELECT contrasena FROM usuarios WHERE id_usuario = $user_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stored_password = $row['contrasena'];

            // Verificar si la contraseña antigua es correcta
            if ($old_password_hashed === $stored_password) {
                // Hashear la nueva contraseña
                $new_password_hashed = hash('sha256', $new_password);

                // Actualizar la contraseña en la base de datos
                $update_sql = "UPDATE usuarios SET contrasena = '$new_password_hashed' WHERE id_usuario = $user_id";
                if ($conn->query($update_sql) === TRUE) {
                    echo "Contraseña actualizada con éxito.";
                } else {
                    echo "Error al actualizar la contraseña: " . $conn->error;
                }
            } else {
                echo "La contraseña antigua no es correcta. Por favor, inténtelo de nuevo.";
            }
        } else {
            echo "No se pudo encontrar al usuario.";
        }
    }
}

$conn->close();
