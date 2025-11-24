<?php
include 'admin_check.php';
include '../includes/header.php';
require '../includes/db.php';

$stmt = $pdo->query("
    SELECT r.*, u.nombre AS cliente
    FROM reservas r
    JOIN usuarios u ON r.usuario_id = u.id
    ORDER BY r.fecha DESC, r.hora DESC
");
$reservas = $stmt->fetchAll();
?>

<h2>Reservas de mesas</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Personas</th>
        <th>Comentario</th>
    </tr>

<?php foreach ($reservas as $r): ?>
    <tr>
        <td><?= $r['id'] ?></td>
        <td><?= $r['cliente'] ?></td>
        <td><?= $r['fecha'] ?></td>
        <td><?= $r['hora'] ?></td>
        <td><?= $r['personas'] ?></td>
        <td><?= $r['comentario'] ?></td>
    </tr>
<?php endforeach; ?>
</table>

<?php include '../includes/footer.php'; ?>
