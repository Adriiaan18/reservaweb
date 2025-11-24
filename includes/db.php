<?php
/*
 |--------------------------------------------------------------------------
 | Archivo de conexión a la base de datos
 |--------------------------------------------------------------------------
 | Este archivo se incluye en TODAS las páginas que necesiten acceder a MySQL.
 | Su función es crear una conexión segura mediante PDO.
 */

$host = '127.0.0.1';     // Servidor local (XAMPP)
$db   = 'reservaweb';    // Nombre de tu base de datos
$user = 'root';          // Usuario por defecto de XAMPP
$pass = '';              // Contraseña vacía por defecto en XAMPP
$charset = 'utf8mb4';    // Charset recomendado

// Creamos el DSN (información de conexión)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Opciones recomendadas para PDO
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Muestra errores detallados
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Devuelve datos en arrays asociativos
];

try {
    // Intentamos crear la conexión
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // Si falla la conexión, mostramos error y detenemos ejecución
    exit('Error en la conexión: ' . $e->getMessage());
}
?>
