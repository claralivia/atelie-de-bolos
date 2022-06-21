<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.css">
    <title>Delicake Brasil  ::  Pedidos</title>

    <link rel="apple-touch-icon" sizes="180x180" href="../../img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../../img/favicon/site.webmanifest">
    <link rel="mask-icon" href="../../img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="../../img/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="../../img/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

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
                            <a href="../../index.php" class="nav-link text-warning">Sair</a>
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
            <div class="row">
                <div class="col-12">
                    <div class="d-flex flex-row-reverse justify-content-center justify-content-md">
                        <form method="get" class="d-flex">
                            <select class="form-select" name="tipoPedido">
                                <option value="todos">Todos</option>
                                <option value="pendente">Não respondidas</option>
                                <option value="email">Respondidos no email</option>
                                <option value="whatsapp">Respondidos no whatsapp</option>
                                <option value="email_whatsapp">Respondidos no email e whatsapp</option>
                            </select>
                            <button class="btn btn-danger" type="submit">
                                Mostrar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <hr class="mt-3">
        </div>
        <div class="container">

        <?php

            $tipoPedido = "todos";

            if (isset($_GET['tipoPedido'])){
                $tipoPedido = $_GET['tipoPedido'];
            }
            if($tipoPedido == "pendente"){
                $statusPedido = "Não respondida";
            }
            if($tipoPedido == "email"){
                $statusPedido = "Respondida no email";
            }
            else if($tipoPedido == "whatsapp"){
                $statusPedido = "Respondida no whatsapp";
            }
            else if($tipoPedido == "email_whatsapp"){
                $statusPedido = "Respondida no email e whatsapp";
            }

            header('Content-type: text/html; charset=utf-8');
                
            include '../../conn.php';

            mysqli_set_charset($conn,"utf8");

            if($tipoPedido == 'todos'){

                $sql = "SELECT * FROM pedidos ORDER BY idPedido";

                $result = mysqli_query($conn, $sql);

                if (!$result) {
                die("Falha na Execução da Consulta: " . $sql ."<BR>" .
                    mysqli_error($conn));
                }


                $idPedido = "";
                
                echo'<div class="form_cd">'.
                            '<form method="get">'.
                                '<div class="text-center table-responsive">'.
                                    '<table class="table table-striped">'.
                                            '<tr>'.
                                                '<th>idPedido</th>'.
                                                '<th>Cliente</th>'.
                                                '<th>Email</th>'.
                                                '<th>Telefone</th>'.
                                                '<th>Whatsapp</th>'.
                                                '<th>Mensagem</th>'.
                                                '<th>Status</th>'.
                                                '<th>Data Recebimento</th>'.
                                                '<th>Data Resposta</th>'.
                                                '<th>Deletar</th>'.
                                                '<th>Responder</th>'.
                                            '</tr>';

                    
                    # Laço de repetição para pegar todos os pedidos da tabela do Banco de Dados                        

                    while ($row = mysqli_fetch_assoc($result)) {
                        $idPedido = $row["idPedido"];
                        $nome = $row["nome"];
                        $email = $row["email"];
                        $telefone = $row["telefone"];
                        $whatsapp = $row["whatsapp"];
                        $data = $row["data"];
                        $dataResposta = $row["dataResposta"];
                        $gostou = $row["gostou"];
                        $mudar = $row["mudar"];
                        $tema = $row["tema"];
                        $topo = $row["topo"];
                        $observacoes = $row["observacoes"];
                        $status = $row["status"];

                        $mensagem = '<div class="text-start">'.
                                        '<strong>Gostou: </strong>' . $gostou . '<br>' .
                                        '<strong>Quer mudar: </strong>' . $mudar . '<br>' .
                                        '<strong>Tema: </strong>' . $tema . '<br>' .
                                        '<strong>Topo: </strong>' . $topo . '<br>' .
                                        '<strong>Observações: </strong>' . $observacoes .
                                    '</div>' ;

                        echo                    '<tr>'.
                                                    '<td>'.$idPedido.'</td>'.
                                                    '<td>'.$nome.'</td>'.
                                                    '<td>'.$email.'</td>'.
                                                    '<td>'.$telefone.'</td>'.
                                                    '<td>'.$whatsapp.'</td>'.
                                                    '<td>'.$mensagem.'</td>'.
                                                    '<td>'.$status.'</td>'.
                                                    '<td>'.$data.'</td>'.
                                                    '<td>'.$dataResposta.'</td>'.
                                                    '<td><a href="delete.php?idPedido='.$idPedido.'"><img width="20px" src="../assets/lixeira.png"></a></td>';

                        if($status !== "Respondida no email e whatsapp"){
                            echo '<td><a href="update/update.php?idPedido='.$idPedido.'">Sim</a></td>';
                        }
                        else{
                            echo '<td>Indisponível</td>';
                        }
                                                '</tr>';
                    }   echo            '</table>'.       
                        '</form>'. 
                    '</div>';

                mysqli_free_result($result);
            }

            else {

                $sql = 'SELECT * FROM pedidos WHERE status="'.$statusPedido.'" ORDER BY idPedido';

                $result = mysqli_query($conn, $sql);

                if (!$result) {
                die("Falha na Execução da Consulta: " . $sql ."<BR>" .
                    mysqli_error($conn));
                }


                $idPedido = "";
                
                # Imprimindo a Tabela

                echo'<div class="form_cd">'.
                            '<form method="get">'.
                                '<div class="text-center table-responsive">'.
                                    '<table class="table table-striped">'.
                                            '<tr>'.
                                                '<th>idPedido</th>'.
                                                '<th>Cliente</th>'.
                                                '<th>Email</th>'.
                                                '<th>Telefone</th>'.
                                                '<th>Whatsapp</th>'.
                                                '<th>Mensagem</th>'.
                                                '<th>Status</th>'.
                                                '<th>Data Recebimento</th>'.
                                                '<th>Data Resposta</th>'.
                                                '<th>Deletar</th>'.
                                                '<th>Responder</th>'.
                                            '</tr>';

                    
                    # Laço de repetição para pegar todos os pedidos da tabela do Banco de Dados                        

                    while ($row = mysqli_fetch_assoc($result)) {
                        $idPedido = $row["idPedido"];
                        $nome = $row["nome"];
                        $email = $row["email"];
                        $telefone = $row["telefone"];
                        $whatsapp = $row["whatsapp"];
                        $data = $row["data"];
                        $dataResposta = $row["dataResposta"];
                        $gostou = $row["gostou"];
                        $mudar = $row["mudar"];
                        $tema = $row["tema"];
                        $topo = $row["topo"];
                        $observacoes = $row["observacoes"];
                        $status = $row["status"];

                        $mensagem = '<div class="text-start">'.
                                        '<strong>Gostou: </strong>' . $gostou . '<br>' .
                                        '<strong>Quer mudar: </strong>' . $mudar . '<br>' .
                                        '<strong>Tema: </strong>' . $tema . '<br>' .
                                        '<strong>Topo: </strong>' . $topo . '<br>' .
                                        '<strong>Observações: </strong>' . $observacoes .
                                    '</div>' ;

                        echo                    '<tr>'.
                                                    '<td>'.$idPedido.'</td>'.
                                                    '<td>'.$nome.'</td>'.
                                                    '<td>'.$email.'</td>'.
                                                    '<td>'.$telefone.'</td>'.
                                                    '<td>'.$whatsapp.'</td>'.
                                                    '<td>'.$mensagem.'</td>'.
                                                    '<td>'.$status.'</td>'.
                                                    '<td>'.$data.'</td>'.
                                                    '<td>'.$dataResposta.'</td>'.
                                                    '<td><a href="delete.php?idPedido='.$idPedido.'"><img width="20px" src="../assets/lixeira.png"></a></td>';

                        if($status !== "Respondida no email e whatsapp"){
                            echo '<td><a href="update/update.php?idPedido='.$idPedido.'">Sim</a></td>';
                        }
                        else{
                            echo '<td>Indisponível</td>';
                        }
                                                '</tr>';
                    }
                        echo            '</table>'.                        
                            '</div>'.
                        '</form>'. 
                    '</div>';

                mysqli_free_result($result);
            }
        ?>
            <div class="text-center mb-3">
                <button class="btn btn-danger" type="button" onclick="window.location.href='reset.php'">
                    Apagar tudo
                </button>

                <button class="btn btn-warning" type="button" onclick="window.location.href='../dashboard_page.php'">
                    Voltar
                </button>

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