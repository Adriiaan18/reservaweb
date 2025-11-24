<?php
/*
 |--------------------------------------------------------------------------
 | MIS RESERVAS
 |--------------------------------------------------------------------------
 | Muestra las reservas del usuario que está logeado.
 */

include '../includes/header.php';

if (empty($_SESSION['user'])) {
    header("Location: ../login.php?msg=login_required");
    exit;
}

require '../includes/db.php';

$usuario_id = $_SESSION['user']['id'];

// Obtener reservas del usuario
$stmt = $pdo->prepare("SELECT * FROM reservas WHERE usuario_id = ? ORDER BY fecha, hora");
$stmt->execute([$usuario_id]);
$reservas = $stmt->fetchAll();
?>

<h2>Mis Reservas</h2>

<?php if (isset($_GET['ok'])): ?>
    <p>✔ Reserva realizada correctamente.</p>
<?php endif; ?>

<table border="1" cellpadding="10">
    <tr>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Personas</th>
        <th>Comentario</th>
    </tr>

    <?php foreach ($reservas as $r): ?>
        <tr>
            <td><?= $r['fecha'] ?></td>
            <td><?= $r['hora'] ?></td>
            <td><?= $r['personas'] ?></td>
            <td><?= $r['comentario'] ?></td>
        </tr>
    <?php endforeach; ?>

</table>

<?php include '../includes/footer.php'; ?>
