<?php
/*
 |--------------------------------------------------------------------------
 | PROCESAR FORMULARIO DE CONTACTO
 |--------------------------------------------------------------------------
 | 1. Recibe el formulario
 | 2. Lo guarda en la base de datos
 | 3. Envía una copia al admin usando PHPMailer
 */

require '../includes/db.php';
require '../includes/mailer.php'; // archivo donde configuraremos PHPMailer

// Recoger datos
$nombre = trim($_POST['nombre'] ?? '');
$email  = trim($_POST['email'] ?? '');
$mensaje = trim($_POST['mensaje'] ?? '');

// Validación básica
if ($nombre == '' || $email == '' || $mensaje == '') {
    header("Location: contacto.php?error=Rellena%20todos%20los%20campos");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: contacto.php?error=Email%20inv%C3%A1lido");
    exit;
}

// Guardar en BD
$stmt = $pdo->prepare("INSERT INTO contacto(nombre, email, mensaje) VALUES (?, ?, ?)");
$stmt->execute([$nombre, $email, $mensaje]);

// Enviar correo al admin
enviarCorreoContacto($nombre, $email, $mensaje);

// Redirigir OK
header("Location: contacto.php?ok=1");
exit;
