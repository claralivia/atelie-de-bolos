<?php
    session_start();
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../../node_modules/bootstrap/dist/css/bootstrap.css">
    <title>Delicake Brasil  ::  Fazer Pedido</title>

    <link rel="apple-touch-icon" sizes="180x180" href="../../img/favicon/apple-touch-icon.png">
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

  <?php

    include '../../../conn.php';
    
    session_start();

    mysqli_set_charset($conn,"utf8");

    if(isset($_GET['fotoBolo'])){
        $_SESSION['fotoBolo'] = $_GET['fotoBolo'];

        $fotoBolo = $_GET['fotoBolo'];
                
        $sql = 'SELECT * FROM bolos WHERE foto = "'.$fotoBolo.'"';

        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)){
            $titulo = $row['titulo'];
            $descricao = $row['descricao'];
            $valor = $row['valor'];
            $fatias = $row['fatias'];

            $arquivo = '../../../img/produtos/' . $fotoBolo;
        }

        mysqli_free_result($result);
    }
  ?>

  <script>
    function verificar(){
        var nome = document.querySelector('#nome').value;
        var email = document.querySelector('#email').value;
        var telefone = document.querySelector('#telefone').value;
        var whatsapp = document.querySelector('#whatsapp').value;

        if (nome === ''){
            alert("Campo NOME em branco.");
            event.preventDefault();
        }
        else if(email === ''){
            alert("Campo EMAIL em branco.");
            event.preventDefault();
        }
        else if(telefone === ''){
            alert("Campo TELEFONE em branco.");
            event.preventDefault();
        }
        else if(whatsapp === ''){
            alert("Campo WHATSAPP em branco.");
            event.preventDefault();
        }
        else if((grecaptcha.getResponse() === "")){
            alert("Recapctha em branco!");
            event.preventDefault();
        }
        else{
            document.getElementById("create").setAttribute("method","post");
            document.getElementById("create").setAttribute("action","script_create.php");
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
                            <a href="../../login.php" class="nav-link text-white">Entrar</a>
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
            <div class="row justify-content-center"> 
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <h1 class="mb-3">Fazer Pedido</h1>
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
                            </div>
                        </div>
                    </div>
                    <hr class="mt-3">
                </div>
            </div>

            <div class="row justify-content-center mb-3">
                <form id="create" onsubmit="verificar()" class="col-sm-10 col-md-8 col-lg-6" enctype="multipart/form-data">
                    <?php
                        if(isset($_SESSION['msgImagem'])){
                            echo $_SESSION['msgImagem'];
                            unset($_SESSION['msgImagem']);
                        }
                    ?>

                    <h5>Dados Pessoais</h5>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" autofocus name="nome" id="nome" placeholder=" ">
                        <label for="txtNome">Nome</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" autofocus name="email" id="email" placeholder=" ">
                        <label for="txtEmail">Email</label>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">+55</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Telefone (somente números)" name="telefone" id="telefone" aria-label="Quantia">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">+55</span>
                        </div>
                        <input type="text" class="form-control" placeholder="WhatsApp (somente números)" name="whatsapp" id="whatsapp" aria-label="Quantia">
                    </div>
                    <hr class="mt-3">

                    <h5>Mensagem</h5>

                    <div class="form-floating mb-3">
                        <textarea class="form-control" autofocus id="gostou" name="gostou" placeholder=" "
                        style="height: 100px;"></textarea>
                        <label for="descricao">O que gostou no bolo?</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control" autofocus id="mudar" name="mudar" placeholder=" "
                        style="height: 100px;"></textarea>
                        <label for="descricao">O que deseja mudar?</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control" autofocus id="tema" name="tema" placeholder=" "
                        style="height: 100px;"></textarea>
                        <label for="descricao">Qual o tema do bolo?</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control" autofocus id="topo" name="topo" placeholder=" "
                        style="height: 100px;"></textarea>
                        <label for="descricao">O que deseja no topo?</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control" autofocus id="observacoes" name="observacoes" placeholder=" "
                        style="height: 100px;"></textarea>
                        <label for="descricao">Observações gerais:</label>
                    </div>

                    <div class="mb-3">
                        <label for="fotoRef" class="form-label">Outra imagem de referência (jpg, jpeg e png de até 2Mb):</label>
                        <input class="form-control" type="file" name="fotoRef" id="fotoRef">
                    </div>

                    <div class="g-recaptcha mb-3" data-sitekey="6LeSEE8gAAAAAHBUJxksEWvPl8XWbdAVy04sHgya"></div>

                    <button class="btn btn-lg btn-danger mb-3" type="submit">
                        Inserir
                    </button>
                    <button class="btn btn-lg btn-warning mb-3" type="button" onclick="window.location.href='../../../index.php'">
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