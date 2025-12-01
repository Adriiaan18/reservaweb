<?php
require '../includes/db.php';

$pedidos = $pdo->query("SELECT * FROM pedidos ORDER BY fecha DESC")->fetchAll();
?>

<h2>Pedidos recibidos</h2>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Usuario</th>
        <th>Total</th>
        <th>Estado</th>
        <th>Fecha</th>
    </tr>

    <?php foreach ($pedidos as $p): ?>
    <tr>
        <td><?= $p['id'] ?></td>
        <td><?= $p['usuario_id'] ?></td>
        <td><?= $p['total'] ?> €</td>
        <td><?= $p['estado'] ?></td>
        <td><?= $p['fecha'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>

