<?php
session_start();

if (!isset($_SESSION['carrito'])) {
    header("Location: carrito.php");
    exit;
}

$carrito = $_SESSION['carrito'];
$total = 0;

foreach ($carrito as $item) {
    $total += $item['cantidad'] * $item['precio'];
}
?>

<h2>Confirmar compra</h2>

<p>Total a pagar: <strong><?= $total ?> €</strong></p>

<form action="procesar_pago.php" method="POST">
    <button type="submit">Pagar ahora (simulado)</button>
</form>
