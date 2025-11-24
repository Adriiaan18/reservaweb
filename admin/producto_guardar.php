<?php
include 'admin_check.php';
require '../includes/db.php';

/*
 |--------------------------------------------------------------------------
 | GUARDAR PRODUCTO NUEVO
 |--------------------------------------------------------------------------
 */

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$categoria = $_POST['categoria'];
$precio = $_POST['precio'];

// Subir imagen si existe
$archivo = null;

if (!empty($_FILES['imagen']['name'])) {
    $archivo = time() . "_" . $_FILES['imagen']['name'];
    move_uploaded_file($_FILES['imagen']['tmp_name'], "../uploads/" . $archivo);
}

$stmt = $pdo->prepare("
    INSERT INTO productos (nombre, descripcion, categoria, precio, imagen)
    VALUES (?, ?, ?, ?, ?)
");

$stmt->execute([$nombre, $descripcion, $categoria, $precio, $archivo]);

header("Location: productos.php?ok=1");
exit;
