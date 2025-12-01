<?php
include '../admin_check.php';
require '../../includes/db.php';

$id = $_GET['id'];
$pdo->prepare("DELETE FROM reservas WHERE id=?")->execute([$id]);

header("Location: listar.php");
exit;
