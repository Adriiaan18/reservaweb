<?php
/*
 |--------------------------------------------------------------------------
 | LOGOUT
 |--------------------------------------------------------------------------
 | - Destruye la sesión
 | - Redirige a inicio
 */

session_start();
session_unset();
session_destroy();

header("Location: index.php");
exit;
