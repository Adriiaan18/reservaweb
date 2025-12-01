<?php
include 'admin_check.php';
require '../includes/db.php';

/*
 |--------------------------------------------------------------------------
 | GUARDAR IMAGEN EN BD + CARPETA
 |--------------------------------------------------------------------------
 */

$titulo = $_POST['titulo'];

// Verificar que hay archivo
if (!empty($_FILES['imagen']['name'])) {

    // Creamos un nombre único
    $archivo = time() . "_" . $_FILES['imagen']['name'];

    // Carpeta destino
    $destino = "../uploads/galeria/" . $archivo;

    // Subir archivo
    move_uploaded_file($_FILES['imagen']['tmp_name'], $destino);

    // Insertamos en BD
    $stmt = $pdo->prepare("INSERT INTO galeria (archivo, titulo) VALUES (?, ?)");
    $stmt->execute([$archivo, $titulo]);
}

header("Location: galeria.php?ok=1");
exit;
