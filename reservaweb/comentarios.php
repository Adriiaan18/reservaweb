<?php 
include 'includes/header.php'; 
include 'includes/db.php';
?>

<section class="hero-section">
    <div class="overlay">
        <div class="container-hero">
            <h1>Deja tu reseña</h1>
            <p>Tu opinión nos ayuda a mejorar nuestro sabor</p>
            
            <form action="procesar_comentario.php" method="POST" class="form-resena-box">
                <input type="text" name="nombre" placeholder="Nombre" required>
                <input type="email" name="email" placeholder="Email" required>
                <textarea name="comentario" placeholder="Tu comentario" required></textarea>
                <select name="valoracion">
                    <option value="5">⭐⭐⭐⭐⭐ (Excelente)</option>
                    <option value="4">⭐⭐⭐⭐ (Muy bueno)</option>
                    <option value="3">⭐⭐⭐ (Normal)</option>
                    <option value="2">⭐⭐ (Regular)</option>
                    <option value="1">⭐ (Malo)</option>
                </select>
                <button type="submit" class="btn-enviar">Enviar Reseña</button>
            </form>
        </div>
    </div>
</section>

<section class="resenas-recientes" style="padding: 40px 20px; max-width: 800px; margin: auto;">
    <h3>Reseñas recientes</h3>
    <?php
    if (isset($conn) && $conn !== null) {
        try {
            $query = "SELECT * FROM resenas ORDER BY fecha DESC";
            $stmt = $conn->query($query);
            
            if ($stmt->rowCount() > 0) {
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="resena-card" style="border:1px solid #ddd; padding:15px; margin-bottom:10px; border-radius:8px;">';
                    echo '<strong>' . htmlspecialchars($row['nombre']) . '</strong>';
                    echo '<p>' . htmlspecialchars($row['comentario']) . '</p>';
                    echo '<span>Valoración: ' . $row['valoracion'] . '/5</span>';
                    echo '</div>';
                }
            } else {
                echo '<p>Aún no hay reseñas. ¡Sé el primero en opinar!</p>';
            }
        } catch (PDOException $e) {
            echo "<p>Error al cargar reseñas: " . $e->getMessage() . "</p>";
        }
    } else {
        echo '<div style="padding: 20px; background: #f8f9fa; border-left: 5px solid #000; border-radius: 4px; margin-top: 20px;">';
        echo '<p style="margin: 0;">💬 <strong>Sistema de Feedback:</strong> Las reseñas se cargarán dinámicamente desde la base de datos una vez se complete la migración del esquema SQL.</p>';
        echo '</div>';
    }
    ?>
</section>

<?php include 'includes/footer.php'; ?>