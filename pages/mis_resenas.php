<?php
/*
 |--------------------------------------------------------------------------
 | MIS RESEÑAS
 |--------------------------------------------------------------------------
 | Lista las reseñas del usuario logeado (útil para editar/eliminar en el futuro)
 */

include '../includes/header.php';
require '../includes/db.php';

if (empty($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

$uid = $_SESSION['user']['id'];

$stmt = $pdo->prepare("SELECT * FROM resenas WHERE usuario_id = ? ORDER BY fecha DESC");
$stmt->execute([$uid]);
$resenas = $stmt->fetchAll();
?>

<h2>Mis reseñas</h2>

<?php if (empty($resenas)): ?>
    <p>No has dejado ninguna reseña todavía.</p>
<?php else: ?>
    <?php foreach ($resenas as $r): ?>
        <div class="resena-item">
            <p><small><?= htmlspecialchars($r['fecha']); ?></small></p>
            <p>
                <?php for ($i = 1; $i <= 5; $i++) echo $i <= $r['puntuacion'] ? "★" : "☆"; ?>
            </p>
            <p><?= nl2br(htmlspecialchars($r['comentario'])); ?></p>
        </div>
        <hr>
    <?php endforeach; ?>
<?php endif; ?>

<?php include '../includes/footer.php'; ?>
