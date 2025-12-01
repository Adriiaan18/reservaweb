<?php
/*
 |--------------------------------------------------------------------------
 | GALERÍA PARA CLIENTES
 |--------------------------------------------------------------------------
 | - Muestra todas las imágenes subidas por el administrador
 */

include '../includes/header.php';
require '../includes/db.php';

// Obtenemos todas las imágenes
$stmt = $pdo->query("SELECT * FROM galeria ORDER BY creado DESC");
$imagenes = $stmt->fetchAll();
?>

<h2>Galería de imágenes</h2>

<div class="galeria-grid">

<?php foreach ($imagenes as $img): ?>
    <div class="galeria-item">
        <img src="../uploads/galeria/<?= $img['archivo'] ?>" alt="<?= $img['titulo'] ?>" width="220">
        <p><?= $img['titulo'] ?></p>
    </div>
<?php endforeach; ?>

</div>

<?php include '../includes/footer.php'; ?>
