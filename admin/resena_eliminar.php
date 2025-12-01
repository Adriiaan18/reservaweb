<?php
/*
 |--------------------------------------------------------------------------
 | ADMIN: ELIMINAR RESEÑA
 |--------------------------------------------------------------------------
 | - Comprueba admin_check.php
 | - Elimina la reseña por id
 */

include 'admin_check.php';
require '../includes/db.php';

$id = intval($_GET['id']);

if ($id <= 0) {
    header("Location: resenas.php");
    exit;
}

$stmt = $pdo->prepare("DELETE FROM resenas WHERE id = ?");
$stmt->execute([$id]);

header("Location: resenas.php?del=1");
exit;
