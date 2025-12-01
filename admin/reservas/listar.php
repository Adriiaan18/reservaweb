<?php
include '../admin_check.php';
require '../../includes/db.php';

$reservas = $pdo->query("
    SELECT r.*, u.nombre 
    FROM reservas r
    JOIN usuarios u ON u.id = r.usuario_id
    ORDER BY fecha DESC
")->fetchAll();
?>

<h2>Reservas</h2>

<table border="1">
<tr>
    <th>ID</th>
    <th>Cliente</th>
    <th>Fecha</th>
    <th>Hora</th>
    <th>Personas</th>
    <th>Acción</th>
</tr>

<?php foreach ($reservas as $r): ?>
<tr>
    <td><?= $r['id'] ?></td>
    <td><?= $r['nombre'] ?></td>
    <td><?= $r['fecha'] ?></td>
    <td><?= $r['hora'] ?></td>
    <td><?= $r['personas'] ?></td>
    <td>
        <a href="eliminar.php?id=<?= $r['id'] ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
