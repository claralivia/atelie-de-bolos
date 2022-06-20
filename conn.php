<?php

    header('Content-type: text/html; charset=utf-8');
    
    $servername = "sql306.epizy.com";
    $username = "epiz_31234996";
    $password = "wGxoKss8vb494m";
    $dbname = "epiz_31234996_clara"; 

    $conn = mysqli_connect($servername, $username, $password);


    if (!$conn) {
    die("Falha na Conexão: " . mysqli_connect_error());
    }

    // Selecionando banco
    if (!mysqli_select_db($conn,$dbname)) {
        echo "Não foi possível selecionar base de dados \"$dbname\": " . mysqli_error($conn);
        exit;
    }
?>