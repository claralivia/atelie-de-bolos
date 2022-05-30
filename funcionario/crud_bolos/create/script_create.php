<?php

            include "resize-class.php";

            header('Content-type: text/html; charset=utf-8');
                
            include '../../../conn.php';

            session_start();

            $caminho = "../../../img/produtos/"; 

            $target_file = $caminho . basename($_FILES["foto"]["name"]);

            $imagem = basename($_FILES["foto"]["name"]);

            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            if(isset($_POST['titulo'])){
                $_SESSION['titulo'] = $_POST['titulo'];
                $titulo = $_SESSION['titulo'];
            }

            if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["foto"]["tmp_name"]);
            if($check !== false) {
                echo "Arquivo é uma imagem - " . $check["mime"] . ".";
            } else {
                echo "Arquivo não é uma imagem.";
            }
            }

            if (file_exists($target_file)) {
                $_SESSION["msg"] = "<div class='form-floating mb-3'><div class= 'alert alert-danger'>Infelizmente o arquivo já existe.</div></div>";
                header('Location: '."create.php");
            }

            else if ($_FILES["foto"]["size"] > 2000000) {
                $_SESSION["msg"] = "<div class='form-floating mb-3'><div class= 'alert alert-danger'>Infelizmente o arquivo ultrapassa 2Mb.</div></div>";
                header('Location: '."create.php");
            }

            else if($imageFileType != "png" && $imageFileType != "jpg" && $imageFileType != "jpeg") {
                $_SESSION["msg"] = "<div class='form-floating mb-3'><div class= 'alert alert-danger'>Infelizmente, apenas PNG, JPG e JPEG são possíveis.</div></div>";
                header('Location: '."create.php");
            }

            else if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
            
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
            }

            if(isset($_POST['valor'])){
                $valor = $_POST['valor'];
            }
            if(isset($_POST['fatias'])){
                $fatias = $_POST['fatias'];
            }
            if(isset($_POST['descricao'])){
                $descricao = $_POST['descricao'];
                $decricao = nl2br($descricao);
            }
            if(isset($_POST['categoria'])){
                $categoria = $_POST['categoria'];
            }

            $data = date("d/m/Y");
            $data = explode("/", $data);
            list($dia, $mes, $ano) = $data;
            $data = "$dia/$mes/$ano";
            
            $sql = "INSERT INTO bolos (foto, titulo, descricao, valor, fatias, data, categoria) VALUES (?,?,?,?,?,?,?)";

            $stmt = mysqli_stmt_init($conn);
            $stmt_prepared_okay = mysqli_stmt_prepare($stmt,$sql);

            if($stmt_prepared_okay){
                mysqli_stmt_bind_param($stmt, "sssssss", $foto, $titulo, $descricao, $valor, $fatias, $data, $categoria);


                $stmt_executed_okay = mysqli_stmt_execute($stmt);     

                if ($stmt_executed_okay) {
                    header('Location: '."../read.php");  
                } else {
                    echo "Não foi possível executar a inserção de ".
                        "$foto, $titulo, $descricao, $valor, $fatias, $data, $categoria no banco de dados". 
                        mysqli_error($conn);
                    exit;
                }
                    mysqli_stmt_close($stmt);
            }

            $conn->close();
?>