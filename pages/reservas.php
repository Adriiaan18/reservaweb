<?php
/*
 |--------------------------------------------------------------------------
 | FORMULARIO DE RESERVAS
 |--------------------------------------------------------------------------
 | - Solo accesible si el usuario está logeado
 | - Envia datos a procesar_reserva.php
 */

include '../includes/header.php';

// Si NO está logeado → redirigir al login
if (empty($_SESSION['user'])) {
    header("Location: ../login.php?msg=login_required");
    exit;
}
?>

<h2>Reservar mesa</h2>

<form action="procesar_reserva.php" method="POST">

    <!-- Fecha de la reserva -->
    <label>Fecha:</label>
    <input type="date" name="fecha" required>

    <!-- Hora -->
    <label>Hora:</label>
    <input type="time" name="hora" required>

    <!-- Número de personas -->
    <label>Número de personas:</label>
    <input type="number" name="personas" min="1" max="20" required>

    <!-- Comentario opcional -->
    <label>Comentario (opcional):</label>
    <textarea name="comentario"></textarea>

    <button type="submit">Reservar</button>

</form>

<?php include '../includes/footer.php'; ?>
