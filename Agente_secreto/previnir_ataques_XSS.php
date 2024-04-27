<?php
// Start session
session_start();

// Database connection
$pdo = new PDO('mysql:host=localhost;port=3308;dbname=lab07', 'root', '');

// Function to validate user input
function validateInput($data) {
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $nombre = validateInput($_POST['nombre']);
    $agente_id = validateInput($_POST['agente_id']);
    $departamento_id = validateInput($_POST['departamento_id']);
    $numero_misiones = validateInput($_POST['numero_misiones']);
    $descripcion_mision = validateInput($_POST['descripcion_mision']);

    // Encrypt fields
    $nombre = openssl_encrypt($nombre, 'AES-128-ECB', 'secret_key');
    $agente_id = openssl_encrypt($agente_id, 'AES-128-ECB', 'secret_key');
    $departamento_id = openssl_encrypt($departamento_id, 'AES-128-ECB', 'secret_key');
    $numero_misiones = openssl_encrypt($numero_misiones, 'AES-128-ECB', 'secret_key');
    $descripcion_mision = openssl_encrypt($descripcion_mision, 'AES-128-ECB', 'secret_key');

    // Store data in the database
    $stmt = $pdo->prepare("INSERT INTO agentes (nombre, agente_id, departamento_id, numero_misiones, descripcion_mision) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nombre, $agente_id, $departamento_id, $numero_misiones, $descripcion_mision]);

    // Redirect to dashboard
    header("Location: dashboard.php");
    exit();
}
?>