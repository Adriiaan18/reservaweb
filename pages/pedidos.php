<?php
/*
 |--------------------------------------------------------------------------
 | MENÚ DE PRODUCTOS
 |--------------------------------------------------------------------------
 | - Muestra todos los productos cargados en la BD
 | - Permite añadirlos al carrito
 */

include '../includes/header.php';
require '../includes/db.php';

// Obtener productos activos
$stmt = $pdo->query("SELECT * FROM productos WHERE activo = 1 ORDER BY categoria, nombre");
$productos = $stmt->fetchAll();
?>

<h2>Menú - Realiza tu pedido</h2>

<div class="menu-grid">

<?php foreach ($productos as $p): ?>
    <div class="producto-card">

        <!-- Foto del producto -->
        <?php if ($p['imagen']): ?>
            <img src="../uploads/<?= $p['imagen'] ?>" width="120">
        <?php endif; ?>

        <h3><?= $p['nombre'] ?></h3>
        <p><?= $p['descripcion'] ?></p>
        <strong><?= number_format($p['precio'], 2) ?> €</strong>

        <!-- Botón: añadir al carrito -->
        <form action="add_carrito.php" method="POST">
            <input type="hidden" name="id" value="<?= $p['id'] ?>">
            <button type="submit">Añadir al carrito</button>
        </form>

    </div>
<?php endforeach; ?>

</div>

<?php include '../includes/footer.php'; ?>
