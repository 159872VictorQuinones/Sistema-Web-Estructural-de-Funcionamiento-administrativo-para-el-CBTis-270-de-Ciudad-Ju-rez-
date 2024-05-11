<?php
    // incluir phpmailer para el envio de correos electronicos
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require './phpmailer/src/PHPMailer.php';
    require './phpmailer/src/SMTP.php';
    require './phpmailer/src/Exception.php';

    // incluir base de datos
    include('../db.php');

    $conn = mysqli_connect($host, $user, $pass, $db);

    if (mysqli_connect_errno()) {
        echo "Fallo la conexion a la base de datos: " . mysqli_connect_error();
    } 

    session_start();
    $email_en_sesion = $_SESSION['email'];

    $email = $_POST['email'];
    $message = $_POST['message'];

    // Instanciar el objeto PHPMailer
    $mail = new PHPMailer(true);

    try {
        $message = "
            <html>
                <head></head>
                <body>
                    <p>Email enviado por: "  . $email_en_sesion . "</p>
                    <div style='background-color: #f7f7f7; padding: 20px;'>
                        <p>EMAIL: " . $email . "</p>
                        <p>Mensaje: " . $message . "</p>
                    </div>
               
                </body>
            </html>
        ";

        // Configurar el servidor SMTP
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "ssl";
        $mail->Username   = 'sistemacbtis@gmail.com';
        $mail->Password   = 'iueogcumwfcohoet';
        $mail->Port = 465;

        // Configurar el remitente y destinatario

        // REMITENTE
        $mail->setFrom('sistemacbtis@gmail.com');
        // DESTINATARIO
        $mail->addAddress($email);

        // Configurar el asunto y el cuerpo del mensaje
        $mail->Subject = 'Nuevo Correo de Sistema CBTis';
        $mail->IsHTML(true);
        $mail->Body = $message;

        // Enviar el correo
        $mail->send();
        
        header('Location: ../gracias.php');
    } catch (Exception $e) {
        echo "Error al enviar el correo: {$mail->ErrorInfo}";
    }
    
?>
