<?php
    
    include '../../conn.php';

    mysqli_set_charset($conn,"utf8");

    if(isset($_GET["idBolo"])){
        $_SESSION["idBolo"] = $_GET["idBolo"];
        $idBolo = $_SESSION["idBolo"];
    }

    $sql = "SELECT * FROM bolos ORDER BY idBolo";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
    die("Falha na Execução da Consulta: " . $sql ."<BR>" .
        mysqli_error($conn));
    }                 

    $row = mysqli_fetch_assoc($result);

    $foto = $row["foto"];

    $arquivo = "../../img/produtos/".$foto;
    
    $sql = "DELETE FROM bolos WHERE idBolo=?";

    $stmt = mysqli_stmt_init($conn);
    $stmt_prepared_okay =  mysqli_stmt_prepare($stmt, $sql);

    if ($stmt_prepared_okay) {
        unlink($arquivo);
        mysqli_stmt_bind_param($stmt, "i", $idBolo);

        $stmt_executed_okay = mysqli_stmt_execute($stmt);

        if ($stmt_executed_okay) {
            header('Location: '."read.php");
        } else {
            echo "Não foi possível deletar ".
                "o pedido de número $idBolo no banco de dados". 
                mysqli_error($conn);
            exit;
        }
        mysqli_stmt_close($stmt);
    } else{
        echo "Error: ".$sql;
    }

    mysqli_close($conn);

    mysqli_free_result($result);

?>