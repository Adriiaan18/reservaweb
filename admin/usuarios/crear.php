<?php
include '../admin_check.php';
require '../../includes/db.php';

if ($_POST) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $rol = $_POST['rol'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password, rol) VALUES (?,?,?,?)");
    $stmt->execute([$nombre, $email, $password, $rol]);

    header("Location: listar.php");
    exit;
}
?>

<h2>Crear usuario</h2>

<form method="POST">
    <label>Nombre:</label>
    <input type="text" name="nombre" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Contraseña:</label>
    <input type="password" name="password" required>

    <label>Rol:</label>
    <select name="rol">
        <option value="cliente">Cliente</option>
        <option value="admin">Administrador</option>
    </select>

    <button>Crear</button>
</form>
