<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Email{
    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token){
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;    
    }

    public function enviarConfirmacion(){
        // Creo el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 2525;
        $mail->Username = '7ec5053d4c0bbc';
        $mail->Password = '1359d049c863ae';

        $mail->setFrom('cuenta@app.com');
        $mail->addAddress('cuenta2@app.com','app.com');
        $mail->Subject = 'Confirma tu cuenta compadre';

        // Codigo Html
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';
        $contenido = "<html>";
        $contenido .= "<p><strong>Hola Compadre ".$this->nombre." Has creado tu cuenta en 
        el sistema, confirmala presionando el siguiente enlace </strong></p>";
        $contenido .= "<p>Presiona aqui: <a href='http://localhost:3000/confirmar-cuenta?token="
        .$this->token."'>Confirma la cuenta compadre</a></p>";
        $contenido .= "<p>Si tu no solicitaste nada, ignora el mensaje compadre</p>";
        $contenido .= "</html>";
        //Le paso el contenido al body
        $mail->Body = $contenido;
        $mail->send();
    }

    public function enviarInstrucciones(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 2525;
        $mail->Username = '7ec5053d4c0bbc';
        $mail->Password = '1359d049c863ae';

        $mail->setFrom('cuenta@app.com');
        $mail->addAddress('cuenta2@app.com','app.com');
        $mail->Subject = 'Reestablece la contraseña Compadre';

        // Codigo Html
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';
        $contenido = "<html>";
        $contenido .= "<p><strong>Hola Compadre ".$this->nombre." Has solicitado
        reestablecer tu contraseña, sigue el enlace</strong></p>";
        $contenido .= "<p>Presiona aqui: <a href='http://localhost:3000/recuperar?token="
        .$this->token."'>Reestablecer contraseña compadre</a></p>";
        $contenido .= "<p>Si tu no solicitaste nada, ignora el mensaje compadre</p>";
        $contenido .= "</html>";
        //Le paso el contenido al body
        $mail->Body = $contenido;
        $mail->send();

    }

    public function enviarPermiso(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 2525;
        $mail->Username = '7ec5053d4c0bbc';
        $mail->Password = '1359d049c863ae';

        $mail->setFrom('cuenta@app.com');
        $mail->addAddress('cuenta2@app.com','app.com');
        $mail->Subject = 'Permiso Aprobado Compadre, que felicidad';

        // Codigo Html
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';
        $contenido = "<html>";
        $contenido .= "<p><strong>Hola Compadre ".$this->nombre." Tu permiso ha sido aprobado</strong></p>";
        $contenido .= "<p>. Ya Te puedes retirar de la empresa";
        $contenido .= "<p>Si tu no solicitaste nada, ignora el mensaje compadre</p>";
        $contenido .= "</html>";
        //Le paso el contenido al body
        $mail->Body = $contenido;
        $mail->send();
    }


}