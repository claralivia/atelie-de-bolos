<?php
    session_start();
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <title>Delicake Brasil  ::  Inserir Usuário</title>

    <link rel="apple-touch-icon" sizes="180x180" href="../img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../img/favicon/site.webmanifest">
    <link rel="mask-icon" href="../img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="../img/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="../img/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

  </head>

  <script src='https://www.google.com/recaptcha/api.js'></script>

    <script>
    function verificar(){
        var nome = document.querySelector('#nome').value;
        var email = document.querySelector('#email').value;
        var senha = document.querySelector('#senha').value;

        if (nome === ''){
            alert("Campo NOME em branco.");
            event.preventDefault();
        }
        else if(email === ''){
            alert("Campo EMAIL em branco.");
            event.preventDefault();
        }
        else if(senha === ''){
            alert("Campo SENHA em branco.");
            event.preventDefault();
        }
        else if(grecaptcha.getResponse() === ""){
            alert("Recapctha em branco!");
            event.preventDefault();
        }
        else{
            document.getElementById("create").setAttribute("method","post");
            document.getElementById("create").setAttribute("action","script_insert.php");
        }
    }

  </script>

  <body style="min-width: 372px;">

    <nav class="navbar navbar-expand-lg navbar-dark bg-danger border-bottom shadow-sm mb-3">
        <div class="container">
            <a class="navbar-brand" href="../index.php"><strong>Delicake Brasil</strong></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-expanded="false" aria-controls="menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse justify-content-end" id="menu">
                <ul class="navbar-nav flex-grow-1">
                    <li class="nav-item">
                        <a href="../index.php" class="nav-link text-white">Principal</a>
                    </li>
                    <li class="nav-item">
                        <a href="../contato/contato.php" class="nav-link text-white">Contato</a>
                    </li>
                </ul>
                <div class="align-self-end">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="../index.php" class="nav-link text-warning">Sair</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>


    <main>
        <div class="container">
            <div class="row justify-content-center">
                <form id="create" onsubmit="verificar()" class="col-sm-10 col-md-8 col-lg-6" enctype="multipart/form-data">
                    <h1 class="mb-3">Inserir usuário</h1>
                    <hr class="mt-3">
                    <?php
                        if(isset($_SESSION['msg'])){
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                    ?>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" autofocus name="nome" id="nome" placeholder=" ">
                        <label for="nome">Nome</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" autofocus name="email" id="email" placeholder=" ">
                        <label for="email">Email</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" autofocus name="senha" id="senha" placeholder=" ">
                        <label for="senha">Senha</label>
                    </div>

                    <div class="g-recaptcha mb-3" data-sitekey="6LfKeoUgAAAAAH0M2JJ3lzsspqWxzcgZ6HDrBXv3"></div>

                    <button class="btn btn-lg btn-danger mb-3" type="submit">
                        Inserir
                    </button>
                    <button class="btn btn-lg btn-warning mb-3" type="button" onclick="window.location.href='dashboard_page.php'">
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
                    <a href="../contato/contato.php" class="text-decoration-none text-dark">Contato pelo site</a><br>
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