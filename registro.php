<?php
/*
 |--------------------------------------------------------------------------
 | REGISTRO DE USUARIOS
 |--------------------------------------------------------------------------
 | - Recibe datos del formulario
 | - Valida campos
 | - Encripta contraseña
 | - Inserta usuario en BD
 */

require 'includes/db.php'; // Conectar a la BD

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = trim($_POST['nombre']);
    $email  = trim($_POST['email']);
    $pass   = $_POST['password'];

    // Validación básica
    if ($nombre && filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($pass) >= 6) {
        
        // Encriptar contraseña
        $hash = password_hash($pass, PASSWORD_DEFAULT);

        try {
            // Insertar en la base de datos
            $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$nombre, $email, $hash]);

            // Redirigir al login
            header('Location: login.php?msg=registered');
            exit;

        } catch (PDOException $e) {
            $error = "El email ya está registrado.";
        }

    } else {
        $error = "Datos inválidos. Revisa el formulario.";
    }
}

include 'includes/header.php';
?>

<h2>Registro</h2>

<?php if (!empty($error)) echo "<p>$error</p>"; ?>

<form method="POST">
    <input type="text" name="nombre" placeholder="Nombre completo" required>
    <input type="email" name="email" placeholder="Correo electrónico" required>
    <input type="password" name="password" placeholder="Contraseña (mínimo 6 caracteres)" required>
    <button type="submit">Registrarse</button>
</form>

<?php include 'includes/footer.php'; ?>
