<?php
include 'admin_check.php';
require '../includes/db.php';

$id = intval($_GET['id']);

/*
 |--------------------------------------------------------------------------
 | ELIMINAR IMAGEN
 |--------------------------------------------------------------------------
 | - Borrar archivo del servidor
 | - Borrar registro de la BD
 */

// Seleccionar archivo
$stmt = $pdo->prepare("SELECT archivo FROM galeria WHERE id = ?");
$stmt->execute([$id]);
$archivo = $stmt->fetchColumn();

// Borrar archivo físico
if ($archivo && file_exists("../uploads/galeria/" . $archivo)) {
    unlink("../uploads/galeria/" . $archivo);
}

// Borrar registro de BD
$stmt = $pdo->prepare("DELETE FROM galeria WHERE id = ?");
$stmt->execute([$id]);

header("Location: galeria.php?del=1");
exit;
