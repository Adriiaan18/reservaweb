<?php
/*
 |--------------------------------------------------------------------------
 | AÑADIR PRODUCTO AL CARRITO
 |--------------------------------------------------------------------------
 | - El carrito se almacena en $_SESSION['carrito']
 | - Si ya existe el producto, aumentamos la cantidad
 */

session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

$id = intval($_POST['id']); // ID del producto

// Si el producto ya está en el carrito → aumentar cantidad
if (isset($_SESSION['carrito'][$id])) {
    $_SESSION['carrito'][$id]++;
} else {
    $_SESSION['carrito'][$id] = 1;
}

// Redirigir al menú
header("Location: pedidos.php?added=1");
exit;
