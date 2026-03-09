<?php 
include 'includes/header.php'; 
include 'includes/db.php';
?>

<section class="menu-page">
    <h2>Nuestro Menú</h2>

    <?php
    // Obtener filtros (evitamos fallos si no se han enviado)
    $buscar = isset($_GET['buscar']) ? $_GET['buscar'] : '';
    $filtro_categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';

    // Intentamos obtener categorías solo si hay conexión
    $categorias = [];
    if (isset($conn) && $conn !== null) {
        try {
            $categorias_stmt = $conn->query("SELECT * FROM categorias ORDER BY nombre ASC");
            $categorias = $categorias_stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            // Error silencioso para no ensuciar el diseño
        }
    }
    ?>

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

    <div class="productos">
        <?php
        // VERIFICACIÓN DE SEGURIDAD: Solo intentamos cargar si existe la variable $conn
        if (isset($conn) && $conn !== null) {
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
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<div class="producto">';
                        echo '<img src="images/' . htmlspecialchars($row['imagen']) . '" alt="' . htmlspecialchars($row['nombre']) . '">';
                        echo '<h4>' . htmlspecialchars($row['nombre']) . '</h4>';
                        echo '<p>' . htmlspecialchars($row['descripcion']) . '</p>';
                        echo '<p class="precio">' . htmlspecialchars($row['precio']) . ' €</p>';
                        echo '<button onclick="agregarCarrito(' . $row['id'] . ', \'' . htmlspecialchars($row['nombre']) . '\', ' . $row['precio'] . ')">Añadir al carrito</button>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No se encontraron productos en la base de datos.</p>';
                }
            } catch (PDOException $e) {
                echo "<p>Error en la consulta SQL: " . $e->getMessage() . "</p>";
            }
        } else {
            // ESTO SE MUESTRA MIENTRAS NO HAYA CONEXIÓN (Ideal para la revisión)
            echo '<div style="grid-column: 1 / -1; padding: 40px; background: #fff3cd; border: 1px solid #ffeeba; border-radius: 10px; text-align: center;">';
            echo '<h3 style="color: #856404;">🛠️ Modo de Diseño Activo</h3>';
            echo '<p>La conexión con la base de datos MySQL aún no se ha realizado. <br> Los productos aparecerán aquí automáticamente una vez se importe el archivo SQL en phpMyAdmin.</p>';
            echo '</div>';
        }
        ?>
    </div>

    <div id="carrito">
        <h3>Tu Pedido</h3>
        <ul id="lista-carrito">
            </ul>
        <p>Total: <span id="total">0.00</span> €</p>
        <button onclick="finalizarPedido()" class="btn" style="width: 100%; margin-top: 10px; cursor: pointer;">Finalizar Pedido</button>
    </div>
</section>

<script>
// Carrito de compras en JavaScript
let carrito = [];
let total = 0;

function agregarCarrito(id, nombre, precio) {
    carrito.push({id, nombre, precio});
    total += parseFloat(precio);
    mostrarCarrito();
}

function mostrarCarrito() {
    const lista = document.getElementById('lista-carrito');
    lista.innerHTML = '';
    carrito.forEach((item, index) => {
        lista.innerHTML += `<li>${item.nombre} - ${item.precio}€ <button onclick="eliminarItem(${index})" style="background:red; color:white; border:none; padding:2px 5px; border-radius:3px; cursor:pointer;">X</button></li>`;
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
    let nombre = prompt("Ingresa tu nombre para el pedido:");
    let email = prompt("Ingresa tu email:");
    if(nombre && email){
        alert("¡Gracias " + nombre + "! Pedido enviado correctamente (Simulación).");
        carrito = [];
        total = 0;
        mostrarCarrito();
    }
}
</script>

<?php include 'includes/footer.php'; ?>