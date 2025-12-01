<?php
/*
 |--------------------------------------------------------------------------
 | FORMULARIO DE CONTACTO (Página pública)
 |--------------------------------------------------------------------------
 | Guarda mensajes en BD + los envía al admin.
 */

include '../includes/header.php';
?>

<h2>Contacto</h2>

<!-- Mensajes de retorno -->
<?php if (!empty($_GET['ok'])): ?>
    <p style="color: green;">¡Mensaje enviado correctamente! Te responderemos pronto.</p>
<?php endif; ?>

<?php if (!empty($_GET['error'])): ?>
    <p style="color: red;"><?= htmlspecialchars($_GET['error']); ?></p>
<?php endif; ?>

<form action="procesar_contacto.php" method="POST">
    <label>Tu nombre:</label>
    <input type="text" name="nombre" required>

    <label>Tu email:</label>
    <input type="email" name="email" required>

    <label>Mensaje:</label>
    <textarea name="mensaje" rows="6" required></textarea>

    <button type="submit">Enviar mensaje</button>
</form>

<?php include '../includes/footer.php'; ?>
