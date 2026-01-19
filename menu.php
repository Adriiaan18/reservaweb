<?php 
include 'includes/header.php'; 
include 'includes/db.php';
?>

<section class="menu-page">
    <h2>Nuestro Menú</h2>

    <?php
    // Obtener filtros
    $buscar = $_GET['buscar'] ?? '';
    $filtro_categoria = $_GET['categoria'] ?? '';

    // Obtener todas las categorías con manejo de errores
    try {
        if($conn) {
            $categorias_stmt = $conn->query("SELECT * FROM categorias ORDER BY nombre ASC");
            $categorias = $categorias_stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            throw new Exception("No hay conexión a la base de datos");
        }
    } catch (Exception $e) {
        echo "<p style='color:red'>Error al cargar categorías: " . $e->getMessage() . "</p>";
        $categorias = [];
    }
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
        // Consultar productos con manejo de errores
        try {
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

            if ($stmt->rowCount() > 0) {
                while($producto = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="menu-item">';
                    echo '<img src="images/' . htmlspecialchars($producto['imagen']) . '" alt="' . htmlspecialchars($producto['nombre']) . '">';
                    echo '<h3>' . htmlspecialchars($producto['nombre']) . '</h3>';
                    echo '<p>' . htmlspecialchars($producto['descripcion']) . '</p>';
                    echo '<span class="precio">€' . number_format($producto['precio'], 2) . '</span>';
                    echo '<button onclick="agregarCarrito(' . $producto['id'] . ', \'' . addslashes($producto['nombre']) . '\',' . $producto['precio'] . ')">Agregar al carrito</button>';
                    echo '</div>';
                }
            } else {
                echo '<p>No se encontraron productos que coincidan con tu búsqueda y/o categoría.</p>';
            }
        } catch(PDOException $e) {
            echo "<p style='color:red'>Error al cargar los productos: " . $e->getMessage() . "</p>";
        }
        ?>
    </div>

    <!-- Carrito de compras -->
    <h3>Carrito de Compras</h3>
    <div id="carrito">
        <ul id="lista-carrito"></ul>
        <p>Total: €<span id="total">0.00</span></p>
        <button onclick="finalizarPedido()">Finalizar Pedido</button>
    </div>
</section>

<script>
// Carrito de compras
let carrito = [];
let total = 0;

function agregarCarrito(id, nombre, precio) {
    carrito.push({id, nombre, precio});
    total += precio;
    mostrarCarrito();
}

function mostrarCarrito() {
    const lista = document.getElementById('lista-carrito');
    lista.innerHTML = '';
    carrito.forEach((item, index) => {
        lista.innerHTML += `<li>${item.nombre} - €${item.precio.toFixed(2)} <button onclick="eliminarItem(${index})">X</button></li>`;
    });
    document.getElementById('total').textContent = total.toFixed(2);
}

function eliminarItem(index) {
    total -= carrito[index].precio;
    carrito.splice(index, 1);
    mostrarCarrito();
}

function finalizarPedido() {
    if(carrito.length === 0){
        alert("Tu carrito está vacío");
        return;
    }
    let nombre = prompt("Ingresa tu nombre:");
    let email = prompt("Ingresa tu email:");
    if(nombre && email){
        fetch('procesar_pedido.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({productos: carrito, total: total, nombre: nombre, email: email})
        }).then(res => res.json())
          .then(data => {
              alert(data.mensaje);
              carrito = [];
              total = 0;
              mostrarCarrito();
          });
    }
}
</script>

<?php include 'includes/footer.php'; ?>
