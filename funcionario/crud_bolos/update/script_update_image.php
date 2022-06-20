<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../../node_modules/bootstrap/dist/css/bootstrap.css">
        <title>Delicake Brasil  ::  Atualização</title>

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
            var foto = document.querySelector('#foto').value;

            if(foto === ''){
                alert("Insira uma FOTO.");
                event.preventDefault();
            }
            else if(grecaptcha.getResponse() === ""){
                alert("Recapctha em branco!");
                event.preventDefault();
            }
            else{
                document.getElementById("update").setAttribute("method","post");
                document.getElementById("update").setAttribute("action","update_image.php");
            }
        }
 
    </script>

    <body style="min-width: 372px;">

        <nav class="navbar navbar-expand-lg navbar-dark bg-danger fixed-top border-bottom shadow-sm mb-3">
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
                            <a href="../../../contato/contato.php" class="nav-link text-white">Contato</a>
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

        <div style="height:70px;" class="d-block d-md-none"></div>
        <div style="height:110px;" class="d-none d-md-block d-lg-none"></div>
        <div style="height:80px;" class="d-none d-lg-block"></div>

<?php
    session_start();

    mysqli_set_charset($conn,"utf8");
    
    if(isset($_GET["idBolo"])){
        $_SESSION["idBolo"] = $_GET["idBolo"];
    }

    if(isset($_GET["titulo"])){
        $_SESSION["titulo"] = $_GET['titulo'];
    }

    if(isset($_GET['valor'])){
        $_SESSION["valor"] = $_GET['valor'];
    }

    if(isset($_GET['fatias'])){
        $_SESSION["fatias"] = $_GET['fatias'];
    }

    if(isset($_GET['descricao'])){
        $_SESSION["descricao"] = $_GET["descricao"];
    }

    if(isset($_GET['categoria'])){
        $_SESSION["categoria"] = $_GET["categoria"];
    }
    if(isset($_GET['fotoAnt'])){
        $_SESSION["fotoAnt"] = $_GET["fotoAnt"]; 
    }    

    echo'<main>'.
            '<div class="container">'.
                '<div class="row justify-content-center">'.
                    '<form class="col-sm-10 col-md-8 col-lg-6" enctype="multipart/form-data" id="update">'.
                        '<h1 class="mb-3">Atualizar Foto:</h1>'.
                        '<hr class = "mt-3">';
                            if(isset($_SESSION['msg'])){
                                echo $_SESSION['msg'];
                                unset($_SESSION['msg']);
                            }
                    echo    '<label for="foto" class="form-label">Envie uma foto do bolo:</label>'.     
                        '<div class="text-center mb-3">'.
                            '<input class="form-control" type="file" name="foto" id="foto">'.
                        '</div>'.

                        '<div class="text-center mb-3">'.
                            '<div class="g-recaptcha" data-sitekey="6LeSEE8gAAAAAHBUJxksEWvPl8XWbdAVy04sHgya"></div>'.
                        '</div>'.

                        '<div class="text-center mb-3">'.
                            '<button class="btn btn-lg btn-danger mb-3" type="submit">'.
                                'Atualizar'.
                            '</button>'.
                        '</div>'.
                    '</form>'.
                '</div>'.
            '</div>'.
        '</main>';


?>


            <div style="height:277px;" class="d-block d-md-none"></div>
            <div style="height:153px;" class="d-none d-md-block d-lg-none"></div>
            <div style="height:129px;" class="d-none d-lg-block"></div>

            <footer class="border-top fixed-bottom text-muted bg-light">
                <div class="container">
                    <div class="row py-3">
                        <div class="col-12 col-md-4 text-center text-md-left">
                            &copy; 2022 - Delicake Brasil<br>
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
                            <a href="../../../contato/contato.php" class="text-decoration-none text-dark">Contato pelo site</a><br>
                            Email:
                                <a href="mailto:delicakebrasil@gmail.com" class="text-decoration-none text-dark">delicakebrasil@gmail.com</a><br>
                            Telefone:
                                <a href="phone:85985348222" class="text-decoration-none text-dark">(85) 98534-8222</a>
                        </div>
                    </div>
                </div>
            </footer>
            
            <script src="../../../node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
        </body>
        </html>