<?php
include '../admin_check.php';
require '../../includes/db.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT imagen FROM galeria WHERE id=?");
$stmt->execute([$id]);
$img = $stmt->fetch();

// eliminar archivo físico
unlink("../../uploads/galeria/" . $img['imagen']);

// eliminar de la BD
$pdo->prepare("DELETE FROM galeria WHERE id=?")->execute([$id]);

header("Location: listar.php");
exit;
