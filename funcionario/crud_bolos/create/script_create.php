<?php

            include "resize-class.php";

            header('Content-type: text/html; charset=utf-8');
                
            include '../../../conn.php';

            mysqli_set_charset($conn,"utf8");

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
                    $imagem = basename($_FILES["foto"]["name"]);
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
                mysqli_stmt_bind_param($stmt, "sssssss", $imagem, $titulo, $descricao, $valor, $fatias, $data, $categoria);

                $stmt_executed_okay = mysqli_stmt_execute($stmt);     

                if ($stmt_executed_okay) {

                    $sql2 = "SELECT * FROM bolos WHERE foto = '".$imagem."'";

                    $result = mysqli_query($conn, $sql2);

                    while($row = mysqli_fetch_assoc($result)){
                        $imagembd = $row["foto"];
                        
                        if ($imagembd = $imagem){
                            $idBolo = $row["idBolo"];
                        }
                    }

                    mysqli_free_result($result);

                    $target_file2 = "../../../img/produtos/" . $imagembd;

                    $imageFileType2 = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));

                    $resize_tamanho = new resize($target_file2);
                        
                    $resize_tamanho->resizeImage(300, 400, 'crop');

                    if($imageFileType2 == "png"){
                        $foto = "catalogo-" . $titulo . "-id" . $idBolo . ".png";
                    }
                    else if($imageFileType2 == "jpg"){
                        $foto = "catalogo-" . $titulo . "-id" . $idBolo . ".jpg";
                    }
                    else if($imageFileType2 == "jpeg"){
                        $foto = "catalogo-" . $titulo . "-id" . $idBolo . ".jpeg";
                    }


                    $foto = str_replace(' ', '-', $foto);
                    $foto = mb_strtolower ($foto,"utf-8");
                        
                    $resize_tamanho->saveImage($caminho . $foto, 100);
                        
                    unlink($target_file2);

                    $sqlUpdate = "UPDATE bolos SET foto=? WHERE idBolo =?";

                    $stmt_prepared_okay2 = mysqli_stmt_prepare($stmt,$sqlUpdate);

                    if ($stmt_prepared_okay2) {

                        mysqli_stmt_bind_param($stmt, "si",$foto, $idBolo);

                        $stmt_executed_okay2 = mysqli_stmt_execute($stmt);

                        header('Location: '."../read.php");
                    }
  
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