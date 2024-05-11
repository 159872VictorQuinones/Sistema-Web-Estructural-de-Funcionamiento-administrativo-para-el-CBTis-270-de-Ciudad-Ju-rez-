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

    $perfil = $_GET['perfil'];
    $id = $_GET['id'];

    $results_user = mysqli_query($conn, "SELECT * FROM usuarios WHERE ID=$id");
    $user = mysqli_fetch_assoc($results_user);
    $email_user = $user['email'];


    $results = mysqli_query($conn, "SELECT * FROM requisicion WHERE user_id='$id'");
    
    // Instanciar el objeto PHPMailer
    $mail = new PHPMailer(true);
    

    try {
      // Verificar si hay resultados
        if ($results) {
            // Iniciar el mensaje HTML
            $message = "
                <html>
                    <head>
                        <meta charset='UTF-8'>
                    </head>
                    <body style='background-color: #f7f7f7; padding: 20px;'>
                        <p>Resultados:</p>
                        <ul>"; // Agregar una lista desordenada para los resultados

                        while ($row = mysqli_fetch_assoc($results)) {                        
                            // Agregar cada fila como un elemento <;>
                            $message .= "<li>
                            <h3>REQUISICIÓN:</h3>
                            <p>No. Prioridad: " . $row['no_prioridad'] . "</p>
                            <p>Fecha: " . $row['fecha'] . "</p>
                            <p>Departamento: " . $row['departamento'] . "</p>
                            <p>Materiales: " . $row['materiales'] . "</p>
                            <p>Descripción: " . $row['descripcion'] . "</p>
                            <p>Cantidad: " . $row['cantidad'] . "</p>
                            <p>Unidad: " . $row['unidad'] . "</p>
                            <p>Importe: " . $row['importe'] . "</p>
                            <p>Usuario: " . $email_user . "</p>
                          </li><hr>";
                        }

        } else {
            // Si no hay resultados, mostrar un mensaje de error o hacer otra acción según sea necesario
            $message = "<p>No se encontraron resultados.</p>";
        }

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
        if($perfil == "DIRECTOR") {
            $mail->addAddress('direccion@cbtis270.edu.mx'); // CAMBIAR EMAIL
        } else {
            $mail->addAddress('recursosfinancieros@cbtis270.edu.mx'); // CAMBIAR EMAIL
        }

        // Configurar el asunto y el cuerpo del mensaje
        $mail->Subject = 'Nuevo Correo de Sistema CBTis - Requisición';
        $mail->IsHTML(true);
        $mail->Body = $message;

        // Enviar el correo
        $mail->send();
        
        header('Location: ../gracias.php');
    } catch (Exception $e) {
        echo "Error al enviar el correo: {$mail->ErrorInfo}";
    }
    
?>
