<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Agente Secreto</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Formulario de Agente Secreto</h2>
    <?php if(isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>
        <label for="agente_id">Agente ID:</label><br>
        <input type="text" id="agente_id" name="agente_id" required><br><br>
        <label for="departamento_id">Departamento ID:</label><br>
        <input type="text" id="departamento_id" name="departamento_id" required><br><br>
        <label for="numero_misiones">Número de Misiones:</label><br>
        <input type="number" id="numero_misiones" name="numero_misiones" required><br><br>
        <label for="descripcion_mision">Descripción de la Nueva Misión:</label><br>
        <textarea id="descripcion_mision" name="descripcion_mision" required></textarea><br><br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>

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
}
?>