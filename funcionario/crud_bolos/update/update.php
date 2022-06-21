<?php
    session_start();

    header('Content-type: text/html; charset=utf-8');
                
    include '../../../conn.php';

    mysqli_set_charset($conn,"utf8");

    if(isset($_GET['idBolo'])){
        $_SESSION['idBolo'] = $_GET['idBolo'];
        $idBolo = $_SESSION['idBolo'];
    }

    $sql = "SELECT * FROM bolos WHERE idBolo = '$idBolo' LIMIT 1";

    $result = mysqli_query($conn, $sql);

    if($result){
        $row = mysqli_fetch_assoc($result);

        $_SESSION["foto"] = $row['foto'];
        $foto = $_SESSION["foto"];

        $_SESSION["titulo"] = $row['titulo'];
        $titulo = $_SESSION["titulo"];

        $_SESSION["valor"] = $row['valor'];
        $valor = $_SESSION["valor"];

        $_SESSION["fatias"] = $row['fatias'];
        $fatias = $_SESSION["fatias"];

        $_SESSION["descricao"] = $row['descricao'];
        $descricao = $_SESSION["descricao"];

        $_SESSION["categoria"] = $row['categoria'];
        $categoria = $_SESSION["categoria"];
    }

    else {
        echo "Erro de consulta ".
                mysqli_error($conn);
        exit;
    }

    $conn->close();
?>

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

  <script src='https://www.google.com/recaptcha/api.js'></script>

  <script>
    function verificar(){
        var titulo = document.querySelector('#titulo').value;
        var valor = document.querySelector('#valor').value;
        var fatias = document.querySelector('#fatias').value;
        var descricao = document.querySelector('#descricao').value;
        var foto1 = document.getElementsByName("foto1");  

        if (foto1[0].checked) {
            var count = 0;
        }
        else if(foto1[1].checked){
            var count = 1;
        }

        if (titulo === ''){
            alert("Campo TÍTULO em branco.");
            event.preventDefault();
        }
        else if(valor === ''){
            alert("Campo VALOR em branco.");
            event.preventDefault();
        }
        else if(fatias === ''){
            alert("Campo FATIAS em branco.");
            event.preventDefault();
        }
        else if(descricao === ''){
            alert("Campo DESCRIÇÃO em branco.");
            event.preventDefault();
        }
        else if(grecaptcha.getResponse() === ""){
            alert("Recapctha em branco!");
            event.preventDefault();
        }
        if(count === 1){
            document.getElementById("update").setAttribute("method","get");
            document.getElementById("update").setAttribute("action","script_update.php");
        }
        else if(count == 0){
            document.getElementById("update").setAttribute("method","get");
            document.getElementById("update").setAttribute("action","script_update_image.php");
        }
    }

  </script>

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


    <main>
        <div class="container">
            <div class="row justify-content-center">
                <form onsubmit="verificar()" class="col-sm-10 col-md-8 col-lg-6" enctype="multipart/form-data" id="update">
                    <h1 class="mb-3">Atualizar <?php echo $titulo;?></h1>
                    <div class="form-floating mb-3">
                        <input type="text" <?echo "value = '$titulo'"; unset($_SESSION['titulo']);?> class="form-control" autofocus name="titulo" id="titulo" placeholder=" ">
                        <label for="titulo">Título</label>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">R$</span>
                        </div>
                        <input type="text" <?echo "value = '$valor'";unset($_SESSION['valor']);?> class="form-control" id="valor" placeholder="Valor" name="valor" aria-label="Quantia">
                        <div class="input-group-append">
                            <span class="input-group-text">,00</span>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" <?echo "value = '$fatias'";unset($_SESSION['fatias']);?> class="form-control" id="fatias" name="fatias" placeholder="Quantidade de fatias" aria-label="Fatias" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">fatias</span>
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control" autofocus id="descricao" name="descricao" placeholder=" "
                        style="height: 200px;"><?echo "$descricao";unset($_SESSION['descricao']);?></textarea>
                        <label for="descricao">Descrição</label>
                    </div>

                    <div class="mb-3">
                        <label>Deseja atualizar a foto?</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="foto1" id="foto1" value="Sim">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Sim
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="foto1" id="foto1" value="Não" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Não
                            </label>
                        </div>
                    </div>
                    
                    <?php
                        if($categoria == "Aniversário"){
                            echo   '<select class="form-select mb-3" aria-label="categoria" name="categoria">';
                            echo        '<option value="Aniversário">Aniversário</option>';
                            echo        '<option value="Vulcão">Vulcão</option>';
                            echo        '<option value="Bolo de Pote">Bolo de Pote</option>';
                            echo        '<option value="Cupcake">Cupcake</option>';
                            echo        '<option value="Confeitado">Confeitado</option>';
                            echo    '</select>';
                        }
                        else if($categoria == "Vulcão"){
                            echo   '<select class="form-select mb-3" aria-label="categoria" name="categoria">';
                            echo        '<option value="Vulcão>Vulcão</option>';
                            echo        '<option value="Aniversário">Aniversário</option>';
                            echo        '<option value="Bolo de Pote">Bolo de Pote</option>';
                            echo        '<option value="Cupcake">Cupcake</option>';
                            echo        '<option value="Confeitado">Confeitado</option>';
                            echo    '</select>';
                        }
                        else if($categoria == "Bolo de Pote"){
                            echo   '<select class="form-select mb-3" aria-label="categoria" name="categoria">';
                            echo        '<option value="Bolo de Pote">Bolo de Pote</option>';
                            echo        '<option value="Aniversário">Aniversário</option>';
                            echo        '<option value="Vulcão">Vulcão</option>';
                            echo        '<option value="Cupcake">Cupcake</option>';
                            echo        '<option value="Confeitado">Confeitado</option>';
                            echo    '</select>';
                        }
                        else if($categoria == "Cupcake"){
                            echo   '<select class="form-select mb-3" aria-label="categoria" name="categoria">';
                            echo        '<option value="Cupcake">Cupcake</option>';
                            echo        '<option value="Aniversário">Aniversário</option>';
                            echo        '<option value="Vulcão">Vulcão</option>';
                            echo        '<option value="Bolo de Pote">Bolo de Pote</option>';
                            echo        '<option value="Confeitado">Confeitado</option>';
                            echo    '</select>';
                        }
                        else if($categoria == "Confeitado"){
                            echo   '<select class="form-select mb-3" aria-label="categoria" name="categoria">';
                            echo        '<option value="Confeitado">Confeitado</option>';
                            echo        '<option value="Aniversário">Aniversário</option>';
                            echo        '<option value="Vulcão">Vulcão</option>';
                            echo        '<option value="Bolo de Pote">Bolo de Pote</option>';
                            echo        '<option value="Cupcake">Cupcake</option>';
                            echo    '</select>';
                        }
                    ?>

                    <input type="hidden" id="idBolo" name="idBolo" value=<?php echo '"'.$idBolo.'"';?>>
                    <input type="hidden" id="fotoAnt" name="fotoAnt" value=<?php echo '"'.$foto.'"';?>>

                    <div class="g-recaptcha mb-3" data-sitekey="6LeSEE8gAAAAAHBUJxksEWvPl8XWbdAVy04sHgya"></div>

                    <button class="btn btn-lg btn-danger mb-3" type="submit">
                        Atualizar
                    </button>
                    <button class="btn btn-lg btn-danger mb-3" type="button" onclick="window.location.href='../read.php'">
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