<?php
/*
 |--------------------------------------------------------------------------
 | PROCESAR PEDIDO
 |--------------------------------------------------------------------------
 | - Inserta pedido en la base de datos
 | - Inserta cada producto en pedido_detalle
 */

session_start();

if (empty($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

require '../includes/db.php';

$usuario_id = $_SESSION['user']['id'];
$tipo = $_POST['tipo'];
$direccion = $_POST['direccion'] ?? "";

$carrito = $_SESSION['carrito'];

// Calcular total
$total = 0;

foreach ($carrito as $id_prod => $cant) {
    $stmt = $pdo->prepare("SELECT precio FROM productos WHERE id = ?");
    $stmt->execute([$id_prod]);
    $precio = $stmt->fetchColumn();
    $total += $precio * $cant;
}

/*
 |--------------------------------------------------------------------------
 | 1) Insertar pedido
 |--------------------------------------------------------------------------
 */
$stmt = $pdo->prepare("
    INSERT INTO pedidos (usuario_id, tipo, direccion, total)
    VALUES (?, ?, ?, ?)
");

$stmt->execute([$usuario_id, $tipo, $direccion, $total]);

$pedido_id = $pdo->lastInsertId();

/*
 |--------------------------------------------------------------------------
 | 2) Insertar detalle del pedido
 |--------------------------------------------------------------------------
 */
foreach ($carrito as $id_prod => $cant) {
    $stmt = $pdo->prepare("SELECT precio FROM productos WHERE id = ?");
    $stmt->execute([$id_prod]);
    $precio = $stmt->fetchColumn();

    $subtotal = $precio * $cant;

    $detail = $pdo->prepare("
        INSERT INTO pedido_detalle (pedido_id, producto_id, cantidad, subtotal)
        VALUES (?, ?, ?, ?)
    ");

    $detail->execute([$pedido_id, $id_prod, $cant, $subtotal]);
}

/*
 |--------------------------------------------------------------------------
 | 3) Vaciar carrito
 |--------------------------------------------------------------------------
 */
unset($_SESSION['carrito']);

header("Location: pedido_ok.php?id=$pedido_id");
exit;
