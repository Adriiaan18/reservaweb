<?php
session_start();
include 'includes/db.php';

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit;
}

// Contar registros
$total_pedidos = $conn->query("SELECT COUNT(*) FROM pedidos")->fetchColumn();
$total_comentarios = $conn->query("SELECT COUNT(*) FROM comentarios")->fetchColumn();
$total_reservas = $conn->query("SELECT COUNT(*) FROM reservas")->fetchColumn();
$total_pagos = $conn->query("SELECT SUM(total) FROM pagos")->fetchColumn();
?>

<section class="admin-dashboard">
    <h2>Panel Administrador</h2>

    <div class="estadisticas">
        <p>Pedidos: <?php echo $total_pedidos; ?></p>
        <p>Comentarios: <?php echo $total_comentarios; ?></p>
        <p>Reservas: <?php echo $total_reservas; ?></p>
        <p>Total ingresos: €<?php echo number_format($total_pagos, 2); ?></p>
    </div>

    <div class="links-admin">
        <a href="admin_pedidos.php">Ver Pedidos</a>
        <a href="admin_comentarios.php">Ver Comentarios</a>
        <a href="admin_reservas.php">Ver Reservas</a>
        <a href="admin_productos.php">Gestionar Productos</a>
        <a href="admin_galeria.php">Gestionar Galería</a>
        <a href="logout.php">Cerrar sesión</a>
    </div>
</section>
