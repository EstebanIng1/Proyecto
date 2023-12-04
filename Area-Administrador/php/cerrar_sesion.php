<?php
session_start();

// Limpiar las variables de sesión
$_SESSION = array();

// Destruir la sesión
session_destroy();

// Redirigir a la página de inicio de sesión u otra página
header("Location: ../../index.html");
exit();
?>
