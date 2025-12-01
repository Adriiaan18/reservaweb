<?php
include '../admin_check.php';
require '../../includes/db.php';

$imagenes = $pdo->query("SELECT * FROM galeria ORDER BY id DESC")->fetchAll();
?>

<h2>Galería</h2>

<a href="subir.php">Subir nueva imagen</a>

<table border="1">
<tr>
    <th>ID</th>
    <th>Título</th>
    <th>Imagen</th>
    <th>Acciones</th>
</tr>

<?php foreach ($imagenes as $img): ?>
<tr>
    <td><?= $img['id'] ?></td>
    <td><?= $img['titulo'] ?></td>
    <td><img src="../../uploads/galeria/<?= $img['imagen'] ?>" width="120"></td>
    <td>
        <a href="eliminar.php?id=<?= $img['id'] ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
