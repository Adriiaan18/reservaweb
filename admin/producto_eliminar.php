<?php
include 'admin_check.php';
require '../includes/db.php';

$id = intval($_GET['id']);

$stmt = $pdo->prepare("DELETE FROM productos WHERE id=?");
$stmt->execute([$id]);

header("Location: productos.php?del=1");
exit;
