<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.css">
    <title>Delicake Brasil  ::  Seu Pedido</title>

    <link rel="apple-touch-icon" sizes="180x180" href="../../img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../../img/favicon/site.webmanifest">
    <link rel="mask-icon" href="../../img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="../../img/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="../../img/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </symbol>
    </svg>

  </head>

  <body style="min-width: 372px;">

    <nav class="navbar navbar-expand-lg navbar-dark bg-danger fixed-top border-bottom shadow-sm mb-3">
        <div class="container">
            <a class="navbar-brand" href="../../index.php"><strong>Delicake Brasil</strong></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-expanded="false" aria-controls="menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse justify-content-end" id="menu">
                <ul class="navbar-nav flex-grow-1">
                    <li class="nav-item">
                        <a href="../../index.php" class="nav-link text-white">Principal</a>
                    </li>
                    <li class="nav-item">
                        <a href="../../contato/contato.php" class="nav-link text-white">Contato</a>
                    </li>
                </ul>
                <div class="align-self-end">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="../login.php" class="nav-link text-white">Entrar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

        <div style="height:70px;" class="d-block d-md-none"></div>
        <div style="height:110px;" class="d-none d-md-block d-lg-none"></div>
        <div style="height:80px;" class="d-none d-lg-block"></div>

    <main>
        <div class="container">

        <?php

            header('Content-type: text/html; charset=utf-8');

            session_start();

            if(isset($_SESSION['nome'])){
                $nome = $_SESSION["nome"];
            }
            if(isset($_SESSION['email'])){
                $email = $_SESSION["email"];
            }
            if(isset($_SESSION['telefone'])){
                $telefone = $_SESSION["telefone"];
            }
            if(isset($_SESSION['whatsapp'])){
                $whatsapp = $_SESSION["whatsapp"];
            }
            if(isset($_SESSION['foto'])){
                $foto = $_SESSION["foto"];
            }
            if(isset($_SESSION['fotoBolo'])){
                $fotoBolo = $_SESSION["fotoBolo"];
            }
            if(isset($_SESSION['mensagem'])){
                $mensagem = $_SESSION["mensagem"];
            }

            
            # Imprimindo a Tabela

            if($foto === " - "){
                                    echo'<div class="alert alert-warning d-flex align-items-center" role="alert">'.
                                            '<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>'.
                                            '<div>'.
                                                'Seu pedido foi gravado em nossa base de dados. Em breve entraremos em contato'.
                                            '</div>'.
                                        '</div>'.
                                        '<hr class="mt-3">'.
                                        '<div class="text-center table-responsive mb-3">'.
                                            '<table class="table table-hover table-striped">'.
                                                '<tr>'.
                                                    '<th>Nome</th>'.
                                                    '<th>Email</th>'.
                                                    '<th>Telefone</th>'.
                                                    '<th>Whatsapp</th>'.
                                                    '<th>Mensagem</th>'.
                                                    '<th>Foto Referência</th>'.
                                                    '<th>Bolo Escolhido</th>'.
                                                '</tr>'.
                                                '<tr>'.
                                                    '<td>'.$nome.'</td>'.
                                                    '<td>'.$email.'</td>'.
                                                    '<td>'.$telefone.'</td>'.
                                                    '<td>'.$whatsapp.'</td>'.
                                                    '<td>'.$mensagem.'</td>'.
                                                    '<td>'.$foto.'</td>'.
                                                    '<td><img width="150px" src="../../img/produtos/'.$fotoBolo.'"></td>'.
                                                '</tr>'.
                                            '</table>'.
                                        '</div>';
            }
            else{
                                    echo'<div class="alert alert-warning d-flex align-items-center" role="alert">'.
                                            '<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>'.
                                            '<div>'.
                                                'Seu pedido foi gravado em nossa base de dados. Em breve entraremos em contato'.
                                            '</div>'.
                                        '</div>'.
                                        '<hr class="mt-3">'.
                                        '<div class="text-center table-responsive mb-3">'.
                                            '<table class="table table-hover table-striped">'.
                                                '<tr>'.
                                                    '<th>Nome</th>'.
                                                    '<th>Email</th>'.
                                                    '<th>Telefone</th>'.
                                                    '<th>Whatsapp</th>'.
                                                    '<th>Mensagem</th>'.
                                                    '<th>Foto Referência</th>'.
                                                    '<th>Bolo Escolhido</th>'.
                                                '</tr>'.
                                                '<tr>'.
                                                    '<td>'.$nome.'</td>'.
                                                    '<td>'.$email.'</td>'.
                                                    '<td>'.$telefone.'</td>'.
                                                    '<td>'.$whatsapp.'</td>'.
                                                    '<td>'.$mensagem.'</td>'.
                                                    '<td><img width="150px" src="../../img/referencias/'.$foto.'"></td>'.
                                                    '<td><img width="150px" src="../../img/produtos/'.$fotoBolo.'"></td>'.
                                                '</tr>'.
                                            '</table>'.
                                        '</div>';
            }
        ?>
            <div class="text-center mb-3">
                <button class="btn btn-danger" type="button" onclick="window.location.href='../../index.php'">
                    Voltar
                </button>
            </div>
        </div>

    </main>

    <div style="height:277px;" class="d-block d-md-none"></div>
    <div style="height:153px;" class="d-none d-md-block d-lg-none"></div>
    <div style="height:129px;" class="d-none d-lg-block"></div>

    <footer class="border-top text-muted fixed-bottom bg-light">
        <div class="container">
            <div class="row py-3">
                <div class="col-12 col-md-4 text-center text-md-left">
                    &copy; 2022 - Delicake Brasil<br>
                    Rua Virtual Inexistente, 171, Compulândia/PC <br>
                    CNPJ 99.999.999/0001-99
                </div>
                <div class="col-12 col-md-4 text-center">
                    <a href="../../privacidade.html" class="text-decoration-none text-dark">Política de Privacidade</a><br>
                    <a href="../../termos.html" class="text-decoration-none text-dark">Termos de Uso</a><br>
                    <a href="../../quemsomos.html" class="text-decoration-none text-dark">Quem Somos</a><br>
                    <a href="../../trocas.html" class="text-decoration-none text-dark">Trocas e Devoluções</a>
                </div>
                <div class="col-12 col-md-4 text-center text-md-right">
                    <a href="../../contato/contato.php" class="text-decoration-none text-dark">Contato pelo site</a><br>
                    Email:
                        <a href="mailto:delicakebrasil@gmail.com" class="text-decoration-none text-dark">delicakebrasil@gmail.com</a><br>
                    Telefone:
                        <a href="phone:85985348222" class="text-decoration-none text-dark">(85) 98534-8222</a>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
  </body>
</html>