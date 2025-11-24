<?php
include 'admin_check.php';
include '../includes/header.php';
require '../includes/db.php';

$id = intval($_GET['id']);

// Datos del pedido
$stmt = $pdo->prepare("
    SELECT p.*, u.nombre AS cliente 
    FROM pedidos p
    JOIN usuarios u ON p.usuario_id = u.id
    WHERE p.id = ?
");
$stmt->execute([$id]);
$pedido = $stmt->fetch();

// Productos del pedido
$stmt = $pdo->prepare("
    SELECT d.*, pr.nombre 
    FROM pedido_detalle d
    JOIN productos pr ON d.producto_id = pr.id
    WHERE d.pedido_id = ?
");
$stmt->execute([$id]);
$detalle = $stmt->fetchAll();
?>

<h2>Detalle del pedido #<?= $pedido['id'] ?></h2>

<p><b>Cliente:</b> <?= $pedido['cliente'] ?></p>
<p><b>Tipo:</b> <?= $pedido['tipo'] ?></p>
<p><b>Dirección:</b> <?= $pedido['direccion'] ?></p>

<table border="1" cellpadding="10">
    <tr>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Subtotal</th>
    </tr>

<?php foreach ($detalle as $d): ?>
    <tr>
        <td><?= $d['nombre'] ?></td>
        <td><?= $d['cantidad'] ?></td>
        <td><?= number_format($d['subtotal'], 2) ?> €</td>
    </tr>
<?php endforeach; ?>

</table>

<?php include '../includes/footer.php'; ?>
