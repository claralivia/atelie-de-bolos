<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <title>Ateliê de Bolos  ::  Principal</title>

    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
    <link rel="manifest" href="img/favicon/site.webmanifest">
    <link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="img/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="img/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">


    <style>
        p.truncate-3l{
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
  </head>

  <body style="min-width: 372px;">

    <nav class="navbar navbar-expand-lg navbar-dark bg-danger border-bottom shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand" href="index.php"><strong>Ateliê de Bolos</strong></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-expanded="false" aria-controls="menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse justify-content-end" id="menu">
                <ul class="navbar-nav flex-grow-1">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link text-white">Principal</a>
                    </li>
                    <li class="nav-item">
                        <a href="contato.html" class="nav-link text-white">Contato</a>
                    </li>
                </ul>
                <div class="align-self-end">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="#" class="nav-link text-white">Quero me cadastrar</a>
                        </li>
                        <li class="nav-item">
                            <a href="funcionario/login.php" class="nav-link text-white">Entrar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <header class="container">
        <div id="carouselMain" class="carousel carousel-dark slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselMain" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselMain" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselMain" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active text-center" data-bs-interval="3000">
                    <img src="img/slides/slide01.jpg" alt="" class="img-fluid d-none d-md-block">
                    <img src="img/slides/slide01small.jpg" alt="" class="img-fluid d-block d-md-none">
                </div>
                <div class="carousel-item text-center" data-bs-interval="3000">
                    <img src="img/slides/slide01.jpg" alt="" class="img-fluid d-none d-md-block">
                    <img src="img/slides/slide01small.jpg" alt="" class="img-fluid d-block d-md-none">
                </div>
                <div class="carousel-item text-center" data-bs-interval="3000">
                    <img src="img/slides/slide01.jpg" alt="" class="img-fluid d-none d-md-block">
                    <img src="img/slides/slide01small.jpg" alt="" class="img-fluid d-block d-md-none">
                </div>
            </div>

            <a class="carousel-control-prev" href="#carouselMain" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselMain" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Próximo</span>
            </a>
        </div>
        <hr class="mt-3"/>
    </header>

    <main>
        <div class="container">
            <form method="get">
                <div class="row">
                    <div class="col-12">
                        <div class="justify-content-center mb-3 mb-md-0">
                            <div class="input-group input-group-sm">
                                <input type="text" name="busca" class="form-control" placeholder="Digite aqui o que procura">
                                <button class="btn btn-danger">
                                    Buscar
                                </button>
                            </div>
                        </div>
                    </div>
            </form>
            
            <hr class="mt-3"/>

            <div class="row g-3 ">

    <?php
        header('Content-type: text/html; charset=utf-8');
                        
        include 'conn.php';

        $busca = $_GET["busca"];

               
        if ($busca == ""){

            $sql = "SELECT * FROM bolos ORDER BY idBolo";

            $result = mysqli_query($conn, $sql);


            if (!$result) {
            die("Falha na Execução da Consulta: " . $sql ."<BR>" .
                mysqli_error($conn));
            }  
            while ($row = mysqli_fetch_assoc($result)) {
                $idBolo = $row["idBolo"];
                $foto = $row["foto"];
                $titulo = $row["titulo"];
                $descricao = $row["descricao"];
                $valor = $row["valor"];
                $fatias = $row["fatias"];
                $categoria = $row["categoria"];

                $arquivo = "img/produtos/".$foto;

                echo '<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 d-flex align-items-stretch">'.
                        '<div class="card text-center bg-light">'.
                            '<img src='.$arquivo.' class="card-img-top">'.
                            '<div class="card-header">'.
                                'R$'.$valor.',00'.
                            '</div>'.
                            '<div class="card-body">'.
                                '<h5 class="card-tittle">'.$titulo.'</h5>'.
                                '<h6 class="card-tittle">Tipo - '.$categoria.'</h6>'.
                                '<p class="card-text truncate-3l">'.
                                    $descricao.
                                '</p>'.
                            '</div>'.
                            '<div class="card-footer">'.
                                '<form class="d-block">'.
                                    '<button class="btn btn-danger">'.
                                        'Quero esse!'.
                                    '</button>'.
                                '</form>'.
                                '<small class="text-success">'.$fatias.' fatias</small>'.
                            '</div>'.
                    '</div>'.
                    '</div>';
            }

            mysqli_free_result($result);

        }
        else{
            $sql = "SELECT * FROM bolos WHERE titulo LIKE '%".$busca."%'";

            $result = mysqli_query($conn, $sql);

            if (!$result) {
            die("Falha na Execução da Consulta: " . $sql ."<BR>" .
                mysqli_error($conn));
            }  
            while ($row = mysqli_fetch_assoc($result)) {
                $idBolo = $row["idBolo"];
                $foto = $row["foto"];
                $titulo = $row["titulo"];
                $descricao = $row["descricao"];
                $valor = $row["valor"];
                $fatias = $row["fatias"];
                $categoria = $row["categoria"];

                $arquivo = "img/produtos/".$foto;

                echo '<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 d-flex align-items-stretch">'.
                        '<div class="card text-center bg-light">'.
                            '<img src='.$arquivo.' class="card-img-top">'.
                            '<div class="card-header">'.
                                'R$'.$valor.',00'.
                            '</div>'.
                            '<div class="card-body">'.
                                '<h5 class="card-tittle">'.$titulo.'</h5>'.
                                '<h6 class="card-tittle">Tipo - '.$categoria.'</h6>'.
                                '<p class="card-text truncate-3l">'.
                                    $descricao.
                                '</p>'.
                            '</div>'.
                            '<div class="card-footer">'.
                                '<form class="d-block">'.
                                    '<button class="btn btn-danger">'.
                                        'Quero esse!'.
                                    '</button>'.
                                '</form>'.
                                '<small class="text-success">'.$fatias.' fatias</small>'.
                            '</div>'.
                    '</div>'.
                    '</div>';
            }

            $busca = "";
            
            mysqli_free_result($result);
        }
    ?>

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
                    <a href="privacidade.html" class="text-decoration-none text-dark">Política de Privacidade</a><br>
                    <a href="termos.html" class="text-decoration-none text-dark">Termos de Uso</a><br>
                    <a href="quemosomos.html" class="text-decoration-none text-dark">Quem Somos</a><br>
                    <a href="trocas.html" class="text-decoration-none text-dark">Trocas e Devoluções</a>
                </div>
                <div class="col-12 col-md-4 text-center text-md-right">
                    <a href="contato.html" class="text-decoration-none text-dark">Contato pelo site</a><br>
                    Email:
                        <a href="mailto:email@dominio.com" class="text-decoration-none text-dark">email@dominio.com</a><br>
                    Telefone:
                        <a href="phone:28999990000" class="text-decoration-none text-dark">(28) 99999-0000</a>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
  </body>
</html>