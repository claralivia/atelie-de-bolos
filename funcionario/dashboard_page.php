<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <title>Delicake Brasil  ::  Dashboard</title>

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
                            <a href="../index.php" class="nav-link text-white">Sair</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <div class="container">
            <?php

                session_start();

                if (isset($_SESSION['email'])){
                    $email = $_SESSION['email'];
                }

                $data = date("d/m/Y");
                $data = explode("/", $data);

                list($dia, $mes, $ano) = $data;

                $data = "Dia $dia/$mes/$ano";


                header('Content-type: text/html; charset=utf-8');
                    
                include '../conn.php';

                mysqli_set_charset($conn,"utf8");

                $sql = "SELECT * FROM funcionario";

                $result = mysqli_query($conn, $sql);

                if (!$result) {
                die("Falha na Execução da Consulta: " . $sql ."<BR>" .
                    mysqli_error($conn));
                }

                while ($row = mysqli_fetch_assoc($result)) {
                        $idFuncionario = $row["idFuncionario"];
                        $nome = $row["nome"];
                        $emailbd = $row["email"];
                        $senha = $row["senha"];

                        if ($email == $emailbd){
                            break;
                        }
                }

            ?>

            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-5">
                        <div class="justify-content-center justify-content-md-start mb-3 mb-md-0">
                            <h1>Olá, <?php echo $nome;?>!</h1>
                        </div>
                    </div>
                    <div class="col-12 col-md-7">
                        <div class="d-flex flex-row-reverse justify-content-center justify-content-md-start">
                            <?php echo $data;?>
                        </div>
                    </div>
                </div>

                <hr class="mt-3">
                
                <h3 class="mb-3">O que você deseja?</h3>

                <!-- CRUD de Bolos - Parte 01 -->
                <button class="btn btn-lg btn-danger" type="button" onclick="window.location.href='crud_bolo/read.php'">
                    Ver catálogo
                </button>

                <button class="btn btn-lg btn-danger" type="button" onclick="window.location.href='crud_pedidos/read.php'">
                    Ver pedidos
                </button>
                
                <button class="btn btn-lg btn-danger" type="button" onclick="window.location.href='insert_user.php'">
                    Inserir usuário
                </button>
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
                    <a href="../privacidade.html" class="text-decoration-none text-dark">Política de Privacidade</a><br>
                    <a href="../termos.html" class="text-decoration-none text-dark">Termos de Uso</a><br>
                    <a href="../quemsomos.html" class="text-decoration-none text-dark">Quem Somos</a><br>
                    <a href="../trocas.html" class="text-decoration-none text-dark">Trocas e Devoluções</a>
                </div>
                <div class="col-12 col-md-4 text-center text-md-right">
                    <a href="../contato.contato.php" class="text-decoration-none text-dark">Contato pelo site</a><br>
                    Email:
                        <a href="mailto:delicakebrasil@gmail.com" class="text-decoration-none text-dark">email@dominio.com</a><br>
                    Telefone:
                        <a href="phone:85985348222" class="text-decoration-none text-dark">(85) 98534-8222</a>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
  </body>
</html>