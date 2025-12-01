<?php
require '../includes/db.php';

$imagenes = $pdo->query("SELECT * FROM galeria ORDER BY creado DESC")->fetchAll();
?>

<h2>Galería</h2>

<div style="display:flex; gap:20px; flex-wrap:wrap;">
<?php foreach ($imagenes as $img): ?>
    <div>
        <img src="../uploads/galeria/<?= $img['imagen'] ?>" width="250">
        <p><?= $img['titulo'] ?></p>
    </div>
<?php endforeach; ?>
</div>
