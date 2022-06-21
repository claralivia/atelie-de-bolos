<?php

            include "resize-class.php";

            header('Content-type: text/html; charset=utf-8');
                
            include '../../../conn.php';

            mysqli_set_charset($conn,"utf8");

            session_start();

            if(isset($_POST['nome'])){
                $_SESSION["nome"] = $_POST['nome'];
                $nome = $_SESSION["nome"];
            }

            if(isset($_POST['email'])){
                $_SESSION["email"] = $_POST['email'];
                $email = $_SESSION["email"];
            }

            if(isset($_POST['telefone'])){
                $_SESSION["telefone"] = $_POST['telefone'];
                $telefone = $_SESSION["telefone"];
            }

            if(isset($_POST['whatsapp'])){
                $_SESSION["whatsapp"] = $_POST['whatsapp'];
                $whatsapp = $_SESSION["whatsapp"];
            }

            if(isset($_POST['gostou'])){
                $_SESSION["gostou"] = $_POST['gostou'];
                $gostou = $_SESSION["gostou"];
                $gostou = nl2br($gostou);
            }

            if(isset($_POST['mudar'])){
                $_SESSION["mudar"] = $_POST['mudar'];
                $mudar = $_SESSION["mudar"];
                $mudar = nl2br($mudar);
            }

            if(isset($_POST['tema'])){
                $_SESSION["tema"] = $_POST['tema'];
                $tema = $_SESSION["tema"];
                $tema = nl2br($tema);
            }

            if(isset($_POST['topo'])){
                $_SESSION["topo"] = $_POST['topo'];
                $topo = $_SESSION["topo"];
                $topo = nl2br($topo);
            }

            if(isset($_POST['observacoes'])){
                $_SESSION["observacoes"] = $_POST['observacoes'];
                $observacoes = $_SESSION["observacoes"];
                $observacoes = nl2br($observacoes);
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

                $mensagem = '<div class="text-start">'.
                                '<strong>Gostou: </strong>' . $gostou . '<br>' .
                                '<strong>Quer mudar: </strong>' . $mudar . '<br>' .
                                '<strong>Tema: </strong>' . $tema . '<br>' .
                                '<strong>Topo: </strong>' . $topo . '<br>' .
                                '<strong>Observações: </strong>' . $observacoes .
                            '</div>' ;

                $_SESSION["mensagem"] = $mensagem;

                if(basename($_FILES["fotoRef"]["name"])){
                    $caminho = "../../../img/referencias/"; 

                    $target_file = $caminho . basename($_FILES["fotoRef"]["name"]);

                    $imagem = basename($_FILES["fotoRef"]["name"]);

                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


                    if (file_exists($target_file)) {
                        $_SESSION["msgImagem"] = "<div class='form-floating mb-3'><div class= 'alert alert-danger'>Infelizmente o arquivo já existe.</div></div>";
                        header('Location: '."create.php");
                    }

                    else if ($_FILES["fotoRef"]["size"] > 2000000) {
                        $_SESSION["msgImagem"] = "<div class='form-floating mb-3'><div class= 'alert alert-danger'>Infelizmente o arquivo ultrapassa 2Mb.</div></div>";
                        header('Location: '."create.php");
                    }

                    else if($imageFileType != "png" && $imageFileType != "jpg" && $imageFileType != "jpeg") {
                        $_SESSION["msgImagem"] = "<div class='form-floating mb-3'><div class= 'alert alert-danger'>Infelizmente, apenas PNG, JPG e JPEG são possíveis.</div></div>";
                        header('Location: '."create.php");
                    }

                    else if (move_uploaded_file($_FILES['fotoRef']['tmp_name'], $target_file)) {
                        $imagem = basename($_FILES["fotoRef"]["name"]);
                    }
                }
                else{
                    $imagem = ' - ';
                }

                if(isset($_SESSION['fotoBolo'])){
                    $fotoBolo = $_SESSION['fotoBolo'];
                    
                    $sqlID = 'SELECT * FROM bolos WHERE foto = "'.$fotoBolo.'"';

                    $resultID = mysqli_query($conn, $sqlID);

                    while($rowID = mysqli_fetch_assoc($resultID)){
                        $idBolo = $rowID["idBolo"];
                    }

                    mysqli_free_result($resultID);
                }

                $data = date("d/m/Y");
                $data = explode("/", $data);
                list($dia, $mes, $ano) = $data;
                $data = "$dia/$mes/$ano";

                $dataReposta = "-";

                $status = "Não respondida";
                
                $sql = "INSERT INTO pedidos (nome, email, telefone, whatsapp, gostou, mudar, tema, topo, observacoes, data, dataResposta, fotoRef, status, FK_bolos) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

                $stmt = mysqli_stmt_init($conn);
                $stmt_prepared_okay = mysqli_stmt_prepare($stmt,$sql);

                if($stmt_prepared_okay){
                    mysqli_stmt_bind_param($stmt, "sssssssssssssi", $nome, $email, $telefone, $whatsapp, $gostou, $mudar, $tema, $topo, $observacoes, $data, $dataReposta, $imagem, $status, $idBolo);

                    $stmt_executed_okay = mysqli_stmt_execute($stmt);     

                    if ($stmt_executed_okay) {

                        if($imagem !== " - "){
                            $sql2 = "SELECT * FROM pedidos WHERE fotoRef = '".$imagem."'";

                            $result = mysqli_query($conn, $sql2);

                            while($row = mysqli_fetch_assoc($result)){
                                $imagembd = $row["fotoRef"];
                                
                                if ($imagembd = $imagem){
                                    $idPedido = $row["idPedido"];
                                }
                            }

                            mysqli_free_result($result);

                            $target_file2 = "../../../img/referencias/" . $imagembd;

                            $imageFileType2 = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));

                            $resize_tamanho = new resize($target_file2);
                                
                            $resize_tamanho->resizeImage(300, 400, 'crop');

                            if($imageFileType2 == "png"){
                                $foto = "referencia-pedido-" . $idPedido . ".png";
                            }
                            else if($imageFileType2 == "jpg"){
                                $foto = "referencia-pedido" . $idPedido . ".jpg";
                            }
                            else if($imageFileType2 == "jpeg"){
                                $foto = "referencia-pedido" . $idPedido . ".jpeg";
                            }


                            $foto = str_replace(' ', '-', $foto);
                            $foto = mb_strtolower ($foto,"utf-8");

                            if(isset($foto)) {
                                $_SESSION["foto"] = $foto;
                            }
                                
                            $resize_tamanho->saveImage($caminho . $foto, 100);
                                
                            unlink($target_file2);

                            $sqlUpdate = "UPDATE pedidos SET fotoRef=? WHERE idPedido =".$idPedido;

                            $stmt_prepared_okay2 = mysqli_stmt_prepare($stmt,$sqlUpdate);

                            if ($stmt_prepared_okay2) {

                                mysqli_stmt_bind_param($stmt, "s", $foto);

                                $stmt_executed_okay2 = mysqli_stmt_execute($stmt);

                                if ($stmt_executed_okay2){
                                    header('Location: '."../read_cliente.php");

                                }
                            }
                            else{
                                echo "Não foi possível executar a inserção de ".
                                    "$nome, $email, $telefone, $whatsapp, $gostou, $mudar, $tema, $topo, $observacoes, $data, $foto, $idBolo no banco de dados". 
                                    mysqli_error($conn);
                            }
                            mysqli_stmt_close($stmt);
                        }

                        else{
                            $_SESSION["foto"] = $imagem;
                            header('Location: '."../read_cliente.php");
                        }   
    
                    } else {
                        echo "Não foi possível executar a inserção de ".
                            "$nome, $email, $telefone, $whatsapp, $gostou, $mudar, $tema, $topo, $observacoes, $data, $dataResposta, $imagem, $status, $idBolo no banco de dados". 
                            mysqli_error($conn);
                        exit;
                    }
                        mysqli_stmt_close($stmt);
                }

                $conn->close();
            }
?>