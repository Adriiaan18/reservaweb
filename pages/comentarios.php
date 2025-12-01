<?php
require 'includes/db.php';

$comentarios = $pdo->query("
    SELECT c.*, u.nombre
    FROM comentarios c
    JOIN usuarios u ON u.id = c.usuario_id
    ORDER BY c.creado DESC
")->fetchAll();
?>

<h2>Opiniones de clientes</h2>

<?php foreach ($comentarios as $c): ?>
<div class="comentario">
    <strong><?= $c['nombre'] ?>:</strong>
    <p><?= $c['comentario'] ?></p>
    <span>Valoración: <?= $c['valoracion'] ?> ⭐</span>
    <br><small><?= $c['creado'] ?></small>
</div>
<hr>
<?php endforeach; ?>
