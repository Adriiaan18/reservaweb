<?php
/*
 |--------------------------------------------------------------------------
 | PROCESAR RESERVA
 |--------------------------------------------------------------------------
 | - Recibe datos del formulario
 | - Verifica disponibilidad
 | - Inserta la reserva en la BD
 */

session_start();

if (empty($_SESSION['user'])) {
    header("Location: ../login.php?msg=login_required");
    exit;
}

require '../includes/db.php';

// Recibimos datos del formulario
$usuario_id = $_SESSION['user']['id'];
$fecha      = $_POST['fecha'];
$hora       = $_POST['hora'];
$personas   = $_POST['personas'];
$comentario = $_POST['comentario'] ?? null;

// Validación básica
if (!$fecha || !$hora || !$personas) {
    exit("Error: faltan datos.");
}

/*
 |--------------------------------------------------------------------------
 | 1) COMPROBAR DISPONIBILIDAD
 |--------------------------------------------------------------------------
 | Buscamos si ya hay una reserva a la misma fecha y hora.
 */

$check = $pdo->prepare("SELECT * FROM reservas WHERE fecha = ? AND hora = ?");
$check->execute([$fecha, $hora]);
$reserva_existente = $check->fetch();

if ($reserva_existente) {
    // Ya existe una reserva → no permitir
    header("Location: reservas.php?error=ocupado");
    exit;
}

/*
 |--------------------------------------------------------------------------
 | 2) GUARDAR RESERVA
 |--------------------------------------------------------------------------
 */

$stmt = $pdo->prepare("
    INSERT INTO reservas (usuario_id, fecha, hora, personas, comentario)
    VALUES (?, ?, ?, ?, ?)
");

$stmt->execute([$usuario_id, $fecha, $hora, $personas, $comentario]);

// Redirigir a página de reservas del usuario
header("Location: mis_reservas.php?ok=1");
exit;
