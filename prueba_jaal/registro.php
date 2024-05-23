
<?php
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
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $correo = $conn->real_escape_string($_POST['correo']);
    $contrasena = $_POST['contrasena'];

    // Validar formato de correo
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'Correo electrónico inválido.']);
        exit();
    }

    // Validar formato de contraseña
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $contrasena)) {
        echo json_encode(['status' => 'error', 'message' => 'La contraseña no cumple con los requisitos.']);
        exit();
    }

    // Encriptar contraseña
    $contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT);

    // Insertar datos en la base de datos
    $sql = "INSERT INTO usuarios (nombre, correo, password) VALUES ('$nombre', '$correo', '$contrasenaHash')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['status' => 'success', 'message' => 'Registro exitoso.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $sql . '<br>' . $conn->error]);
    }

    // Cerrar conexión
    $conn->close();
}
?>