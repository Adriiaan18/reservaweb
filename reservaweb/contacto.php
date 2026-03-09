<?php 
include 'includes/header.php'; 
?>

<section class="hero-section">
    <div class="overlay">
        <div class="container-hero">
            <h1>Contacto</h1>
            <p>¿Tienes alguna duda o quieres hacer un pedido especial?</p>
            
            <form action="procesar_contacto.php" method="POST" class="form-resena-box">
                <input type="text" name="nombre" placeholder="Tu nombre" required>
                <input type="email" name="email" placeholder="Tu correo electrónico" required>
                <input type="text" name="asunto" placeholder="Asunto" required>
                <textarea name="mensaje" placeholder="Tu mensaje..." required style="min-height: 100px;"></textarea>
                <button type="submit" class="btn-enviar">Enviar Mensaje</button>
            </form>
        </div>
    </div>
</section>

<section class="info-contacto" style="padding: 40px 20px; text-align: center; max-width: 800px; margin: auto;">
    <h3>¿Dónde encontrarnos?</h3>
    <p>Estamos en el centro de Alcalá de Guadaíra, listos para servirte el mejor kebab.</p>
    <div class="datos" style="margin-top: 20px;">
        <p><strong>📍 Dirección:</strong> Av. de la Constitución, 12, Alcalá de Guadaíra</p>
        <p><strong>📞 Teléfono:</strong> 955 000 000</p>
        <p><strong>📧 Email:</strong> contacto@kebabal-sultan.com</p>
    </div>
</section>

<?php include 'includes/footer.php'; ?>