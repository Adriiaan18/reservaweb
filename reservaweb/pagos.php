<?php
include 'includes/header.php';
include 'includes/db.php';

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $producto = $_POST['producto'];
    $monto = $_POST['monto'];
    $metodo = $_POST['metodo'];

    if ($nombre && $email && $producto && $monto && $metodo) {
        $stmt = $conn->prepare("INSERT INTO pagos (nombre, email, producto, monto, metodo) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nombre, $email, $producto, $monto, $metodo]);
        $mensaje = "¡Pago registrado con éxito!";
    } else {
        $mensaje = "Por favor completa todos los campos.";
    }
}
?>

<section class="pagos">
    <h2>Realiza tu Pago</h2>
    
    <?php if($mensaje): ?>
        <p class="mensaje"><?php echo $mensaje; ?></p>
    <?php endif; ?>
    
    <form method="POST" action="">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="producto" placeholder="Producto a comprar" required>
        <input type="number" step="0.01" name="monto" placeholder="Monto (€)" required>
        <select name="metodo" required>
            <option value="">Método de pago</option>
            <option value="Tarjeta de crédito">Tarjeta de crédito</option>
            <option value="Transferencia">Transferencia</option>
            <option value="PayPal">PayPal</option>
        </select>
        <button type="submit">Pagar</button>
    </form>
</section>

<?php include 'includes/footer.php'; ?>
