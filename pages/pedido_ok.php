<?php
/*
 |--------------------------------------------------------------------------
 | PEDIDO REALIZADO
 |--------------------------------------------------------------------------
 */

include '../includes/header.php';
?>

<h2>¡Pedido realizado con éxito!</h2>
<p>Tu número de pedido es: <strong><?= $_GET['id'] ?></strong></p>
<p>Gracias por comprar con nosotros.</p>

<a href="pedidos.php">Volver al menú</a>

<?php include '../includes/footer.php'; ?>
