<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="shortcut icon" href="../Imagenes/icono.png" />
  <style>
    body {
      background-image: url('img/fondo.jpg');
      background-size: cover;
      background-repeat: no-repeat;
    }
    footer {
      position: fixed;
      bottom: 0;
      width: 100%;
      background-color: black;
      color: white;
    }
    nav {
      background-color: #FFF000;
    }
  </style>
</head>
<body>

<?php
include "php/validar_sesion.php";
?>

<nav class="navbar" style="background-color: #04AA6D; padding: 10px;">
  <a class="navbar-brand" href="#">
    <img src="img/ESCUDO-COLOR-H.png" width="140" height="65" class="d-inline-block align-top" alt="Logo">
  </a>
</nav>

<div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center">Ingresa a tu cuenta</h5>
            <form action="php/validar_sesion.php" method="post">
              <div class="form-group">
                <label for="correo">Correo electrónico</label>
                <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo electrónico" required>
              </div>
              <div class="form-group">
                <label for="contrasena">Contraseña</label>
                <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Contraseña" required>
              </div>
              <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
              <a href="../index.html" type="button" class="btn btn-success btn-block">Volver</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


<footer class="text-center py-4">
  <img src="img/logo-blanco.png" width="200" height="80" alt="Logo">
  <p>Contacto: correo@example.com</p>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
