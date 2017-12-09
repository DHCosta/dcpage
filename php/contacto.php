<?php

require("class.phpmailer.php");
require("class.smtp.php"); 

    $exitoN = TRUE;
    $exitoE = TRUE;

    $nombre = @trim(stripslashes($_POST['nombre'])); 
    $apellido = @trim(stripslashes($_POST['apellido']));
    $email = @filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $mensaje = @trim(stripslashes($_POST['mensaje']));

    if (empty($nombre) or empty($apellido)) {
        $exitoN = FALSE;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $exitoE = FALSE;
    }

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "ssl"; 
    $mail->Host = "smtp.gmail.com"; // SMTP a utilizar. Por ej. smtp.elserver.com
    $mail->Username = "dariocostawm@gmail.com"; // Correo completo a utilizar
    $mail->Password = "XXXXXXXX"; // Contraseña
    $mail->Port = 465; // Puerto a utilizar
    $mail->From = "dariocostawm@gmail.com"; // Desde donde enviamos (Para mostrar)
    $mail->FromName = "Dario.WebMaster";
    $mail->AddAddress("dariocostawm@gmail.com"); // Esta es la dirección a donde enviamos
    //$mail->AddCC("xxxxxx@gmail.com"); // Copia
    //$mail->AddBCC("xxxxxx@gmail.com"); // Copia oculta
    $mail->IsHTML(true); // El correo se envía como HTML
    $mail->Subject = "NUEVO CORREO DE PAGINAWM"; // Este es el titulo del email.
    $body = '<strong>Nombre:</strong> ' . $nombre . "<br>" . 
            '<strong>Apellido:</strong> ' . $apellido . "<br><br>" . 
            '<strong>Email:</strong> ' . $email . "<br><br>" . 
            '<strong>Mensaje:</strong> ' . $mensaje;
    $mail->Body = $body; // Mensaje a enviar

    if (!$exitoN) {
           echo'<div class="alert alert-warning alert-dismissible formulario-ms" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            No olvides completar tu <strong>NOMBRE</strong> y <strong>APELLIDO</strong>
            </div>';
    }
    elseif(!$exitoE) {
            echo'<div class="alert alert-warning alert-dismissible formulario-ms" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            El <strong>EMAIL</strong> ingresado no es válido</div>';
    }
    elseif($exitoN) {
        $exito = $mail->Send(); // Envía el correo.                         
        
        if ($exito){
            echo'<div class="alert alert-success alert-dismissible formulario-ms" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>¡GRACIAS!</strong><br> Tu mensaje fue enviado correctamente, me contacto con vos a la brevedad
            </div>';       
        }
        else {
            echo'<div class="alert alert-danger alert-dismissible formulario-ms" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>HUBO UN ERROR AL ENVIAR EL CORREO</strong><br> Intenta una vez más o contactame en forma privada a <strong>dariocostawm@gmail.com</strong>
            </div>';
        }
    
        include("agregar_contacto.php"); 
    }        
?>
