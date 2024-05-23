<?php
session_start();
header('Content-Type: application/json');

// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prueba_aya_alcaldia24";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Conexión fallida: ' . $conn->connect_error]);
    exit();
}

// Validar y sanitizar entrada
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $conn->real_escape_string($_POST['correo']);
    $contrasena = $_POST['contrasena'];

    // Buscar el usuario en la base de datos
    $sql = "SELECT id, nombre, password FROM usuarios WHERE correo = '$correo'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($contrasena, $row['password'])) {
            // Credenciales correctas, iniciar sesión
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['nombre'] = $row['nombre'];
            echo json_encode(['status' => 'success']);
        } else {
            // Contraseña incorrecta
            echo json_encode(['status' => 'error', 'message' => 'Clave incorrecta.']);
        }
    } else {
        // Usuario no encontrado
        echo json_encode(['status' => 'error', 'message' => 'Correo no encontrado.']);
    }

    // Cerrar conexión
    $conn->close();
}
?>