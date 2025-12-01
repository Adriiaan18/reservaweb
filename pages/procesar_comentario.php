<?php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$valoracion = $_POST['valoracion'];
$comentario = $_POST['comentario'];

$stmt = $pdo->prepare("INSERT INTO comentarios (usuario_id, comentario, valoracion) VALUES (?,?,?)");
$stmt->execute([$usuario_id, $comentario, $valoracion]);

header("Location: comentarios.php?ok=1");
exit;
