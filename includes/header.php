<?php
/*
 |--------------------------------------------------------------------------
 | HEADER
 |--------------------------------------------------------------------------
 | Aquí va el menú, los enlaces a CSS y la apertura del HTML.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Aseguramos siempre sesión iniciada
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Restaurante</title>

    <!-- Vinculamos el CSS principal -->
    <link rel="stylesheet" href="/reservaweb/assets/css/style.css">
</head>
<body>

<header>
    <nav>
        <!-- Enlaces visibles para todos -->
        <a href="/reservaweb/index.php">Inicio</a>
        <a href="/reservaweb/pages/mis_reservas.php">Mis Reservas</a> <!-- acceso al historial de las reservas-->
        <a href="/reservaweb/pages/pedidos.php">Pedidos</a>
        <a href="/reservaweb/pages/galeria.php">Galería</a>
        <a href="/reservaweb/pages/contacto.php">Contacto</a>

        <!-- Si hay un usuario logeado -->
        <?php if (!empty($_SESSION['user'])): ?>

            <!-- Si el usuario es administrador -->
            <?php if ($_SESSION['user']['rol'] === 'admin'): ?>
                <a href="/reservaweb/pages/admin/index.php">Panel Admin</a>
            <?php endif; ?>

            <!-- Mostrar botón de cerrar sesión -->
            <a href="/reservaweb/logout.php">Salir (<?= htmlspecialchars($_SESSION['user']['nombre']); ?>)</a>

        <?php else: ?>
            <!-- Si NO está logeado -->
            <a href="/reservaweb/login.php">Login</a>
            <a href="/reservaweb/registro.php">Registro</a>
        <?php endif; ?>

    </nav>
</header>

<main>
