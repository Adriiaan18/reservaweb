<?php 
include 'includes/header.php'; 
include 'includes/db.php';
?>

<section class="menu-page">
    <h2>Nuestro Menú</h2>
    <div class="menu-items">
        <?php
        // Traer productos desde la base de datos
        $stmt = $conn->query("SELECT * FROM productos");
        while($producto = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="menu-item">';
            echo '<img src="images/' . $producto['imagen'] . '" alt="' . $producto['nombre'] . '">';
            echo '<h3>' . $producto['nombre'] . '</h3>';
            echo '<p>' . $producto['descripcion'] . '</p>';
            echo '<span class="precio">€' . $producto['precio'] . '</span>';
            echo '</div>';
        }
        ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
