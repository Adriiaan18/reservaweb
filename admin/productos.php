<?php
include 'admin_check.php';
include '../includes/header.php';
require '../includes/db.php';

/*
 |--------------------------------------------------------------------------
 | LISTA DE PRODUCTOS
 |--------------------------------------------------------------------------
 */

$stmt = $pdo->query("SELECT * FROM productos ORDER BY categoria, nombre");
$productos = $stmt->fetchAll();
?>

<h2>Productos</h2>

<a href="producto_nuevo.php">➕ Agregar producto</a>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Categoría</th>
        <th>Precio</th>
        <th>Imagen</th>
        <th>Acciones</th>
    </tr>

<?php foreach ($productos as $p): ?>
    <tr>
        <td><?= $p['id'] ?></td>
        <td><?= $p['nombre'] ?></td>
        <td><?= $p['categoria'] ?></td>
        <td><?= number_format($p['precio'], 2) ?> €</td>

        <td>
            <?php if ($p['imagen']): ?>
                <img src="../uploads/<?= $p['imagen'] ?>" width="60">
            <?php endif; ?>
        </td>

        <td>
            <a href="producto_editar.php?id=<?= $p['id'] ?>">✏ Editar</a> | 
            <a href="producto_eliminar.php?id=<?= $p['id'] ?>"
               onclick="return confirm('¿Eliminar este producto?')">🗑 Borrar</a>
        </td>
    </tr>
<?php endforeach; ?>

</table>

<?php include '../includes/footer.php'; ?>
