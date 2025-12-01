<?php
include 'admin_check.php';
include '../includes/header.php';
?>

<h2>Subir imagen a la galería</h2>

<form action="galeria_guardar.php" method="POST" enctype="multipart/form-data">

    <label>Título (opcional):</label>
    <input type="text" name="titulo">

    <label>Imagen:</label>
    <input type="file" name="imagen" required>

    <button type="submit">Subir</button>
</form>

<?php include '../includes/footer.php'; ?>
