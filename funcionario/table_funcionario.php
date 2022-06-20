<?php

        session_start();

        header('Content-type: text/html; charset=utf-8');
            
        include '../conn.php';

        if(isset($_POST['email'])){
            $_SESSION['email'] = $_POST['email'];
            $email = $_SESSION['email'];
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

            $sql = "SELECT email, senha FROM funcionario WHERE email='$email' LIMIT 1";

            $result = mysqli_query($conn, $sql);

            if($result){
                $row = mysqli_fetch_assoc($result);

                if($email == $row['email']){
                    if($senha == $row["senha"]){
                        header('Location: '."dashboard_page.php");
                    }
                    else{
                        $_SESSION['msgLogin'] = "<div class='form-floating mb-3'><div class= 'alert alert-danger'>Senha incorreta.</div></div>";
                        header('Location: '."login.php");
                    }                      
                }
                else if($email != "" && $email != $row['email']){
                    $ncadastrado = 1;
                } 

                if ($ncadastrado == 1){
                    $_SESSION['msgLogin'] = "<div class='form-floating mb-3'><div class= 'alert alert-danger'>Usuário não cadastrado.</div></div>";
                    header('Location: '."login.php");
                }
            }

                
            else {
                echo "Erro de consulta ".
                        mysqli_error($conn);
                exit;
            }

            $conn->close();
        } else {
            $_SESSION['msgLogin'] = "<div class='form-floating mb-3'><div class= 'alert alert-danger'>Usuário mal intencionado detectado. A mensagem não foi enviada.</div></div>";
            header('Location: '."login.php");
        }
?>