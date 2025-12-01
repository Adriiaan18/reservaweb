<?php
include '../admin_check.php';
require '../../includes/db.php';

if ($_POST) {

    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];

    $stmt = $pdo->prepare("INSERT INTO productos (nombre, descripcion, precio, categoria)
                           VALUES (?,?,?,?)");
    $stmt->execute([$nombre, $descripcion, $precio, $categoria]);

    header("Location: listar.php");
    exit;
}
?>

<h2>Crear Producto</h2>

<form method="POST">
    <label>Nombre:</label>
    <input name="nombre" required>

    <label>Descripción:</label>
    <textarea name="descripcion"></textarea>

    <label>Precio:</label>
    <input type="number" step="0.01" name="precio" required>

    <label>Categoría:</label>
    <input name="categoria">

    <button>Guardar</button>
</form>
