<?php
include '../admin_check.php';
require '../../includes/db.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id=?");
$stmt->execute([$id]);
$usuario = $stmt->fetch();

if ($_POST) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $rol = $_POST['rol'];

    $sql = "UPDATE usuarios SET nombre=?, email=?, rol=? WHERE id=?";
    $pdo->prepare($sql)->execute([$nombre, $email, $rol, $id]);

    header("Location: listar.php");
    exit;
}
?>

<h2>Editar usuario</h2>

<form method="POST">
    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?= $usuario['nombre'] ?>" required>

    <label>Email:</label>
    <input type="email" name="email" value="<?= $usuario['email'] ?>" required>

    <label>Rol:</label>
    <select name="rol">
        <option value="cliente" <?= $usuario['rol']=="cliente"?"selected":"" ?>>Cliente</option>
        <option value="admin" <?= $usuario['rol']=="admin"?"selected":"" ?>>Admin</option>
    </select>

    <button>Guardar cambios</button>
</form>
