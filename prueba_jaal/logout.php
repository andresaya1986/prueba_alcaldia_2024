<?php
session_start();
session_unset();
session_destroy();

// Redirigir al login después de cerrar sesión
header('Location: login.php');
exit();
