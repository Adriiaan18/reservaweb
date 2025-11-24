<?php
/*
 |--------------------------------------------------------------------------
 | LOGIN
 |--------------------------------------------------------------------------
 | - Busca usuario por email
 | - Comprueba contraseña con password_verify()
 | - Guarda datos en $_SESSION
 */

require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email']);
    $pass  = $_POST['password'];

    // Buscar usuario por email
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Verificar contraseña
    if ($user && password_verify($pass, $user['password'])) {

        session_start();
        unset($user['password']); // Nunca guardamos la contraseña en sesión

        $_SESSION['user'] = $user;

        // Redirigir a la página inicial
        header('Location: index.php');
        exit;

    } else {
        $error = "Email o contraseña incorrectos.";
    }
}

include 'includes/header.php';
?>

<h2>Iniciar Sesión</h2>

<?php if (!empty($error)) echo "<p>$error</p>"; ?>

<form method="POST">
    <input type="email" name="email" placeholder="Correo" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <button type="submit">Entrar</button>
</form>

<?php include 'includes/footer.php'; ?>
