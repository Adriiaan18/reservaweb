<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}
?>

<h2>Deja tu comentario</h2>

<form action="procesar_comentario.php" method="POST">
    <label>Valoración (1-5):</label>
    <select name="valoracion" required>
        <option value="1">⭐</option>
        <option value="2">⭐⭐</option>
        <option value="3">⭐⭐⭐</option>
        <option value="4">⭐⭐⭐⭐</option>
        <option value="5">⭐⭐⭐⭐⭐</option>
    </select>

    <label>Comentario:</label>
    <textarea name="comentario" required></textarea>

    <button type="submit">Enviar comentario</button>
</form>
