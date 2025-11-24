<?php
include 'admin_check.php';
require '../includes/db.php';

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$categoria = $_POST['categoria'];
$precio = $_POST['precio'];

// Imagen nueva
$archivo = null;

if (!empty($_FILES['imagen']['name'])) {
    $archivo = time() . "_" . $_FILES['imagen']['name'];
    move_uploaded_file($_FILES['imagen']['tmp_name'], "../uploads/" . $archivo);

    $stmt = $pdo->prepare("UPDATE productos SET imagen=? WHERE id=?");
    $stmt->execute([$archivo, $id]);
}

$stmt = $pdo->prepare("
    UPDATE productos
    SET nombre=?, descripcion=?, categoria=?, precio=?
    WHERE id=?
");

$stmt->execute([$nombre, $descripcion, $categoria, $precio, $id]);

header("Location: productos.php?edit=1");
exit;
