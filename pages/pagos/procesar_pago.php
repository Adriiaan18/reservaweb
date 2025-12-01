<?php
session_start();
require '../includes/db.php';

// Verificar carrito
if (!isset($_SESSION['carrito'])) {
    header("Location: carrito.php");
    exit;
}

// Simular usuario logueado
$usuario_id = $_SESSION['usuario_id'] ?? 1; // temporal

$carrito = $_SESSION['carrito'];
$total = 0;

foreach ($carrito as $item) {
    $total += $item['cantidad'] * $item['precio'];
}

// 1. Guardar pedido principal
$stmt = $pdo->prepare("INSERT INTO pedidos (usuario_id,total) VALUES (?,?)");
$stmt->execute([$usuario_id, $total]);

$pedido_id = $pdo->lastInsertId();

// 2. Guardar detalles del pedido
foreach ($carrito as $item) {
    $stmtDetalle = $pdo->prepare("
        INSERT INTO pedido_detalles (pedido_id,producto,cantidad,precio)
        VALUES (?,?,?,?)
    ");
    $stmtDetalle->execute([
        $pedido_id,
        $item['producto'],
        $item['cantidad'],
        $item['precio']
    ]);
}

// Vaciar carrito
unset($_SESSION['carrito']);

header("Location: gracias.php?id=$pedido_id");
exit;
