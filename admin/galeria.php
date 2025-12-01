<?php
include 'admin_check.php';
include '../includes/header.php';
require '../includes/db.php';

/*
 |--------------------------------------------------------------------------
 | LISTA DE IMÁGENES DE LA GALERÍA
 |--------------------------------------------------------------------------
 */

$stmt = $pdo->query("SELECT * FROM galeria ORDER BY creado DESC");
$imagenes = $stmt->fetchAll();
?>

<h2>Galería - Administrar imágenes</h2>

<a href="galeria_nueva.php">➕ Subir nueva imagen</a>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Imagen</th>
        <th>Título</th>
        <th>Acciones</th>
    </tr>

<?php foreach ($imagenes as $img): ?>
    <tr>
        <td><?= $img['id'] ?></td>

        <td>
            <img src="../uploads/galeria/<?= $img['archivo'] ?>" width="100">
        </td>

        <td><?= $img['titulo'] ?></td>

        <td>
            <a href="galeria_eliminar.php?id=<?= $img['id'] ?>"
               onclick="return confirm('¿Eliminar esta imagen?')">
               🗑 Eliminar
            </a>
        </td>
    </tr>
<?php endforeach; ?>
</table>

<?php include '../includes/footer.php'; ?>
