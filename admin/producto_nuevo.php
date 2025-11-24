<?php
include 'admin_check.php';
include '../includes/header.php';
?>

<h2>Nuevo producto</h2>

<form action="producto_guardar.php" method="POST" enctype="multipart/form-data">

    <label>Nombre:</label>
    <input type="text" name="nombre" required>

    <label>Descripción:</label>
    <textarea name="descripcion"></textarea>

    <label>Categoría:</label>
    <input type="text" name="categoria" required>

    <label>Precio:</label>
    <input type="number" step="0.01" name="precio" required>

    <label>Imagen:</label>
    <input type="file" name="imagen">

    <button type="submit">Guardar</button>
</form>

<?php include '../includes/footer.php'; ?>
