<?php
    session_start();

    include "resize-class.php";

    if(isset($_SESSION["idBolo"])){
        $idBolo = $_SESSION["idBolo"];
    }

    if(isset($_SESSION["titulo"])){
        $titulo = $_SESSION["titulo"];
    }

    if(isset($_SESSION["valor"])){
        $valor = $_SESSION["valor"];
    }

    if(isset($_SESSION["fatias"])){
        $fatias = $_SESSION["fatias"];
    }

    if(isset($_SESSION["descricao"])){
        $descricao = $_SESSION["descricao"];
    }

    if(isset($_SESSION["categoria"])){
        $categoria = $_SESSION["categoria"];
    }
    
    if(isset($_SESSION["fotoAnt"])){
        $imagem_anterior = $_SESSION["fotoAnt"];
    }

    $caminho = "../../../img/produtos/";

    $target_file = $caminho . basename($_FILES["foto"]["name"]);

    $imagem = basename($_FILES["foto"]["name"]);

    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    unlink($caminho . $imagem_anterior);

    if (file_exists($target_file)) {
        $_SESSION["msg"] = "<div class='form-floating mb-3'><div class= 'alert alert-danger'>Infelizmente o arquivo já existe.</div></div>";
        header('Location: '."script_update_image.php");
    }

    else if ($_FILES["foto"]["size"] > 2000000) {
        $_SESSION["msg"] = "<div class='form-floating mb-3'><div class= 'alert alert-danger'>Infelizmente o arquivo ultrapassa 2Mb.</div></div>";
        header('Location: '."script_update_image.php");
    }

    else if($imageFileType != "png" && $imageFileType != "jpg" && $imageFileType != "jpeg") {
        $_SESSION["msg"] = "<div class='form-floating mb-3'><div class= 'alert alert-danger'>Infelizmente, apenas PNG, JPG e JPEG são possíveis.</div></div>";
        header('Location: '."script_update_image.php");
    }

    else if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {

        header('Content-type: text/html; charset=utf-8');

        include '../../../conn.php';

        $resize_tamanho = new resize($target_file);
            
        $resize_tamanho->resizeImage(300, 400, 'crop');

        if($imageFileType == "png"){
            $foto = "catalogo-" . $titulo . ".png";
        }
        else if($imageFileType == "jpg"){
            $foto = "catalogo-" . $titulo . ".jpg";
        }
        else if($imageFileType == "jpeg"){
            $foto = "catalogo-" . $titulo . ".jpeg";
        }

        $foto = str_replace(' ', '-', $foto);
        $foto = mb_strtolower ($foto,"utf-8");
            
        $resize_tamanho->saveImage($caminho . $foto, 100);
            
        unlink($caminho . $imagem);

        $sql = "UPDATE bolos SET foto=?, titulo=?, descricao=?, valor=?, fatias=?, categoria=? WHERE idBolo =?";

        $stmt = mysqli_stmt_init($conn);
        $stmt_prepared_okay = mysqli_stmt_prepare($stmt,$sql);

        if ($stmt_prepared_okay) {

            mysqli_stmt_bind_param($stmt, "ssssssi", $foto, $titulo, $descricao, $valor, $fatias, $categoria, $idBolo);

            $stmt_executed_okay = mysqli_stmt_execute($stmt);

            if ($stmt_executed_okay) {
                header('Location: '."../read.php");
            } else {
                echo "Não foi possível executar a atualização de ".
                    "$idBolo $foto $titulo $descricao $valor $fatias $categoria no banco de dados" . 
                    mysqli_error($conn);
                exit;
            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($conn);
    }

?>