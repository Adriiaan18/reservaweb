<?php
include '../admin_check.php';
require '../../includes/db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM usuarios WHERE id=?");
$stmt->execute([$id]);

header("Location: listar.php");
exit;
