<?php

    header('Content-type: text/html; charset=utf-8');

    include '../../../conn.php';

    mysqli_set_charset($conn,"utf8");

    if(isset($_POST['idPedido'])){
        $idPedido= $_POST['idPedido'];
    }

    if(isset($_POST["resposta"])){
        $resposta = ($_POST["resposta"]);
    }
    if($resposta === "email"){
        $tipoResposta = "Respondida no email";
    }
    else if($resposta === "whatsapp"){
        $tipoResposta = "Respondida no whatsapp";
    }
    else if($resposta === "email_whatsapp"){
        $tipoResposta = "Respondida no email e whatsapp";
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

        $dataResposta = date("d/m/Y");
        $dataResposta = explode("/", $dataResposta);
        list($dia, $mes, $ano) = $dataResposta;
        $dataResposta = "$dia/$mes/$ano";

        $sql = "UPDATE pedidos SET dataResposta=?, status=? WHERE idPedido =?";

        $stmt = mysqli_stmt_init($conn);
        $stmt_prepared_okay = mysqli_stmt_prepare($stmt,$sql);

        if ($stmt_prepared_okay) {

            mysqli_stmt_bind_param($stmt, "ssi", $dataResposta, $tipoResposta, $idPedido);

            $stmt_executed_okay = mysqli_stmt_execute($stmt);

            if ($stmt_executed_okay) {
                header('Location: '."../read.php");
            } else {
                echo "Não foi possível executar a atualização de ".
                    "$idPedido $status $dataResposta no banco de dados" . 
                    mysqli_error($conn);
                exit;
            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($conn);
    }

?>