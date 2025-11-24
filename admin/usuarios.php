<?php
include 'admin_check.php';
include '../includes/header.php';
require '../includes/db.php';

$stmt = $pdo->query("SELECT * FROM usuarios ORDER BY creado DESC");
$usuarios = $stmt->fetchAll();
?>

<h2>Usuarios registrados</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Rol</th>
        <th>Creado</th>
    </tr>

<?php foreach ($usuarios as $u): ?>
    <tr>
        <td><?= $u['id'] ?></td>
        <td><?= $u['nombre'] ?></td>
        <td><?= $u['email'] ?></td>
        <td><?= $u['rol'] ?></td>
        <td><?= $u['creado'] ?></td>
    </tr>
<?php endforeach; ?>

</table>

<?php include '../includes/footer.php'; ?>
