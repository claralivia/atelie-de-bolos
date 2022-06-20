<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';

    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.gmail.com';                     
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'delicakebrasil@gmail.com';                     
        $mail->Password   = 'gckfraxparvfmmiy';                               
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;                                    

        
        $mail->setFrom('delicakebrasil@gmail.com', 'Delicake');
        $mail->addAddress('delicakebrasil@gmail.com', 'Delicake');        
        $mail->addReplyTo('delicakebrasil@gmail.com', 'Informação');
        $mail->isHTML(true);
        $mail->Subject = 'Mensagem de Contato - Delicake Brasil';

        $body = "Mensagem enviada através do site, segue abaixo as informações:<br>
                 Nome: " . $_POST['nome'] . "<br>
                 E-mail: " . $_POST['email'] . "<br>
                 Mensagem:<br>". 
                 $_POST['mensagem'];

        $mail->Body    = $body;

        $mail->send();

        header('Location: ' . 'confirmContato.html');
    } catch (Exception $e) {
        $_SESSION['msgErro'] = "<div class='form-floating mb-3'><div class= 'alert alert-danger'>Erro ao enviar email.</div></div>";
    }
