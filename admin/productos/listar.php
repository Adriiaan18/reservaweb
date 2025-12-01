<?php
include '../admin_check.php';
require '../../includes/db.php';

$productos = $pdo->query("SELECT * FROM productos")->fetchAll();
?>

<h2>Productos</h2>

<a href="crear.php">Nuevo producto</a>

<table border="1">
<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Precio</th>
    <th>Acciones</th>
</tr>

<?php foreach ($productos as $p): ?>
<tr>
    <td><?= $p['id'] ?></td>
    <td><?= $p['nombre'] ?></td>
    <td><?= $p['precio'] ?> €</td>
    <td>
        <a href="editar.php?id=<?= $p['id'] ?>">Editar</a> |
        <a href="eliminar.php?id=<?= $p['id'] ?>" onclick="return confirm('¿Seguro?')">Eliminar</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
