<?php
include 'includes/header.php';
include 'includes/db.php';
?>

<section class="galeria">
    <h2>Galería de Imágenes</h2>

    <?php
    // Obtener filtros
    $buscar = isset($_GET['buscar']) ? $_GET['buscar'] : '';
    $filtro_categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';

    // Obtener todas las categorías para el select
    $categorias_stmt = $conn->query("SELECT * FROM categorias ORDER BY nombre ASC");
    $categorias = $categorias_stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <!-- Formulario de búsqueda y filtrado -->
    <form method="GET" action="galeria.php" class="form-busqueda">
        <input type="text" name="buscar" placeholder="Buscar imagen..." value="<?php echo htmlspecialchars($buscar); ?>">

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

    <div class="imagenes">
        <?php
        // Construir consulta dinámica
        $query = "SELECT * FROM galeria WHERE 1";
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

        // Mostrar imágenes
        if ($stmt->rowCount() > 0) {
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="imagen-item">';
                echo '<img src="images/' . htmlspecialchars($row['imagen']) . '" alt="' . htmlspecialchars($row['nombre']) . '" onclick="openLightbox(this)">';
                echo '<p>' . htmlspecialchars($row['nombre']) . '</p>';
                echo '</div>';
            }
        } else {
            echo '<p>No se encontraron imágenes que coincidan con tu búsqueda y/o categoría.</p>';
        }
        ?>
    </div>
</section>

<!-- Lightbox simple -->
<div id="lightbox" onclick="closeLightbox()">
    <img id="lightbox-img" src="" alt="">
</div>

<script>
function openLightbox(img) {
    document.getElementById('lightbox').style.display = 'flex';
    document.getElementById('lightbox-img').src = img.src;
}
function closeLightbox() {
    document.getElementById('lightbox').style.display = 'none';
}
</script>

<?php include 'includes/footer.php'; ?>
