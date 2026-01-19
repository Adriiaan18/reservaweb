<?php
include 'includes/header.php';
include 'includes/db.php';

$mensaje = '';

// Manejo del envío del formulario de reseña
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $comentario = $_POST['comentario'] ?? '';
    $valoracion = $_POST['valoracion'] ?? '';

    if ($nombre && $email && $comentario && $valoracion) {
        $stmt = $conn->prepare("INSERT INTO comentarios (nombre, email, comentario, valoracion) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nombre, $email, $comentario, $valoracion]);
        $mensaje = "¡Gracias por tu reseña!";
    } else {
        $mensaje = "Por favor, completa todos los campos.";
    }
}
?>

<section class="comentarios">
    <h2>Deja tu reseña</h2>

    <?php if($mensaje): ?>
        <p class="mensaje"><?php echo htmlspecialchars($mensaje); ?></p>
    <?php endif; ?>

    <!-- Formulario de reseña -->
    <form method="POST" action="">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="email" name="email" placeholder="Email" required>
        <textarea name="comentario" placeholder="Tu comentario" rows="4" required></textarea>
        <select name="valoracion" required>
            <option value="">Valoración</option>
            <option value="1">⭐</option>
            <option value="2">⭐⭐</option>
            <option value="3">⭐⭐⭐</option>
            <option value="4">⭐⭐⭐⭐</option>
            <option value="5">⭐⭐⭐⭐⭐</option>
        </select>
        <button type="submit">Enviar</button>
    </form>

    <!-- Formulario de filtro -->
    <form method="GET" action="comentarios.php" class="form-filtro">
        <select name="valoracion">
            <option value="">Mostrar todas</option>
            <option value="5" <?php if(isset($_GET['valoracion']) && $_GET['valoracion']==5) echo 'selected'; ?>>⭐⭐⭐⭐⭐</option>
            <option value="4" <?php if(isset($_GET['valoracion']) && $_GET['valoracion']==4) echo 'selected'; ?>>⭐⭐⭐⭐</option>
            <option value="3" <?php if(isset($_GET['valoracion']) && $_GET['valoracion']==3) echo 'selected'; ?>>⭐⭐⭐</option>
            <option value="2" <?php if(isset($_GET['valoracion']) && $_GET['valoracion']==2) echo 'selected'; ?>>⭐⭐</option>
            <option value="1" <?php if(isset($_GET['valoracion']) && $_GET['valoracion']==1) echo 'selected'; ?>>⭐</option>
        </select>
        <button type="submit">Filtrar</button>
    </form>

    <h3>Reseñas recientes</h3>
    <div class="lista-comentarios">
        <?php
        // Obtener el filtro de valoración si existe
        $filtro_valoracion = isset($_GET['valoracion']) ? $_GET['valoracion'] : '';

        if ($filtro_valoracion != '') {
            $stmt = $conn->prepare("SELECT * FROM comentarios WHERE valoracion = ? ORDER BY created_at DESC");
            $stmt->execute([$filtro_valoracion]);
        } else {
            $stmt = $conn->query("SELECT * FROM comentarios ORDER BY created_at DESC");
        }

        // Mostrar comentarios
        if ($stmt->rowCount() > 0) {
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="comentario">';
                echo '<strong>' . htmlspecialchars($row['nombre']) . '</strong> ';
                echo '<span class="valoracion">';
                for($i=0; $i<$row['valoracion']; $i++) echo '⭐';
                echo '</span>';
                echo '<p>' . htmlspecialchars($row['comentario']) . '</p>';
                echo '</div>';
            }
        } else {
            echo '<p>No hay reseñas para mostrar con esta valoración.</p>';
        }
        ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
