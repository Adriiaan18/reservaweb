<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Incluir PHPMailer
require __DIR__.'/PHPMailer/Exception.php';
require __DIR__.'/PHPMailer/PHPMailer.php';
require __DIR__.'/PHPMailer/SMTP.php';

/*
 |--------------------------------------------------------------------------
 | FUNCIÓN PARA ENVIAR MENSAJES DE CONTACTO
 |--------------------------------------------------------------------------
 | Llamada automáticamente desde procesar_contacto.php
 */

function enviarCorreoContacto($nombre, $email, $mensaje) {
    
    $mail = new PHPMailer(true);

    try {
        // CONFIGURACIÓN SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';   // Servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'a.rodriguez.gallardo@iescristobaldemonroy.es';
        $mail->Password = 'monroyqwepoizxc.,m
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // REMITENTE
        $mail->setFrom('a.rodriguez.gallardo@iescristobaldemonroy.es', 'Formulario Web');

        // DESTINATARIO (Admin)
        $mail->addAddress('a.rodriguez.gallardo@iescristobaldemonroy.es', 'Administrador');

        // CONTENIDO
        $mail->isHTML(true);
        $mail->Subject = "Nuevo mensaje de contacto";
        $mail->Body = "
            <h3>Nuevo mensaje recibido:</h3>
            <p><strong>Nombre:</strong> $nombre</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Mensaje:</strong><br>$mensaje</p>
        ";

        $mail->send();
    } catch (Exception $e) {
        // Si falla el envío, no afecta al guardado en BD
    }
}
