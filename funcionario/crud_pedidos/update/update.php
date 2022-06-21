<?php
    session_start();

    header('Content-type: text/html; charset=utf-8');
                
    include '../../../conn.php';

    mysqli_set_charset($conn,"utf8");

    if(isset($_GET['idPedido'])){
        $_SESSION['idPedido'] = $_GET['idPedido'];
        $idPedido= $_SESSION['idPedido'];
    }

    $sql = "SELECT * FROM pedidos WHERE idPedido = '$idPedido' LIMIT 1";

    $result = mysqli_query($conn, $sql);

    if($result){
        $row = mysqli_fetch_assoc($result);

        $_SESSION["nome"] = $row['nome'];
        $nome = $_SESSION["nome"];

        $_SESSION["email"] = $row['email'];
        $email = $_SESSION["email"];

        $_SESSION["numero"] = $row['telefone'];
        $numero = $_SESSION["numero"];

        $_SESSION["whatsapp"] = $row['whatsapp'];
        $whatsapp = $_SESSION["whatsapp"];

        $_SESSION["gostou"] = $row['gostou'];
        $gostou = $_SESSION["gostou"];

        $_SESSION["mudar"] = $row['mudar'];
        $mudar = $_SESSION["mudar"];

        $_SESSION["tema"] = $row['tema'];
        $tema = $_SESSION["tema"];

        $_SESSION["topo"] = $row['topo'];
        $topo = $_SESSION["topo"];

        $_SESSION["observacoes"] = $row['observacoes'];
        $observacoes = $_SESSION["observacoes"];

        $_SESSION["fotoRef"] = $row['fotoRef'];
        $fotoRef = $_SESSION["fotoRef"];

        $_SESSION["status"] = $row['status'];
        $status = $_SESSION["status"];

        $_SESSION["idBolo"] = $row['FK_bolos'];
        $idBolo = $_SESSION["idBolo"];

        $mensagem = '<div class="text-start">'.
                        '<strong>Gostou: </strong>' . $gostou . '<br>' .
                        '<strong>Quer mudar: </strong>' . $mudar . '<br>' .
                        '<strong>Tema: </strong>' . $tema . '<br>' .
                        '<strong>Topo: </strong>' . $topo . '<br>' .
                        '<strong>Observações: </strong>' . $observacoes .
                    '</div>' ;
        $informacoes = '<div class="text-start">'.
                        '<strong>Nome: </strong>' . $nome . '<br>' .
                        '<strong>Email: </strong>' . $email . '<br>' .
                        '<strong>Telefone: </strong>' . $numero . '<br>' .
                        '<strong>WhatsApp: </strong>' . $whatsapp .
                    '</div>' ;

        if($fotoRef === " - "){
            $arquivoRef = "../../assets/sem-referencia.png";
        }
        else{
            $arquivoRef = "../../../img/referencias/" . $fotoRef;
        }
    }

    else {
        echo "Erro de consulta ".
                mysqli_error($conn);
        exit;
    }

    $sql2 = "SELECT * FROM bolos WHERE idBolo = '$idBolo' LIMIT 1";

    $result2 = mysqli_query($conn, $sql2);

    if($result2){
        if($row = mysqli_fetch_assoc($result2)){
            $foto = $row["foto"];
            $titulo = $row["titulo"];
            $descricao = $row["descricao"];
            $valor = $row["valor"];
            $fatias = $row["fatias"];
            $categoria = $row["categoria"];

            $arquivo = "../../../img/produtos/" . $foto;
        }
        else{
            $arquivo = "../../assets/indisponivel.png";
            $titulo = "Bolo excluído do catálogo";
            $descricao = "Pedido deve ser refeito para um bolo que está no catálogo";
            $valor = " - ";
            $fatias = " - ";
        }
    }

    $conn->close();
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../../node_modules/bootstrap/dist/css/bootstrap.css">
    <title>Delicake Brasil  ::  Resposta</title>

    <link rel="apple-touch-icon" sizes="180x180" href="../../../img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../../img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../../img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../../../img/favicon/site.webmanifest">
    <link rel="mask-icon" href="../../../img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="../../../img/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="../../../img/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

  </head>

  <script src='https://www.google.com/recaptcha/api.js'></script>

  <script>
    function verificar(){
        if(grecaptcha.getResponse() === ""){
            alert("Recapctha em branco!");
            event.preventDefault();
        }
        else{
            document.getElementById("update").setAttribute("method","post");
            document.getElementById("update").setAttribute("action","script_update.php");
        }
    }

  </script>

  <body style="min-width: 372px;">

    <nav class="navbar navbar-expand-lg navbar-dark bg-danger border-bottom shadow-sm mb-3">
        <div class="container">
            <a class="navbar-brand" href="../../../index.php"><strong>Delicake Brasil</strong></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-expanded="false" aria-controls="menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse justify-content-end" id="menu">
                <ul class="navbar-nav flex-grow-1">
                    <li class="nav-item">
                        <a href="../../../index.php" class="nav-link text-white">Principal</a>
                    </li>
                    <li class="nav-item">
                        <a href="../../../contato.html" class="nav-link text-white">Contato</a>
                    </li>
                </ul>
                <div class="align-self-end">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="../../../index.php" class="nav-link text-warning">Sair</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>


    <main>
        <div class="container">
            <div class="row justify-content-center">
                <form onsubmit="verificar()" class="col-sm-10 col-md-8 col-lg-6" enctype="multipart/form-data" id="update">
                    <h1 class="mb-3">Pedido de <?php echo $nome;?></h1>
                    <hr class="mt-3">
                    <h4 class="mb-3">Resumo da Escolha</h4>
                    <hr class="mt-3">
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img <?echo 'src="'.$arquivo.'"';?> class="img-fluid rounded-start">
                            </div>
                            <div class="col-md-8">
                                <div class="card-header">R$ <?echo $valor;?>,00</div>
                                <div class="card-body">
                                    <h5 class="card-title"><?echo $titulo;?></h5>
                                    <p class="card-text"><?echo $descricao;?></p>
                                    <p class="card-text"><small class="text-warning"><?echo $fatias;?> fatias</small></p>
                                </div>
                                <div class="card-footer text-muted">Bolo escolhido do catálogo</div>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-3">
                    <h4 class="mb-3">Mensagem</h4>
                    <hr class="mt-3">
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img <?echo 'src="'.$arquivoRef.'"';?> class="img-fluid rounded-start">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <p class="card-text"><?echo $informacoes;?></p>
                                    <p class="card-text"><?echo $mensagem;?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-3">
                    <h4 class="mb-3">Resposta</h4>
                    <hr class="mt-3">
                    
                    <select class="form-select" name="resposta">
                        <option value="email">Respondida no email</option>
                        <option value="whatsapp">Respondida no whatsapp</option>
                        <option value="email_whatsapp">Respondida no email e whatsapp</option>
                    </select>

                    <input type="hidden" id="idPedido" name="idPedido" value=<?php echo '"'.$idPedido.'"';?>>

                    <hr class="mt-3">

                    <div class="g-recaptcha mb-3" data-sitekey="6LfKeoUgAAAAAH0M2JJ3lzsspqWxzcgZ6HDrBXv3"></div>

                    <button class="btn btn-lg btn-danger mb-3" type="submit">
                        Atualizar
                    </button>
                    <button class="btn btn-lg btn-warning mb-3" type="button" onclick="window.location.href='../read.php'">
                        Voltar
                    </button>
                    
                </form>
            </div>
        </div>

    </main>

    <div style="height:277px;" class="d-block d-md-none"></div>
    <div style="height:153px;" class="d-none d-md-block d-lg-none"></div>
    <div style="height:129px;" class="d-none d-lg-block"></div>

    <footer class="border-top fixed-bottom text-muted bg-light">
        <div class="container">
            <div class="row py-3">
                <div class="col-12 col-md-4 text-center text-md-left">
                    &copy; 2022 - Ateliê de Bolos<br>
                    Rua Virtual Inexistente, 171, Compulândia/PC <br>
                    CNPJ 99.999.999/0001-99
                </div>
                <div class="col-12 col-md-4 text-center">
                    <a href="../../../privacidade.html" class="text-decoration-none text-dark">Política de Privacidade</a><br>
                    <a href="../../../termos.html" class="text-decoration-none text-dark">Termos de Uso</a><br>
                    <a href="../../../quemsomos.html" class="text-decoration-none text-dark">Quem Somos</a><br>
                    <a href="../../../trocas.html" class="text-decoration-none text-dark">Trocas e Devoluções</a>
                </div>
                <div class="col-12 col-md-4 text-center text-md-right">
                    <a href="../../../contato.html" class="text-decoration-none text-dark">Contato pelo site</a><br>
                    Email:
                        <a href="mailto:email@dominio.com" class="text-decoration-none text-dark">email@dominio.com</a><br>
                    Telefone:
                        <a href="phone:28999990000" class="text-decoration-none text-dark">(28) 99999-0000</a>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
  </body>
</html>