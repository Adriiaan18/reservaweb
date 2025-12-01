<?php
session_start();

// Ejemplo de carrito simulado
// En producción, vendría desde base de datos
$_SESSION['carrito'] = [
    ["producto" => "Pizza Margarita", "cantidad" => 2, "precio" => 8.50],
    ["producto" => "Hamburguesa", "cantidad" => 1, "precio" => 6.00]
];

$carrito = $_SESSION['carrito'];
$total = 0;
foreach ($carrito as $item) {
    $total += $item['cantidad'] * $item['precio'];
}
?>

<h2>Tu carrito</h2>

<table border="1">
    <tr>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Precio</th>
    </tr>

    <?php foreach ($carrito as $item): ?>
    <tr>
        <td><?= $item['producto'] ?></td>
        <td><?= $item['cantidad'] ?></td>
        <td><?= $item['precio'] ?> €</td>
    </tr>
    <?php endforeach; ?>
</table>

<h3>Total: <?= $total ?> €</h3>

<a href="confirmar.php">Continuar con el pago</a>
