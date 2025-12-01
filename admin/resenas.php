<?php
/*
 |--------------------------------------------------------------------------
 | ADMIN: LISTAR Y MODERAR RESEÑAS
 |--------------------------------------------------------------------------
 | - Solo accesible a admins (usa admin_check.php)
 | - Permite eliminar reseñas inapropiadas
 */

include 'admin_check.php';
include '../includes/header.php';
require '../includes/db.php';

// Obtener todas las reseñas con el nombre del usuario
$stmt = $pdo->query("
    SELECT r.*, u.nombre
    FROM resenas r
    JOIN usuarios u ON r.usuario_id = u.id
    ORDER BY r.fecha DESC
");
$resenas = $stmt->fetchAll();
?>

<h2>Moderación de reseñas</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Usuario</th>
        <th>Puntuación</th>
        <th>Comentario</th>
        <th>Fecha</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($resenas as $r): ?>
        <tr>
            <td><?= $r['id'] ?></td>
            <td><?= htmlspecialchars($r['nombre']) ?></td>
            <td>
                <?php for ($i = 1; $i <= 5; $i++) echo $i <= $r['puntuacion'] ? "★" : "☆"; ?>
            </td>
            <td><?= nl2br(htmlspecialchars($r['comentario'])) ?></td>
            <td><?= $r['fecha'] ?></td>
            <td>
                <a href="resena_eliminar.php?id=<?= $r['id'] ?>" onclick="return confirm('¿Eliminar reseña?')">🗑 Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include '../includes/footer.php'; ?>
