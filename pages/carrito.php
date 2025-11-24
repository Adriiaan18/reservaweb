<?php
/*
 |--------------------------------------------------------------------------
 | CARRITO DE COMPRA
 |--------------------------------------------------------------------------
 | - Muestra todos los productos añadidos
 | - Permite cambiar cantidad o eliminar
 */

include '../includes/header.php';
require '../includes/db.php';

if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo "<h2>Tu carrito está vacío</h2>";
    include '../includes/footer.php';
    exit;
}

$carrito = $_SESSION['carrito'];
$ids = implode(",", array_keys($carrito));

// Obtener los productos del carrito
$stmt = $pdo->query("SELECT * FROM productos WHERE id IN ($ids)");
$productos = $stmt->fetchAll();

$total = 0;
?>

<h2>Mi carrito</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Producto</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th>Subtotal</th>
        <th>Acción</th>
    </tr>

<?php foreach ($productos as $p): 
    $cantidad = $carrito[$p['id']];
    $subtotal = $p['precio'] * $cantidad;
    $total += $subtotal;
?>
    <tr>
        <td><?= $p['nombre'] ?></td>
        <td><?= number_format($p['precio'], 2) ?> €</td>
        <td><?= $cantidad ?></td>
        <td><?= number_format($subtotal, 2) ?> €</td>

        <!-- Eliminar producto -->
        <td>
            <a href="eliminar_carrito.php?id=<?= $p['id'] ?>">Eliminar</a>
        </td>
    </tr>
<?php endforeach; ?>

</table>

<h3>Total: <?= number_format($total, 2) ?> €</h3>

<!-- Botón para confirmar pedido -->
<a href="confirmar_pedido.php">Continuar pedido</a>

<?php include '../includes/footer.php'; ?>
