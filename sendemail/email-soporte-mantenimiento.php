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

    date_default_timezone_set('America/Mexico_City'); // Cambia 'America/Mexico_City' a tu zona horaria deseada

    $nombreSolicitante = $_POST['nombreSolicitante'];
    $problema = $_POST['problema'];
    $masDetalles = $_POST['masDetalles'];
    $departamento = $_POST['departamento'];
    $fechaDeReporte = date("Y-m-d");
    $horaDeReporte = date("h:i A");
    $turno = $_POST['turno'];
    $otroProblema = $_POST['otroProblema'];
    $otroDepartamento = $_POST['otroDepartamento'];
    
    // Instanciar el objeto PHPMailer
    $mail = new PHPMailer(true);

    try {
        $message = "
            <html>
                <head></head>
                <body style='background-color: #f7f7f7; padding: 20px;'>
                    <p>Nombre del solicitante: " . $nombreSolicitante . "</p>
                    <p>Problema: " . $problema . $otroProblema . $masDetalles . "</p>
                    <p>Departamento: " . $departamento . $otroDepartamento . "</p>
                    <p>Fecha de Reporte: " . $fechaDeReporte . "</p>
                    <p>Hora de Reporte: " . $horaDeReporte . "</p>
                    <p>Turno: " . $turno . "</p>
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
        $mail->setFrom('sistemacbtis@gmail.com');
        $mail->addAddress('mantenimiento@cbtis270.edu.mx');

        // Configurar el asunto y el cuerpo del mensaje
        $mail->Subject = 'Nuevo Correo de Sistema CBTis - Soporte Técnico de Mantenimiento';
        $mail->IsHTML(true);
        $mail->Body = $message;

        // Enviar el correo
        $mail->send();
        
        header('Location: ../gracias.php');
    } catch (Exception $e) {
        echo "Error al enviar el correo: {$mail->ErrorInfo}";
    }
    
?>
