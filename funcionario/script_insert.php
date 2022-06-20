<?php

            include "resize-class.php";

            header('Content-type: text/html; charset=utf-8');
                
            include '../conn.php';

            mysqli_set_charset($conn,"utf8");

            session_start();

            if(isset($_POST['nome'])){
                $nome = $_POST['nome'];
            }
            if(isset($_POST['email'])){
                $email = $_POST['email'];
            }
            if(isset($_POST['senha'])){
                $senha = $_POST['senha'];
            }
            if (isset($_POST['g-recaptcha-response'])) {
                $captcha_data = $_POST['g-recaptcha-response'];
            }

            if (!$captcha_data) {
                $_SESSION['msgLogin'] = "<div class='form-floating mb-3'><div class= 'alert alert-danger'>Por favor, preencha o captcha.</div></div>";
                header('Location: '."login.php");
            }

            $resposta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfKeoUgAAAAAEFbI_DDnIsYg8bZtw4k8p8SbUW_&response=".$captcha_data."&remoteip=".$_SERVER['REMOTE_ADDR']);

            if ($resposta.success) {
            
                $sql = "INSERT INTO funcionario (nome, email, senha) VALUES (?,?,?)";

                $stmt = mysqli_stmt_init($conn);
                $stmt_prepared_okay = mysqli_stmt_prepare($stmt,$sql);

                if($stmt_prepared_okay){
                    mysqli_stmt_bind_param($stmt, "sss", $nome, $email,$senha);

                    $stmt_executed_okay = mysqli_stmt_execute($stmt);     

                    if ($stmt_executed_okay) {
                        header("Location: " . "dashboard_page.php");
                    } else {
                        echo "Não foi possível executar a inserção de ".
                            "$nome, $email, $senha no banco de dados". 
                            mysqli_error($conn);
                        exit;
                    }
                        mysqli_stmt_close($stmt);
                }

                $conn->close();
            }
            else{
                $_SESSION['msgLogin'] = "<div class='form-floating mb-3'><div class= 'alert alert-danger'>Usuário mal intencionado detectado. A mensagem não foi enviada.</div></div>";
                header('Location: '."login.php");
            }
?>