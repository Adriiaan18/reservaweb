<?php
include 'admin_check.php';
include '../includes/header.php';
require '../includes/db.php';

$stmt = $pdo->query("
    SELECT p.*, u.nombre AS cliente
    FROM pedidos p
    JOIN usuarios u ON p.usuario_id = u.id
    ORDER BY p.fecha DESC
");

$pedidos = $stmt->fetchAll();
?>

<h2>Pedidos recibidos</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Tipo</th>
        <th>Total</th>
        <th>Fecha</th>
        <th>Ver detalle</th>
    </tr>

<?php foreach ($pedidos as $p): ?>
    <tr>
        <td><?= $p['id'] ?></td>
        <td><?= $p['cliente'] ?></td>
        <td><?= $p['tipo'] ?></td>
        <td><?= number_format($p['total'], 2) ?> €</td>
        <td><?= $p['fecha'] ?></td>
        <td><a href="pedido_detalle.php?id=<?= $p['id'] ?>">Ver</a></td>
    </tr>
<?php endforeach; ?>
</table>

<?php include '../includes/footer.php'; ?>
