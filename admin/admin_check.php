<?php
/*
 |--------------------------------------------------------------------------
 | VERIFICAR ACCESO DE ADMINISTRADOR
 |--------------------------------------------------------------------------
 | Este archivo se incluye en cada página del panel.
 | Si el usuario no es admin → se le redirige fuera del panel.
 */

session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['rol'] !== 'admin') {
    // No tiene permisos → fuera
    header("Location: ../index.php");
    exit;
}
