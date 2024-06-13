<?php
// Path: php/email.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require './PHPMailer/Exception.php';
require './PHPMailer/PHPMailer.php';
require './PHPMailer/SMTP.php';

$mail = new PHPMailer();
try {
    $mail->isSMTP(true);

    //Configuracion del servidor
    $mail->SMTPAuth   = true;
    $mail->Username   = 'info@darielsmartinezedib.com';
    $mail->Password   = 'd4rieLs_*3dib';
    $mail->Host       = 'smtp.dondominio.com';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    //Destinatarios
    $mail->setFrom('info@darielsmartinezedib.com', 'Administrador de la web'); //quien lo manda
    $mail->addReplyTo('info@darielsmartinezedib.com', 'Administrador de la web'); //quien lo manda
    $mail->addAddress('darielsmartinez926@gmail.com', 'Dariels Mtz'); //quien lo recibe

    //Contenido del Email
    $mail->isHTML(true);
    $mail->Subject = 'Registro de Usuario';
    $mail->Body    = '<h1>Testeo del envio de mail</h1><p>Comprobacion del correcto envio de email</p>';
    $mail->AltBody = 'Registro';

    //Envio del Email
    if ($mail->send()) {
        echo '¡El mensaje ha sido enviado!';
    } else {
        echo $mail->ErrorInfo;
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}