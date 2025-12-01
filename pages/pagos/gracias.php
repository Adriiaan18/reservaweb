<?php
$id = $_GET['id'] ?? 0;
?>

<h2>¡Gracias por tu compra!</h2>

<p>Tu pedido ha sido registrado correctamente.</p>
<p>Número de pedido: <strong><?= $id ?></strong></p>
<p>Nos pondremos en contacto cuando esté listo.</p>

<a href="../index.php">Volver al inicio</a>
