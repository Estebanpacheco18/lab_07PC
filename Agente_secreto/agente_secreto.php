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