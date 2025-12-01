<?php
/*
 |--------------------------------------------------------------------------
 | PROCESAR RESEÑA
 |--------------------------------------------------------------------------
 | - Recibe puntuacion y comentario via POST
 | - Valida datos
 | - Inserta en la tabla resenas con el id del usuario
 | - Redirige con mensaje
 */

session_start();
require '../includes/db.php';

// Comprobar que el usuario está logeado
if (empty($_SESSION['user'])) {
    header("Location: ../login.php?msg=login_required");
    exit;
}

// Recoger datos
$puntuacion = isset($_POST['puntuacion']) ? intval($_POST['puntuacion']) : 0;
$comentario = trim($_POST['comentario'] ?? '');

// Validaciones básicas
if ($puntuacion < 1 || $puntuacion > 5) {
    header("Location: resenas.php?error=Valoraci%C3%B3n%20inv%C3%A1lida");
    exit;
}

// (Opcional) Evitar que un usuario deje más de una reseña:
// Puedes descomentar este bloque si prefieres permitir solo una reseña por usuario.
/*
$check = $pdo->prepare("SELECT COUNT(*) FROM resenas WHERE usuario_id = ?");
$check->execute([$_SESSION['user']['id']]);
if ($check->fetchColumn() > 0) {
    header("Location: resenas.php?error=Ya%20has%20dejado%20una%20reseña");
    exit;
}
*/

// Insertar en la BD
$stmt = $pdo->prepare("INSERT INTO resenas (usuario_id, puntuacion, comentario) VALUES (?, ?, ?)");
$stmt->execute([$_SESSION['user']['id'], $puntuacion, $comentario]);

// Redirigir con OK
header("Location: resenas.php?ok=1");
exit;
