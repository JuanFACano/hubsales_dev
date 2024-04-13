<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    public $correo;
    public $nombre;
    public $token;

    public function __construct($correo, $nombre, $token)
    {
        $this->correo = $correo;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {
        // ? Crear el objeto email
        /*         $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = '50a905555bc354';
        $phpmailer->Password = '3f8ce2bad7502a';

        $phpmailer->setFrom('cuentas@husales.com');
        $phpmailer->addAddress('cuentas@husales.com', 'hubsales.com');
        $phpmailer->Subject = "Confirma tu cuenta";

        // set HTML
        $phpmailer->isHTML(TRUE);
        $phpmailer->CharSet = 'UTF-8';
        $contenido = "<html>";
        $contenido .= "<p><strong>Hola  " . $this->nombre . "</strong> Has creao tu cuenta en hubsales, solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona aqui: <a href='http://localhost:3000/confirmar?token=" . $this->token . "'>Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";

        // Agregar HTML
        $phpmailer->Body = $contenido;

        // Enviar Ephp$phpmailer
        $phpmailer->send(); */
    }
}
