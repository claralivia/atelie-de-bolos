<?php
    header('Content-type: text/html; charset=utf-8');
                
    include '../../conn.php';

    mysqli_set_charset($conn,"utf8");
    
    $sql = "TRUNCATE TABLE pedidos";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Falha na Execução da Consulta: " . $sql ."<BR>" .
        mysqli_error($conn));
    }
    else{
        $dir = "../../img/referencias/";
        $di = new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
        $ri = new RecursiveIteratorIterator($di, RecursiveIteratorIterator::CHILD_FIRST);

        foreach ( $ri as $file ) {
            $file->isDir() ?  rmdir($file) : unlink($file);
        }

        $sql2 = "ALTER TABLE pedidos AUTO_INCREMENT = 1;";

        $result2 = mysqli_query($conn, $sql2);

        if (!$result) {
            die("Falha na Execução da Consulta: " . $sql2 ."<BR>" .
            mysqli_error($conn));
        }
        else{
            header('Location: '."read.php");
        }
    }


?>