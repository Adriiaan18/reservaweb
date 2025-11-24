<?php
include 'admin_check.php';
include '../includes/header.php';
require '../includes/db.php';

$id = intval($_GET['id']);

$stmt = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
$stmt->execute([$id]);
$p = $stmt->fetch();
?>

<h2>Editar producto</h2>

<form action="producto_actualizar.php" method="POST" enctype="multipart/form-data">

    <input type="hidden" name="id" value="<?= $p['id'] ?>">

    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?= $p['nombre'] ?>" required>

    <label>Descripción:</label>
    <textarea name="descripcion"><?= $p['descripcion'] ?></textarea>

    <label>Categoría:</label>
    <input type="text" name="categoria" value="<?= $p['categoria'] ?>" required>

    <label>Precio:</label>
    <input type="number" step="0.01" name="precio" value="<?= $p['precio'] ?>" required>

    <label>Imagen actual:</label>
    <?php if ($p['imagen']): ?>
        <img src="../uploads/<?= $p['imagen'] ?>" width="80">
    <?php endif; ?>

    <label>Nueva imagen (opcional):</label>
    <input type="file" name="imagen">

    <button type="submit">Actualizar</button>
</form>

<?php include '../includes/footer.php'; ?>
