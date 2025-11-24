<?php
/*
 |--------------------------------------------------------------------------
 | CONFIRMAR PEDIDO
 |--------------------------------------------------------------------------
 | - Seleccionar tipo: domicilio o para llevar
 | - Si es domicilio → pedir dirección
 */

include '../includes/header.php';

if (empty($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}
?>

<h2>Confirmar pedido</h2>

<form action="procesar_pedido.php" method="POST">

    <label>Tipo de pedido:</label>
    <select name="tipo" required>
        <option value="domicilio">Domicilio</option>
        <option value="llevar">Para llevar</option>
    </select>

    <br>

    <label>Dirección (solo si es domicilio):</label>
    <textarea name="direccion"></textarea>

    <br>

    <button type="submit">Finalizar pedido</button>

</form>

<?php include '../includes/footer.php'; ?>
