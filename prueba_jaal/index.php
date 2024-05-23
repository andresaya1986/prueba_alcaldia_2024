<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<?php
    session_start();
    $loggedIn = isset($_SESSION['user_id']);
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">MiSitio</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <?php if ($loggedIn): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Cerrar Sesión</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Iniciar Sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Registrarse</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h2 class="mt-5">Formulario de Registro</h2>
        <form id="registroForm">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo Electrónico</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña</label>
                <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                <small class="form-text text-muted">
                    La contraseña debe tener al menos 8 caracteres, una letra mayúscula, una minúscula y un número.
                </small>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
        <div id="respuesta" class="mt-3"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#registroForm').on('submit', function(event) {
                event.preventDefault(); // Evitar el envío del formulario

                var contrasena = $('#contrasena').val();
                var contrasenaRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;

                if (!contrasenaRegex.test(contrasena)) {
					console.log(contrasena);
                    alert('La contraseña debe tener al menos 8 caracteres, una letra mayúscula, una minúscula y un número.');
                    return;
                }

                $.ajax({
                    url: 'registro.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#respuesta').html('<div class="alert alert-success">' + response.message + '</div>');
                    },
                    error: function(xhr, status, error) {
                        $('#respuesta').html('<div class="alert alert-danger">Ocurrió un error: ' + xhr.responseText + '</div>');
                    }
                });
            });
        });
    </script>
</body>
</html>
