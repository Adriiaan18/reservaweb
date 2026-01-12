<?php
$host = "localhost";
$user = "root";         // Usuario por defecto de XAMPP
$password = "";         // Contraseña por defecto de XAMPP
$dbname = "mi_kebab";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    // Configurar errores
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
