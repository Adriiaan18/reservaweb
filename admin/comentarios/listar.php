<?php
include '../admin_check.php';
require '../../includes/db.php';

$comentarios = $pdo->query("
    SELECT c.*, u.nombre 
    FROM comentarios c
    JOIN usuarios u ON u.id = c.usuario_id
    ORDER BY c.creado DESC
")->fetchAll();
?>

<h2>Comentarios</h2>

<table border="1">
<tr>
    <th>Usuario</th>
    <th>Comentario</th>
    <th>Valoración</th>
    <th>Fecha</th>
    <th>Acciones</th>
</tr>

<?php foreach ($comentarios as $c): ?>
<tr>
    <td><?= $c['nombre'] ?></td>
    <td><?= $c['comentario'] ?></td>
    <td><?= $c['valoracion'] ?></td>
    <td><?= $c['creado'] ?></td>
    <td>
        <a href="eliminar.php?id=<?= $c['id'] ?>" onclick="return confirm('¿Eliminar comentario?')">Eliminar</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
