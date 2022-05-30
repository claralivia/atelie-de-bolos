<?php

    header('Content-type: text/html; charset=utf-8');

    session_start();

    include '../../../conn.php';

    if(isset($_SESSION["idBolo"])){
        $idBolo = ($_SESSION["idBolo"]);
    }

    if(isset($_GET['titulo'])){
        $titulo = $_GET['titulo'];
    }

    if(isset($_GET['valor'])){
        $valor = $_GET['valor'];
    }

    if(isset($_GET['fatias'])){
        $fatias = $_GET['fatias'];
    }

    if(isset($_GET['descricao'])){
        $descricao = $_GET['descricao'];
    }

    if(isset($_GET['categoria'])){
        $categoria = $_GET['categoria'];
    }
    
    $sql = "UPDATE bolos SET titulo=?, descricao=?, valor=?, fatias=?, categoria=? WHERE idBolo =?";

    $stmt = mysqli_stmt_init($conn);
    $stmt_prepared_okay = mysqli_stmt_prepare($stmt,$sql);

    if ($stmt_prepared_okay) {

        mysqli_stmt_bind_param($stmt, "sssssi", $titulo, $descricao, $valor, $fatias, $categoria, $idBolo);

        $stmt_executed_okay = mysqli_stmt_execute($stmt);

        if ($stmt_executed_okay) {
            header('Location: '."../read.php");
        } else {
            echo "Não foi possível executar a atualização de ".
                "$idBolo no banco de dados" . 
                mysqli_error($conn);
            exit;
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);

?>