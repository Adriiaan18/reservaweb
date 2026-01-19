<?php 
include 'includes/header.php'; 
include 'includes/db.php';
?>

<section class="menu-page">
    <h2>Nuestro Menú</h2>

    <?php
    // Obtener filtros
    $buscar = isset($_GET['buscar']) ? $_GET['buscar'] : '';
    $filtro_categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';

    // Obtener todas las categorías para el select
    $categorias_stmt = $conn->query("SELECT * FROM categorias ORDER BY nombre ASC");
    $categorias = $categorias_stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <!-- Formulario de búsqueda y filtro de categoría -->
    <form method="GET" action="menu.php" class="form-busqueda">
        <input type="text" name="buscar" placeholder="Buscar producto..." 
               value="<?php echo htmlspecialchars($buscar); ?>">

        <select name="categoria">
            <option value="">Todas las categorías</option>
            <?php foreach($categorias as $cat): ?>
                <option value="<?php echo $cat['id']; ?>" <?php if($filtro_categoria == $cat['id']) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($cat['nombre']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Filtrar</button>
    </form>

    <div class="menu-items">
        <?php
        // Construir consulta dinámica
        $query = "SELECT * FROM productos WHERE 1";
        $params = [];

        if ($buscar != '') {
            $query .= " AND nombre LIKE ?";
            $params[] = "%$buscar%";
        }

        if ($filtro_categoria != '') {
            $query .= " AND categoria_id = ?";
            $params[] = $filtro_categoria;
        }

        $query .= " ORDER BY nombre ASC";

        $stmt = $conn->prepare($query);
        $stmt->execute($params);

        // Mostrar productos
        if ($stmt->rowCount() > 0) {
            while($producto = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="menu-item">';
                echo '<img src="images/' . htmlspecialchars($producto['imagen']) . '" alt="' . htmlspecialchars($producto['nombre']) . '">';
                echo '<h3>' . htmlspecialchars($producto['nombre']) . '</h3>';
                echo '<p>' . htmlspecialchars($producto['descripcion']) . '</p>';
                echo '<span class="precio">€' . number_format($producto['precio'], 2) . '</span>';
                echo '</div>';
            }
        } else {
            echo '<p>No se encontraron productos que coincidan con tu búsqueda y/o categoría.</p>';
        }
        ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
