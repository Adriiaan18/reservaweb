<?php
include '../admin_check.php';
require '../../includes/db.php';

$usuarios = $pdo->query("SELECT * FROM usuarios")->fetchAll();
?>

<h2>Usuarios</h2>

<a href="crear.php">Crear nuevo usuario</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Rol</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($usuarios as $u): ?>
        <tr>
            <td><?= $u['id'] ?></td>
            <td><?= $u['nombre'] ?></td>
            <td><?= $u['email'] ?></td>
            <td><?= $u['rol'] ?></td>
            <td>
                <a href="editar.php?id=<?= $u['id'] ?>">Editar</a> |
                <a href="eliminar.php?id=<?= $u['id'] ?>" onclick="return confirm('¿Seguro?')">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
