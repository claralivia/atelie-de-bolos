<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../../node_modules/bootstrap/dist/css/bootstrap.css">
        <title>Ateliê de Bolos  ::  Atualização</title>

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

    <body style="min-width: 372px;">

        <nav class="navbar navbar-expand-lg navbar-dark bg-danger border-bottom shadow-sm mb-3">
            <div class="container">
                <a class="navbar-brand" href="../../../index.php"><strong>Ateliê de Bolos</strong></a>
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
                                <a href="#" class="nav-link text-white">Quero me cadastrar</a>
                            </li>
                            <li class="nav-item">
                                <a href="../../login.php" class="nav-link text-white">Entrar</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

<?php
    session_start();
    
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
                    '<form method="post" action="update_image.php" class="col-sm-10 col-md-8 col-lg-6" enctype="multipart/form-data" id="update">'.
                        '<h1 class="mb-3">Atualizar Foto:</h1>'.
                        '<hr class = "mt-3">'.
                        $_SESSION["msg"].
                        '<label for="foto" class="form-label">Envie uma foto do bolo:</label>'.     
                        '<div class="text-center mb-3">'.
                            '<input class="form-control" type="file" name="foto" id="foto">'.
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
}