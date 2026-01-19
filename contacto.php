<?php
include 'includes/header.php';
include 'includes/db.php';

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $mensaje_usuario = $_POST['mensaje'];

    // Validación básica
    if ($nombre && $email && $mensaje_usuario) {
        $stmt = $conn->prepare("INSERT INTO contacto (nombre, email, mensaje) VALUES (?, ?, ?)");
        $stmt->execute([$nombre, $email, $mensaje_usuario]);
        $mensaje = "¡Mensaje enviado con éxito!";
    } else {
        $mensaje = "Por favor completa todos los campos.";
    }
}
?>

<section class="contacto">
    <h2>Contacto</h2>
    
    <?php if($mensaje): ?>
        <p class="mensaje"><?php echo $mensaje; ?></p>
    <?php endif; ?>
    
    <form method="POST" action="">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="email" name="email" placeholder="Email" required>
        <textarea name="mensaje" placeholder="Tu mensaje" rows="5" required></textarea>
        <button type="submit">Enviar</button>
    </form>
</section>

<?php include 'includes/footer.php'; ?>
