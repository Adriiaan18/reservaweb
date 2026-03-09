
<?php
include 'includes/header.php';
include 'includes/db.php';

// Mensaje de confirmación
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $personas = $_POST['personas'];

    // Validación básica
    if ($nombre && $email && $telefono && $fecha && $hora && $personas) {
        $stmt = $conn->prepare("INSERT INTO reservas (nombre, email, telefono, fecha, hora, personas) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nombre, $email, $telefono, $fecha, $hora, $personas]);
        $mensaje = "¡Reserva realizada con éxito!";
    } else {
        $mensaje = "Por favor, completa todos los campos.";
    }
}
?>

<section class="reserva">
    <h2>Haz tu Reserva</h2>
    <?php if($mensaje): ?>
        <p class="mensaje"><?php echo $mensaje; ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="tel" name="telefono" placeholder="Teléfono" required>
        <input type="date" name="fecha" required>
        <input type="time" name="hora" required>
        <input type="number" name="personas" placeholder="Número de personas" min="1" required>
        <button type="submit">Reservar</button>
    </form>
</section>

<?php include 'includes/footer.php'; ?>
