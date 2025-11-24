<?php
/*
 |--------------------------------------------------------------------------
 | PANEL DE ADMINISTRADOR
 |--------------------------------------------------------------------------
 | Desde aquí se accede a todas las gestiones:
 | - Productos
 | - Pedidos
 | - Reservas
 | - Usuarios
 */

include 'admin_check.php';
include '../includes/header.php';
?>

<h1>Panel de Administración</h1>

<ul>
    <li><a href="productos.php">Gestionar Productos</a></li>
    <li><a href="pedidos.php">Ver Pedidos</a></li>
    <li><a href="reservas.php">Ver Reservas</a></li>
    <li><a href="usuarios.php">Ver Usuarios</a></li>
</ul>

<?php include '../includes/footer.php'; ?>
